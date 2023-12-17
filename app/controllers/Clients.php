<?php
class Clients extends Controller {
    private $clientModel;
    public function __construct() {
        // session_destroy();
        // Check for login & account type
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if (clientAccount($_SESSION['user_type'])) {
            redirect('users/login');
        }

        $this->clientModel = $this->model('client');
    }

    public function index()
    {
        // Initiate the session['cart'] in case the user navigate to cart before adding to it.
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $result = $this->clientModel->getRestaurants();

        $data = [
            'restaurants' => $result
        ];
        $this->view('client/index', $data);
    }

    public function restaurant($id) {
        $_SESSION['res_id'] = $id;

        // Check if trying to add an item.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Check for POST request to add pizza ID to cart.
            if (isset($_POST['pizza_id'])) {

                // check if the ($_SESSION['cart']) is already exist.
                if (!empty($_SESSION['cart'])) {
                    $item_id = $_POST['pizza_id'];

                    // Check if the item is already exist.
                    if (!in_array($item_id, $_SESSION['cart'])) {

                        $item_id = $_POST['pizza_id'];

                        // Add the item to the end of $_SESSION['cart'].
                        array_push($_SESSION['cart'], $item_id);
                    } else {
                        echo "exist";
                    }
                } else {
                    $_SESSION['cart'] = [];
                    $item_id = $_POST['pizza_id'];

                    array_push($_SESSION['cart'], $item_id);
                }

                // Check for POST request for search  
            } elseif (isset($_POST['search_content'])) {

                $search = $_POST['search_content'];
                $result = $this->clientModel->searchPizza($id, $search);

                $data = [
                    'search' => $search,
                    'pizzas' => $result
                ];
                $this->view('client/search_response', $data);
            }
        } else {
            // Normal rendering for the page.
            $result = $this->clientModel->getRestaurantPizzas($id);

            if (!$result) {
                $result = [];
            }

            $data = [
                'search' => '',
                'pizzas' => $result,
            ];
            $this->view('client/restaurant', $data);
        }
    }

    // Details page
    public function details($id) {
        $result = $this->clientModel->getDetails($id);

        $data = [
            'pizza' => $result['pizza'],
            'res_name' => $result['res_name']
        ];

        $this->view('client/details', $data);
    }

    public function cart() {
        $ids = $_SESSION['cart'];
        $pizzas = $this->clientModel->cartItems($ids);

        $data = [
            "pizzas" => $pizzas
        ];

        $this->view('client/cart', $data);
    }

    public function remove() {
        if (isset($_POST['pizza_id'])) {
        if (isset($_POST['pizza_id'])) {

            $products_ids  = $_SESSION['cart'];

            foreach ($products_ids as $x => $id) {
                if ($_POST['pizza_id'] == $id) {
                    unset($_SESSION['cart'][$x]);
                }
            }
            // Reindex the array 
            $_SESSION['cart'] = array_values($_SESSION['cart']);

            $pizzas = $this->clientModel->cartItems($_SESSION['cart']);

            print_r(json_encode($pizzas));            
        } else {
            redirect('clients/cart');
        }
    }
    }
}

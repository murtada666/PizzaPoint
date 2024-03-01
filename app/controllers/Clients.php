<?php
class Clients extends Controller
{
    private $clientModel;
    public function __construct()
    {
        // Check for login & account type
        if (!isLoggedIn() || $_SESSION['user_type'] != 'client') {
            redirect('users/login');
        }
        $this->clientModel = $this->model('client');
    }

    public function index()
    {
        // Initiate the session['cart'] in case the user navigate to cart before adding to it.
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $result = $this->clientModel->getRestaurants();

        $data = [
            'restaurants' => $result
        ];

        $this->view('client/index', $data);
    }

    // Render restaurant items.
    public function restaurant($id)
    {
        $_SESSION['res_id'] = $id;
        // In case restaurant exist, otherwise the client is redirected to 404 page.
        if ($result = $this->clientModel->getRestaurantPizzas($id)) {
            $res_name = $this->clientModel->resName($id);

            if (!$result) {
                $result = [];
            }

            $data = [
                'search' => '',
                'pizzas' => $result,
                'res_name' => $res_name,
            ];
            $this->view('client/restaurant', $data);
        } else {
            $this->view('404');
        }
    }

    // Add item to cart.
    public function add($id)
    {
        if (isset($_POST['pizza_id'])) {
            // Check if the pizza belong to a new restaurant.
            if (!isset($_SESSION['current_res']) || $_SESSION['current_res'] === $id) {
                $_SESSION['current_res'] = $id;
                // check if the ($_SESSION['cart']) is already exist.
                if (!empty($_SESSION['cart'])) {
                    $item_id = $_POST['pizza_id'];

                    // Check if the item is already exist.
                    if (!in_array($item_id, $_SESSION['cart'])) {

                        $item_id = $_POST['pizza_id'];

                        // Add the item to the end of $_SESSION['cart'].
                        array_push($_SESSION['cart'], $item_id);
                        $_SESSION['total_price'] += $_POST['price'];
                    } else {
                        echo "exist";
                    }
                } else {
                    $_SESSION['total_price'] = 0;
                    $_SESSION['cart'] = [];
                    $item_id = $_POST['pizza_id'];

                    array_push($_SESSION['cart'], $item_id);
                    $_SESSION['total_price'] += $_POST['price'];
                }
                // The client adding item from a different restaurant.
            } else {
                echo 'new';
            }
        }
    }

    // Change the current restaurant.
    public function changeRes()
    {
        unset($_SESSION['current_res']);
        unset($_SESSION['cart']);
        echo 'changed';
    }

    // Search functionality.
    public function search()
    {
        if (isset($_POST['search_content'])) {
            $res_id = $_SESSION['res_id'];
            $search = $_POST['search_content'];

            // Check whether search content is empty or not to avoid unnecessary wildcard/like behavior in SQL. 
            if (!empty($search)) {
                print_r(json_encode($this->clientModel->searchPizza($res_id, $search)));
            } else {
                echo (json_encode('empty'));
            }
        }
    }

    // Details page.
    public function details($id)
    {
        $result = $this->clientModel->getDetails($id);

        $data = [
            'pizza' => $result['pizza'],
            'res_name' => $result['res_name']
        ];

        $this->view('client/details', $data);
    }

    // Fetch cart items from DB.
    public function cart()
    {
        $ids = $_SESSION['cart'];
        $pizzas = $this->clientModel->cartItems($ids);

        $data = [
            "pizzas" => $pizzas
        ];

        $this->view('client/cart', $data);
    }

    // Remove item from cart
    public function remove()
    {
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
            $total = $this->clientModel->total($_SESSION['cart']);

            $result = [$pizzas, $total];

            print_r(json_encode($result));
        }
    }

    // Placing client order.
    public function order()
    {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo 'empty';
        } elseif (isset($_SESSION['cart']) || !empty($_SESSION['cart'])) {
            // Get a random driver depending on existing once.
            $driver_id = $this->clientModel->randDriver();
            $client_id = $_SESSION['user_id'];
            $res_id = $_SESSION['res_id'];
            $pizzas_ids = implode(", ", $_SESSION['cart']);
            $total = $_SESSION['total_price'];
            try {
                $this->clientModel->placeOrder($client_id, $res_id, $pizzas_ids, $driver_id, $total);
                // Clear cart session.
                unset($_SESSION['cart']);
                // To show snackBar after placing order.
                $_SESSION['placed'] = true;
                unset($_SESSION['current_res']);
                echo 'placed';
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    // This function notify the index page that an order is placed.
    public function checkPlaceOrder()
    {
        if (isset($_SESSION['placed']) && $_SESSION['placed'] === true) {
            echo 'true';
            unset($_SESSION['placed']);
        }
    }
}

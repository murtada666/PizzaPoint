<?php

class Restaurants extends Controller
{
    private $restaurantModel;
    public function __construct()
    {
        // Check for login & account type
        if (!isLoggedIn() || $_SESSION['user_type'] != 'restaurant') {
            redirect('users/login');
        }
        // Initialize the restaurant model.
        $this->restaurantModel = $this->model('restaurant');
    }

    public function index()
    {
        $result = $this->restaurantModel->getPizzas($_SESSION['user_id']);

        $data = [
            'pizzas' => $result,
        ];

        $this->view('restaurant/index', $data);
    }

    // Remove item from the restaurant dashboard.
    public function remove_item()
    {
        if (isset($_POST['pizza_id'])) {
            if ($this->restaurantModel->remove($_POST['pizza_id'])) {
                // Fetch the remaining pizzas from DB and send it to JS AJAX.
                print_r(json_encode($this->restaurantModel->getPizzas($_SESSION['user_id'])));
            }
        }
    }

    // Show pizza details(update page).
    public function update($id)
    {
        $errors = array('title' => '', 'ingredients' => '');
        $data = [
            'pizza' => $this->restaurantModel->getSinglePizza($id),
            'errors' => $errors
        ];
        $this->view('restaurant/update', $data);
    }

    // Update pizza details.
    public function update_pizza()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Initialize empty errors array.
            $errors = [
                'title' => '',
                'ingredients' => ''
            ];

            // Check title.
            if (isset($_POST['title']) && empty($_POST['title'])) {
                $errors['title'] = 'empty';
            } else {
                if (isset($_POST['title']) && !preg_match('/^[a-zA-Z\s]+$/',  $_POST['title'])) {
                    $errors['title'] = 'unacceptable';
                }
            }

            // Check ingredients.
            if (isset($_POST['ing']) && empty($_POST['ing'])) {
                $errors['ingredients'] = 'empty';
            } else {
                if (isset($_POST['ing']) && !preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $_POST['ing'])) {
                    $errors['ingredients'] = 'unacceptable';
                }
            }
            // In case there is NO errors, save updates to DB.
            if ($errors['title'] == '' && $errors['ingredients'] == '') {
                $this->restaurantModel->updatePizza($_POST['pizza_id'], $_POST['title'], $_POST['ing']);
                echo (json_encode('done'));
                // In case there is an error, Send the error to the AJAX to render it.
            } else {
                print_r(json_encode($errors));
            }
        }
    }

    // Orders Page.
    public function orders()
    {
        // Fetch all orders from DB.
        $orders = $this->restaurantModel->getOrders($_SESSION['user_id']);
        // Orders details.
        $data = [];
        // Looping through all orders to fetch its details.
        foreach ($orders as $order) {
            $single_order = [
                'order_id' => $order->order_id,
                'customer_name' => $this->restaurantModel->customerName($order->client_id)->name,
                'order_status' => $order->order_status,
                'driver_name' => $this->restaurantModel->driverName($order->driver_id)->name,
                'total' => $order->total,
                'date_time' => $order->created_at,
            ];
            // Add single order details to data array.
            array_push($data, $single_order);
        }
        // Render the orders.
        $this->view('restaurant/orders', $data);
    }

    // Order details.
    public function order_details($id)
    {
        $order = $this->restaurantModel->getSingleOrder($id);
        $pizza_IDs = explode(',', $order->order_details);

        $pizzas_titles = array();
        foreach ($pizza_IDs as $pizza_id) {
            $title = $this->restaurantModel->getSinglePizzaTitle($pizza_id)->title;
            array_push($pizzas_titles, $title);
        }
        $data = [
            'order_id' => $order->order_id,
            'order_details' => $pizzas_titles,
            'order_status' => $order->order_status
        ];
        $this->view('restaurant/order_details', $data);
    }

    // Add new item page.
    public function add()
    {
        $data = [
            'title' => '',
            'ingredients' => ''
        ];
        $this->view('restaurant/add', $data);
    }

    // Add pizza to DB.
    public function add_pizza()
    {
        // TODO: Save data to DB.
        // Pass to the function restaurant ID & pizza details.
        if ($this->restaurantModel->addPizza($_SESSION['user_id'], $_POST)) {
            echo true;
        } else {
            echo 'not saved';
        }
    }

    // Update order status.
    public function update_status()
    {
        if (!empty($_POST['the_new_status']) && !empty($_POST['order_id'])) {
            $result_check = $this->restaurantModel->updateOrderStatus($_POST['order_id'], $_POST['the_new_status']);
            if ($result_check == true) {
                // To show snackbar.
                $_SESSION['updated'] = true;
                // Let know the JS that the order is updated.
                echo true;
            }
        } else {
            echo 'nothing';
        }
    }

    public function check_updated_order()
    {
        if (isset($_SESSION['updated']) && $_SESSION['updated'] == true) {
            unset($_SESSION['updated']);
            echo true;
        } else {
            echo false;
        }
    }
}

<?php

class Restaurants extends Controller
{
    private $restaurantModel;
    public function __construct()
    {
        // Check for login & account type
        // if (!isLoggedIn() || $_SESSION['user_type'] != 'restaurant') {
        //     redirect('users/login');
        // }
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
            'pizza' => $this->restaurantModel->getPizza($id),
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

    // Orders page.
    // public function orders() {
    //     // Get all orders that belong to a specific restaurant.
    //     $orders = $this->restaurantModel->getOrders($_SESSION['user_id']);
    //     // Initialize array to hold arrays of titles. 
    //     $all_orders_titles = [];
    //     /*
    //         - Loop through orders to get the details(aka pizzas IDs) for each order.
    //         - Get order details/pizzas.
    //         - Get the title of each pizza and add it to order_titles array.
    //         - Add order_titles array to all_orders_pizzas_titles array.
    //     */
    //     foreach($orders as $order) {

    //         $order_titles = [];

    //         $pizza_details =  explode(',',$order->order_details);

    //         foreach($pizza_details as $id) {
    //             $pizza_title = $this->restaurantModel->getOrderPizza($id);
    //             array_push($order_titles, $pizza_title);                
    //         }
    //         array_push($all_orders_titles, $order_titles);
    //     }
    //     $data = [
    //         'orders' => $orders,
    //         'orders_titles' => $all_orders_titles
    //     ];
    //     $this->view('restaurant/orders', $data);
    // }
}

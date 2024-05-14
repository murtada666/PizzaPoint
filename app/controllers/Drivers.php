<?php
class Drivers extends Controller
{
    private $driverModel;

    public function __construct()
    {
        // Check for login & account type
        if (!isLoggedIn() || $_SESSION['user_type'] != 'driver') {
            redirect('users/login');
        }
        // Initialize the restaurant model.
        $this->driverModel = $this->model('driver');
    }

    public function index()
    {

        $orders = $this->driverModel->getOrders($_SESSION['user_id']);
        // Orders details.
        $data = [];
        // Looping through all orders to fetch its details.
        foreach ($orders as $order) {
            $single_order = [
                'order_id' => $order->id,
                'customer_name' => $this->driverModel->customerName($order->client_id)->name,
                'order_status' => $order->order_status,
                'restaurant_name' => $this->driverModel->restaurantName($order->restaurant_id)->name,
                'total' => $order->total,
                'date_time' => $order->created_at,
            ];
            // Add single order details to data array.
            array_push($data, $single_order);
        }

        // Load view.
        $this->view('driver/index', $data);
    }

    // Order details.
    public function order_details($id)
    {
        if ($order = $this->driverModel->getSingleOrder($id)) {
            $pizza_IDs = explode(',', $order->order_details);

            $pizzas_titles = array();
            foreach ($pizza_IDs as $pizza_id) {
                $title = $this->driverModel->getSinglePizzaTitle($pizza_id)->title;
                array_push($pizzas_titles, $title);
            }
            $data = [
                'order_id' => $order->id,
                'order_details' => $pizzas_titles,
                'order_status' => $order->order_status
            ];
            // Load view.
            $this->view('driver/order_details', $data);
        } else {
            $this->view('404');
        }
    }

    // Update order status.
    public function update_status()
    {
        if (!empty($_POST['the_new_status']) && !empty($_POST['order_id'])) {
            $result_check = $this->driverModel->updateOrderStatus($_POST['order_id'], $_POST['the_new_status']);
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
}

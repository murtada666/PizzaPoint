<?php

class Restaurants extends Controller {
    private $restaurantModel;
    public function __construct()
    {
        // Check for login & account type
        if (!isLoggedIn() || $_SESSION['user_type'] != 'restaurant') {
            redirect('users/login');
        }
        $this->restaurantModel = $this->model('restaurant');
    }

    public function index() {

        $result = $this->restaurantModel->getPizzas($_SESSION['user_id']);

        $data = [
            'pizzas' => $result,
        ];

        $this->view('restaurant/index', $data);
    }

    // Remove item from the restaurant dashboard.
    public function remove_item() {
        if (isset($_POST['pizza_id'])) {
            if ($this->restaurantModel->remove($_POST['pizza_id'])) {
                // Fetch the remaining pizzas from DB and send it to JS AJAX.
                print_r(json_encode($this->restaurantModel->getPizzas($_SESSION['user_id'])));
                die();
            }
        }
    }

    // Show pizza details(update page).
    public function update($id) {
        $errors = array('title' => '', 'ingredients' => '');
        $data = [
            'pizza' => $this->restaurantModel->getPizza($id),
            'errors' => $errors
        ];
        $this->view('restaurant/update', $data);
    }

    // Update pizza details.
    public function update_pizza() {
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
            if($errors['title'] == '' && $errors['ingredients'] == '') {
                $this->restaurantModel->updatePizza($_POST['pizza_id'], $_POST['title'], $_POST['ing']); 
                echo(json_encode('done'));
            // In case there is an error, Send the error to the AJAX to render it.
            } else {
                print_r(json_encode($errors));
            }
        } 
    }
}

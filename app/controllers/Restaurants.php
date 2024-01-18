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
            // Check title.
            if (empty($_POST['title'])) {
                $errors['title'] = 'Title is required';
            } else {
                $title = $_POST['title'];
                if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                    $errors['title'] = 'Title must be letters and spaces only';
                }
            }

            // Check ingredients.
            if (empty($_POST['ingredients'])) {
                $errors['ingredients'] = 'At least one ingredient is required';
            } else {
                $ingredients = $_POST['ingredients'];
                if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                    $errors['ingredients'] = 'Ingredients must be a comma separated list';
                }
            }
        } 
    }
}

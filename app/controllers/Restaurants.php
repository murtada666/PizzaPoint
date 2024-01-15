<?php

class Restaurants extends Controller {
    private $restaurantModel;
    public function __construct(){
        // Check for login & account type
        if (!isLoggedIn() || $_SESSION['user_type'] != 'restaurant') {
            redirect('users/login');
        }
        // $this->restaurantModel = $this->model('restaurant');
    }

    public function index(){
        echo 'nailed it!';
    }
}
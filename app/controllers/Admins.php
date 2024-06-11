<?php
class Admins extends Controller
{
  private $adminModel;

  public function __construct()
  {
    // Redirect if  unauthenticated admin.
    if ($_SESSION['user_type'] != 'admin') {
      redirect('users/login');
    }
    // Assign admin model.
    $this->adminModel = $this->model('admin');
  }

  // View index page.
  public function index()
  {
    // Fetch data from the model(DB).
    $clients = $this->adminModel->tableCount('clients');
    $restaurants = $this->adminModel->tableCount('restaurants');
    $drivers = $this->adminModel->tableCount('drivers');
    $orders = $this->adminModel->tableCount('orders');
    $pizzas = $this->adminModel->tableCount('pizzas');
    $admins = $this->adminModel->tableCount('admins');
    $best_driver = $this->adminModel->bestDriver()->name;
    $best_restaurant = $this->adminModel->bestRestaurant()->name;
    $best_client = $this->adminModel->bestClient()->name;

    // Data set like that so it can be used as key value pairs in view loop. 
    $data = [
      'clients' => ['clients' => $clients],
      'restaurants' => ['restaurants' => $restaurants],
      'drivers' => ['drivers' => $drivers],
      'orders' => ['orders' => $orders],
      'pizzas' => ['pizzas' => $pizzas],
      'admins' => ['admins' => $admins],
      'best_driver' => ['best driver' => $best_driver],
      'best_client' => ['best client' => $best_client],
      'best_restaurant' => ['best restaurant' => $best_restaurant]
    ];

    $this->view('admin/index', $data);
  }

  // View new admin page.
  public function new_admin()
  {
    // Needed to determine the table latter.
    $_SESSION['future_account_type'] = 'admins';

    // Init data.
    $data = [
      'name' => '',
      'email' => '',
      'password' => '',
      'confirm_password' => '',
      'name_err' => '',
      'email_err' => '',
      'password_err' => '',
      'confirm_password_err' => ''
    ];

    $this->view('admin/new_admin', $data);
  }

  // View restaurants page.
  public function restaurants()
  {
    $this->view('admin/restaurants');
  }

  // View new restaurant page.
  public function new_restaurant()
  {
    // Needed to determine the table latter.
    $_SESSION['future_account_type'] = 'restaurants';

    // Init data.
    $data = [
      'name' => '',
      'email' => '',
      'password' => '',
      'confirm_password' => '',
      'name_err' => '',
      'email_err' => '',
      'password_err' => '',
      'confirm_password_err' => ''
    ];

    $this->view('admin/new_restaurant', $data);
  }

  // View clients page.
  public function clients()
  {
    $this->view('admin/clients');
  }
  // View new clients page.
  public function new_client()
  {
    $_SESSION['future_account_type'] = 'clients';

    // Initialize data.
    $data = [
      'name' => '',
      'email' => '',
      'password' => '',
      'confirm_password' => '',
      'name_err' => '',
      'email_err' => '',
      'password_err' => '',
      'confirm_password_err' => ''
    ];

    $this->view('admin/new_client', $data);
  }

  // View drivers page.
  public function drivers()
  {
    $this->view('admin/drivers');
  }
  // View new driver page.
  public function new_driver()
  {
    // Needed to determine the table latter.
    $_SESSION['future_account_type'] = 'drivers';

    // Init data.
    $data = [
      'name' => '',
      'email' => '',
      'password' => '',
      'confirm_password' => '',
      'name_err' => '',
      'email_err' => '',
      'password_err' => '',
      'confirm_password_err' => ''
    ];

    $this->view('admin/new_driver', $data);
  }

  // Create new account(Restaurant, driver, client, admin) in DB - Dynamic function.
  public function add_account()
  {
    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Process form.

      // Sanitize POST data.
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Initialize data.
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password'])
      ];

      // Errors data.
      $response = [
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      // Validate Email.
      if (empty($data['email'])) {
        $response['email_err'] = 'Please enter email';
      }

      // Check email existent.
      if ($this->adminModel->findUserByEmail($data['email'])) {
        $response['email_err'] = 'Email is already taken';
      }


      // Validate Name.
      if (empty($data['name'])) {
        $response['name_err'] = 'Please enter name';
      }

      // Validate Password.
      if (empty($data['password'])) {
        $response['password_err'] = 'Please enter password';
      } elseif (strlen($data['password']) < 6) {
        $response['password_err'] = 'Password must be at least 6 characters';
      }

      // Validate Confirm Password.
      if (empty($data['confirm_password'])) {
        $response['confirm_password_err'] = 'Please confirm password';
      } else {
        if ($data['password'] != $data['confirm_password']) {
          $response['confirm_password_err'] = 'Passwords do not match';
        }
      }

      // Make sure errors are empty.
      if (empty($response['email_err']) && empty($response['name_err']) && empty($response['password_err']) && empty($response['confirm_password_err'])) {
        // Validated.

        // Register User.
        if ($this->adminModel->registerAccount($_SESSION['future_account_type'], $data)) {
          if ($_SESSION['future_account_type'] == 'admins') {
            $response = [true, 'index'];
            print_r(json_encode($response));
          } else {
            $response = [true, $_SESSION['future_account_type']];
            print_r(json_encode($response));
          }
        } else {
          die('Something went wrong');
        }
      } else {
        print_r(json_encode($response));
      }
    }
  }
}

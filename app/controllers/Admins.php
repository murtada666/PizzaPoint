<?php
class Admins extends Controller
{
  private $adminModel;

  public function __construct()
  {
    if($_SESSION['user_type'] != 'admin') {
      redirect('users/login');
    }

    $this->adminModel = $this->model('admin');
  }

  public function index()
  {
    $data = [];
    $this->view('admin/index', $data);
  }

  // View new admin page.
  public function new_admin()
  {
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

  // Add admin to DB.
  public function add_admin()
  {
    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Process form.
      // Sanitize POST data.
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Initialize data.
      $data = [
        'account_type' => 'admin',
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password'])
      ];

      $response = [
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      // Validate Email.
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email';
      } else {
        // Check email.
        if ($this->adminModel->findUserByEmail($data['email'])) {

          $response['email_err'] = 'Email is already taken';
        }
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

        // Hash Password.
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register User.
        if ($this->adminModel->register($data)) {
          echo (json_encode(true));
        } else {
          die('Something went wrong');
        }
      } else {
        print_r(json_encode($response));
      }
    }
  }

  public function clients()
  {
    $data = [];
    $this->view('admin/clients', $data);
  }
  public function restaurants()
  {
    $data = [];
    $this->view('admin/restaurants', $data);
  }
  public function drivers()
  {
    $data = [];
    $this->view('admin/drivers', $data);
  }
}

<?php
class Users extends Controller
{
  private $userModel;
  public function __construct()
  {
    // To redirect the logged in user back to his home page.
    if (isLoggedIn()) {
      $path = $_SESSION['user_type'] . 's/index';
      redirect($path);
    }
    // Initialize user model.
    $this->userModel = $this->model('User');
  }

  public function register()
  {
    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Process form.
      // Sanitize POST data.
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Initialize data.
      $data = [
        'account_type' => 'client',
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
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
        if ($this->userModel->findUserByEmail($data['email'])) {

          $data['email_err'] = 'Email is already taken';
        }
      }

      // Validate Name.
      if (empty($data['name'])) {
        $data['name_err'] = 'Please enter name';
      }

      // Validate Password.
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      } elseif (strlen($data['password']) < 6) {
        $data['password_err'] = 'Password must be at least 6 characters';
      }

      // Validate Confirm Password.
      if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Please confirm password';
      } else {
        if ($data['password'] != $data['confirm_password']) {
          $data['confirm_password_err'] = 'Passwords do not match';
        }
      }

      // Make sure errors are empty.
      if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        // Validated.

        // Hash Password.
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // Register User.
        if ($this->userModel->register($data)) {
          $_SESSION['signed'] = true;
          redirect('users/login');
        } else {
          die('Something went wrong');
        }
      } else {
        // Load view with errors.
        $this->view('users/register', $data);
      }
    } else {
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
      // Load view.
      $this->view('users/register', $data);
    }
  }

  public function login()
  {
    // Check for POST.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Process form.
      // Sanitize POST data.
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Initialize data.
      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',
      ];

      // Validate Email.
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter email';
      }

      // Validate Password.
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      }

      // Check for user/email.
      if ($this->userModel->findUserByEmail($data['email'])) {
        // User found
      } else {
        // User not found.
        $data['email_err'] = 'No user found';
      }

      // Make sure errors are empty.
      if (empty($data['email_err']) && empty($data['password_err'])) {

        // Validated.

        // Check and set logged in user
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);

        if ($loggedInUser) {
          // Create Session.
          $this->createUserSession($loggedInUser);

          // Check account type.
          if ($_SESSION['user_type'] == 'client') {
            redirect('home');
            // redirect('clients/index');

          } elseif ($_SESSION['user_type'] == 'restaurant') {
            redirect('restaurants/index');
          } elseif ($_SESSION['user_type'] == 'driver') {
            redirect('drivers/index');
          } elseif ($_SESSION['user_type'] == 'admin') {
            redirect('admins/index');
          } else {
            die('Unrecognizable User Type!');
          }
        } else {
          $data['password_err'] = 'Email or Password is incorrect';

          $this->view('users/login', $data);
        }
      } else {
        // Load view with errors.
        $this->view('users/login', $data);
      }
    } else {
      // Init data.
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',
      ];

      // Load view.
      $this->view('users/login', $data);
    }
  }

  // Create the needed sessions.
  public function createUserSession($user)
  {
    $_SESSION['user_type'] = $user->account_type;
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name;
    $_SESSION['user_type'] = $user->account_type;
  }
  // Logout operations.
  public function logout()
  {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    session_destroy();
    redirect('users/login');
  }
  // Checks for a signed up(to show the snackBar).
  public function check_signed()
  {
    if (isset($_SESSION['signed']) && $_SESSION['signed'] === true) {
      unset($_SESSION['signed']);
      echo 'true';
    }
  }
}

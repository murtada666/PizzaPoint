<?php
$current_page = $_SERVER['PHP_SELF'];
$url = $_SERVER['REQUEST_URI'];
?>

<nav>
  <div class="container">
    <?php if (!isset($_SESSION['user_type'])) : ?>
      <!-- In this way the logo will stay in the same page -->
      <a href="<?php echo URLROOT . "/" . controllerName($url) . '/' . pageName($url); ?>" class="logo">Pizza Point</a>
    <?php elseif ($_SESSION['user_type'] == 'client') : ?>
      <a href="<?php echo URLROOT . "/home" ?>" class="logo">Pizza Point</a>
    <?php else : ?>
      <a href="<?php echo URLROOT . "/" . $_SESSION['user_type'] . "s/index"; ?>" class="logo">Pizza Point</a>
    <?php endif ?>
    <ul class="nav-ul">
      <?php

      // Unsigned side.
      if (pageName($url) == "register") {
        echo '<li><a href="login" >Login</a></li>';
      }
      if (pageName($url) == "login") {
        echo '<li><a href="register" >Register</a></li>';
      }

      // Clients side.
      if (controllerName($url) == "clients") {
        if (pageName($url) == "index") {
          echo '<li ><a href="cart">Your CART</a></li>';
        } elseif (pageName($url) == "cart") {
          echo '
                  <li ><a href="../index">Home</a></li>
                  <form action="./order" method="POST">
                      <li><input  id="place-btn" type="submit" name="ordered" value="Place order"></li>
                  </form>
                  ';
        } elseif (pageName($url) == "restaurant") {
          echo '<li ><a href="../index">Home</a></li>
                <li ><a href="../cart">Your CART</a></li>';
        }
      } elseif (controllerName($url) == "home") {
        echo '<li ><a href="./clients/cart">Your CART</a></li>';
      }

      // Restaurant side.
      if (controllerName($url) == "restaurants") {
        if (pageName($url) == "index") {
          echo '<li ><a href="orders">Orders</a></li>
                <li ><a href="add">New Item</a></li>';
        } elseif (pageName($url) == "orders") {
          echo '<li ><a href="../index">Home</a></li>';
        }
      }

      // Admin side.
      if (controllerName($url) == "admins") {
        if (pageName($url) == "index") {
          echo '<li ><a href="new_admin">New Admin</a></li>';
        } elseif (pageName($url) == 'restaurants') {
          echo '<li ><a href="new_restaurant">New Restaurant</a></li>';
        } elseif (pageName($url) == 'drivers') {
          echo '<li ><a href="new_driver">New driver</a></li>';
        } elseif (pageName($url) == 'clients') {
          echo '<li ><a href="new_client">New client</a></li>';
        }
      }


      if (pageName($url) != 'login' && pageName($url) != 'register') {
        echo "<form action=" . URLROOT . "/users/logout method='POST'>
        <li><input type='submit' name='logout' value='Logout' class='btn brand z-depth-0'></li>
      </form>";
      }

      if (isset($_SESSION['user_name'])) {
        echo "<li class='user-name'>HELLO " . htmlspecialchars(strtoupper($_SESSION['user_name'])) . '</li>';
      }

      ?>

    </ul>
  </div>
</nav>

<div class="br"></div>
<nav>
  <div class="container">
    <a href="<?php echo URLROOT . "/clients/index"; ?>" class="logo">Pizza Point</a>
    <ul>
      <?php

      $current_page = $_SERVER['PHP_SELF'];
      $url = $_SERVER['REQUEST_URI'];


      if (pageName($url) == "register") {
        echo '<li><a href="login" >Login</a></li>';
      }
      if (pageName($url) == "login") {
        echo '<li><a href="register" >Register</a></li>';
      }

      // clients buttons
      if (controllerName($url) == "clients") {
        echo "<li class='user-name'>Hello " . htmlspecialchars(strtoupper($_SESSION['user_name'])) . '</li>';

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
      }


      // restaurant
      if (pageName($url) == "restaurant/jj" || pageName($url) == "restaurant/index") {
        echo '<li><a href="orders.php" >Orders</a></li>';
      }
      if (pageName($url) == "/pizzawebapp/restaurant/dashboard.php" || pageName($url) == "/pizzawebapp/restaurant/orders.php") {
        echo '<li><a href="process.php" >in process</a></li>';
      }
      if (pageName($url) == "/pizzawebapp/restaurant/orders.php" || pageName($url) == "/pizzawebapp/restaurant/process.php") {
        echo '<li><a href="dashboard.php" >dashboard</a></li>';
      }
      if (pageName($url) == "/pizzawebapp/restaurant/dashboard.php") {
        echo '<li><a href="add.php" >Add a Pizza</a></li>';
      }


      // driver buttons
      if (pageName($url) == "/pizzawebapp/driver/in_the_way.php") {
        echo '<li><a href="driver.php" >orders</a></li>';
      }
      if (pageName($url) == "/pizzawebapp/driver/driver.php") {
        echo '<li><a href="in_the_way.php" >in the way</a></li>';
      }


      if(pageName($url) != 'login' && pageName($url) != 'register') {
        echo "<form action=" . URLROOT . "/users/logout method='POST'>
        <li><input type='submit' name='logout' value='Logout' class='btn brand z-depth-0'></li>
      </form>";
      }
      ?>
      
    </ul>
  </div>
</nav>
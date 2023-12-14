<?php
// DB params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '123456');
define('DB_NAME', 'ninja_pizza');

/* App Root 
    * Used when we need something from app folder
    * No need to use echo!
*/
define('APPROOT', dirname(dirname(__FILE__)));
/* URL Root
    * Used when we need something from public folder
    * Must use echo!
*/
define('URLROOT', 'http://localhost/pizzapoint');
// Site Name
define('SITENAME', 'Pizza Point');

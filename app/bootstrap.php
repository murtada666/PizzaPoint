<?php
// ini_set('memory_limit', '1024M');

// Load config.
require_once 'config/config.php';
// Load helpers.
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

// Load Libraries.

// the first way
// require_once 'libraries/core.php';
// require_once 'libraries/controller.php';
// require_once 'libraries/database.php';

/* 
 * the second one (best practice).
 * for this to work file name should match the class name exactly.
 * ex: class name = Controller.
 * then the file name should have a capital C as well.
*/

// Autoload Core  Libraries.
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
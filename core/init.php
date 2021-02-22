<?php

session_start();
error_reporting(0);
// ini_set('display_errors', 'On');

require_once 'connect/database.php';

// Declaring PhpMailer Files



require_once 'classes/curl.php';

require_once 'classes/shop.php';
require_once 'classes/product.php';

$shop_class     = new shop($db);
$product_class  = new product($db);


$hours_config = '24';






?>

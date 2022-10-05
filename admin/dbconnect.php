<?php
session_start();
$conn=mysqli_connect("localhost","root","","dairydb");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'dairy/');
define('SITE_PATH','http://localhost/dairy/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
?>
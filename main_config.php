<?php
ini_set( "display_errors", true );
define( "DB_DSN", "mysql:host=localhost;dbname=bookstore" );
define( "DB_USERNAME", "bookstore" );
define( "DB_PASSWORD", "bookstore123!@#" );
define( "CLASS_PATH", "/var/www/html/bookstoreapis/classes" );
define( "TEMPLATE_PATH", "templates" );
define('DIR_APPLICATION', '/var/www/html/bookstoreapis/');
define('BASELINK', 'http://18.116.116.222/bookstoreapis/');
require( CLASS_PATH . "/Book.php" );

function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  echo $exception;
  error_log( $exception->getMessage() );
}
set_exception_handler( 'handleException' );
?>

<?php
// Imports
include_once dirname(__DIR__).'/backend/account.php';
include_once dirname(__DIR__).'/components/scripts/links.php';
include_once dirname(__DIR__).'/components/scripts/page_processing.php';

// Initializations
$links =  new Links();
$controller = new Account();
$pp = new page_processor();

// Program
$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, proceed to the rest of the task, if not show a 404 error
if($pp->logged_in){
    // If logged in, check if GET details are avaialable
    if(!empty($_GET['mode'])){

    } else {
      header("HTTP/1.1 404 Not Found"); // Redirect to 404-page
      header("Location: ".$link->path('404_page')); // Redirect to 404 page
      die();
    }
} else {
  // If not logged in, show a 404 error
  header("HTTP/1.1 404 Not Found"); // Redirect to 404-page
  header("Location: ".$link->path('404_page')); // Redirect to 404 page
  die();
}

?>

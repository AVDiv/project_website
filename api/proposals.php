<?php
// Imports
include_once dirname(__DIR__).'/backend/controller.php';
include_once dirname(__DIR__).'/components/scripts/links.php';
include_once dirname(__DIR__).'/components/scripts/page_processing.php';

// Initializations
$links =  new Links();
$controller = new Controller();
$pp = new page_processor();

// Program
$pp->is_logged_in($_COOKIE); // Checks if the user is logged in
// If logged in, proceed to the rest of the task, if not show a 404 error
if($pp->logged_in){
    if(!$pp->is_verified_account($pp->user_id)){
        // Account is not verified
        header("Location: ".$links->path('email_verify_page')); // Redirect to verification page
        die();
    }
    // Check GET parameters, if valid parameters continue, else send 404
 } else{
    // If not logged in, show a 403 error
    http_response_code(403); // Forbidden
    die();
}

?>
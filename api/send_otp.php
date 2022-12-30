<?php
// if any POST request is made, validate the data, if the data is good to go, send the OTP or errors
// if any GET request is made, send a 404 error

// Error codes
// 0 - Success
// 1 - Email does not exist
// Imports
include_once '../backend/account.php';
include_once '../components/scripts/links.php';
include_once '../backend/validation.php';
include_once '../backend/mail/send_mail.php';
include_once '../components/scripts/page_processing.php';
// Initializations
$pp = new page_processor();
$controller = new Account();
$validator = new Validation();
$smtp = new SendMail();
$link = new Links();
$error_code = 0;
// Program
$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, proceed to the rest of the task, if not show a 404 error
if($pp->logged_in){
    // If logged in, check if form is submitted
    if(!empty($_POST['email'])){
        // Validate the data
        $supplied_email = $_POST['email'];
        $is_valid = $validator->validate_email($supplied_email);
        if($is_valid){
            $user = $controller->get_user_details($pp->user_id);
            $original_email = $user['email'];
            if($original_email===$supplied_email){
                // Email is valid and matches the original email
                // Attempt to create the email verification request
                $request_result = $controller->create_email_verification($pp->user_id);
                // Send the OTP from the Sendinblue API
                $smtp->send_otp($user['firstname'], $user['lastname'], $user['email'], $request_result /* OTP code */ );
            } else $error_code = 1;
        }
    } else $error_code = 1;
    header('Content-Type: application/json');
    echo ($error_code!==0?json_encode(array('error'=>$error_code)):json_encode(array('success'=>'true')));

} else{
    // If not logged in, show a 404 error
    header("HTTP/1.1 404 Not Found"); // Redirect to 404-page
    // header("Location: ".$link->path('404_page')); // Redirect to 404 page
    die();
}



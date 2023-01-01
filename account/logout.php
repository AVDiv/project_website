<?php
    // Imports
    include_once dirname(__DIR__) . '/backend/controller.php';
    include_once dirname(__DIR__).'/components/scripts/page_processing.php';
    include_once dirname(__DIR__).'/components/scripts/links.php';
    // Initializations
    $pp = new page_processor();
    $controller = new Controller();;
    $link = new Links();
    // Program
    $pp->is_logged_in($_COOKIE); // Checl whether user is logged in
    if ($pp->logged_in){
        // Logout the user
        $controller->remove_login_session($_COOKIE['LOGSESSID']);
        // Redirect to login page
        header("Location: ".$link->path('login_page')."?redirect=".$link->path('dashboard_page'));
    } else {
        // Redirect to login page
        header("Location: ".$link->path('login_page'));
    }
die();

?>
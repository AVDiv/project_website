<?php
session_start();
// Imports
include_once 'components/scripts/links.php';
include_once 'components/scripts/page_processing.php';
include_once 'backend/controller.php';
// Initializations
$link = new Links();
$pp = new page_processor();
$controller = new Controller();
$error_code = 0;
$result = 0;
$param_query = false;
$param_mode = false;
$param_page = false;


$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, check if account is verified
if($pp->logged_in){
    if(!$pp->is_verified_account($pp->user_id)){
        // Account is not verified
        header("Location: ".$link->path('email_verify_page')); // Redirect to verification page
        die();
    } else{
        // Account is verified
        // Check if any GET data is there
        if(!empty($_GET)){
            // Check ih there are any parameters
            if(!empty($_GET['q']) || !empty($_GET['m']) || $_GET['page']){
                // Check if there is any query
                if(!empty($_GET['q'])){
                    $param_query = $_GET['q'];
                }
                // Check if there is any mode
                if(!empty($_GET['m'])){
                    $param_mode = $_GET['m'];
                }
                // Check if there is any page
                if(!empty($_GET['page'])){
                    $param_page = $_GET['page'];
                }
            }
        }
    }
} else {
    header("Location: ".$link->path('login_page')); // Redirect to login page
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'components/scripts/essentials.php'; ?>
    <title>Search | Pixihire</title>
    <link rel="stylesheet" href="<?php echo $link->path('search_css'); ?>">
</head>

<body>
<!-- Navigation bar -->
<?php
    include 'components/sections/navigation_bar.php';
    echo navbar_component($pp->logged_in, ($pp->logged_in?$controller->get_user_details($pp->user_id)["profile_pic"]:""));
?>
    <div id="main-container" class="main-container" style="width: 100%;height: 100%;min-height: 100vh;transition-duration:1s;transition-timing-function: cubic-bezier(0.54, 0.15, 0.3, 0.65);">
    <h1 style="font-weight: bold;color: rgb(177,177,177);margin-bottom: 30px;transition-duration: 0.5s;opacity: 1;text-align: center;width: auto;height: auto;">Finding for someting? Search it.</h1>
    <div class="container" style="position: relative;">
        <div class="d-flex justify-content-center align-items-center search-accessories" style="transition-duration: 1s;position: absolute;width: 100%;height: 100%;z-index: 10;pointer-events: none;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" style="position: absolute;left: 25px;font-size: 20px;color: var(--color-lite-blue);">
                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                <path d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"></path>
            </svg><select id="search-mode" class="search-mode" style="position: absolute;right: 32px;padding: 9px 14px;border-radius: 100px;background: linear-gradient(91deg, #46ccf9, #1686fe);border-style: none;color: rgb(255,255,255);font-weight: bold;text-align: center;outline: none;pointer-events: auto;appearance: none;">
                <option value="1" selected="">Projects</option>
                <option value="2">Freelancers</option>
            </select></div><input id="search-input" type="text" style="height: 55px;border-radius: 25px;position: relative;width: 100%;outline: none;padding-right: 180px;padding-left: 65px;border: 1px solid rgb(204,204,204) ;" placeholder="Search anything..." <?php echo ($param_query?'value="'.$param_query.'"':''); ?> <?php echo ($param_mode?'data-mode="'.$param_mode.'"':''); ?> <?php echo ($param_page?'data-page="'.$param_page.'"':''); ?> data-url="<?php echo $link->path('search_api'); ?>"/>
    </div>
    <div class="container result-section" style="display: none;transition-duration: 2s;">
        <h6 id="result-counter" class="search-analytics" style="margin-top: 10px;margin-left: 20px;color: rgb(153,153,153);pointer-events:none;">Showing 10 of 100 results</h6>
        <div class="d-none" id="user-result-holder" style="margin-top: 60px;" data-defaultimg="<?php echo $link->path('avatar_img'); ?>" data-profileurl="<?php echo $link->path('profile_page'); ?>">
        </div>
        <div class="d-none" id="project-result-holder" style="margin-top: 60px;" data-projectUrl="<?php echo $link->path('project_page'); ?>" data-userUrl="<?php echo $link->path('profile_page'); ?>">
        </div>
        <div class="d-none justify-content-center align-items-center" id="pre-loader-holder" style="margin-top: 60px;">
            <div style="position: relative;width: 70px;height: 70px; background-color: #F7F7F7;">
                <div style="width: 50%;height: 50%;background-color: var(--color-lite-blue);" class="roller"></div>
            </div>
        </div>
        <div class="d-flex justify-content-around align-items-center" id="result-navigators" style="margin-top: 50px;"><button id="prev-page-button" class="btn btn-primary" type="button" style="padding: 10px 30px;border-radius: 10px;border-left-style: none;">Prev</button><button  id="next-page-button" class="btn btn-primary" type="button" style="padding: 10px 30px;border-radius: 10px;border-left-style: none;">Next</button></div>
    </div>
</div>
<script src="<?php echo $link->path('search_function_js'); ?>"></script>
</body>

</html>
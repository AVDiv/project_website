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
$result = 9;

$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, check if account is verified
if($pp->logged_in){
    if(!$pp->is_verified_account($pp->user_id)){
        // Account is not verified
        header("Location: ".$link->path('email_verify_page')); // Redirect to verification page
        die();
    } else{
        // Account is verified
        // Check if any POST request is made
        if(!empty($_POST)){
        // Check if all required data is given
            echo 12;
            if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['budget'])){
                $result = $controller->create_project($pp->user_id, $_POST['title'], $_POST['description'], $_POST['budget']);
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
    <title>Post project | Pixihire</title>
</head>

<body>
<div class="container" style="padding-top: 100px;">
    <h1 style="text-align: center;font-weight: bold; margin-bottom: 50px;">Post a project</h1>
    <form class="d-flex justify-content-center align-items-center" method="post">
        <div style="padding: 45px;padding-bottom: 0;border-radius: 20px;box-shadow: 0px 2px 10px rgba(33,37,41,0.1);width: 1000px;min-height: 498px;">
            <div>
                <h5>Name:</h5><input name="title" class="form-control" type="text" minlength="8" maxlength="60">
            </div>
            <div>
                <h5>Description:</h5><textarea name="description" class="form-control" style="height: 183px;" minlength="8" maxlength="120"></textarea>
            </div>
            <div>
                <h5>Budget:</h5><input name="budget" class="form-control" type="text" id="price" placeholder="Rs. 15000" maxlength="10">
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <input class="submit-btn" type="submit" name="submit" value="Post project" style="padding: 10px 15px; margin: 30px;border: none;border-radius: 8px;background-color: var(--color-blue);color: white;font-weight: 600;">
            </div>
        </div>
    </form>
</div>
<script src="<?php echo $link->path('post_project_js'); ?>"></script>
</body>

</html>
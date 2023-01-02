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
$result = 0;
$error_code = 0;

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
            if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['budget'])){
                $result = $controller->create_project($pp->user_id, $_POST['title'], $_POST['description'], $_POST['budget']);
                if($result == 1 || $result == 2 || $result == 3 || $result == 4){
                    $error_code = $result;
                } else {
                    header("Location: ".$link->path('project_page')."?id=".$result);
                    die();
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
    <title>Post project | Pixihire</title>
</head>

<body>
<!-- Navigation bar -->
<?php
include 'components/sections/navigation_bar.php';
echo navbar_component($pp->logged_in, ($pp->logged_in?$controller->get_user_details($pp->user_id)["profile_pic"]:""));
?>
<div class="container" style="padding-top: 100px;">
    <h1 style="text-align: center;font-weight: bold; margin-bottom: 50px;">Post a project</h1>
    <p class="<?php echo ($error_code>0? 'd-block': 'd-none'); ?>" style="text-align: center; color: var(--color-red); font-size: 18px">
        <i class="fa-solid fa-circle-exclamation"></i>&nbsp;
        <?php
        if ($error_code == 1){ echo "Please enter a valid project title!";}
        else if ($error_code == 2){ echo "Please enter a valid project description!";}
        else if ($error_code == 3){ echo "Please enter a valid budget!";}
        else if ($error_code == 4){ echo "Cannot create project at this time!";}
        ?>
    </p>
    <form class="d-flex justify-content-center align-items-center" method="post">
        <div style="padding: 45px;padding-bottom: 0;border-radius: 20px;box-shadow: 0px 2px 10px rgba(33,37,41,0.1);width: 1000px;min-height: 498px;">
            <div style="margin-top: 20px;">
                <h6>Name:</h6><input name="title" class="form-control" type="text" minlength="8" maxlength="60" required>
            </div>
            <div style="margin-top: 20px;">
                <h6>Description:</h6><textarea name="description" class="form-control" style="height: 183px;" minlength="120" maxlength="800" required></textarea>
            </div>
            <div style="margin-top: 20px;">
                <h6>Budget:</h6><input name="budget" class="form-control" type="text" id="price" placeholder="Rs. 15000" maxlength="12" required>
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
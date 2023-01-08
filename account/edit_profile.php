<?php
session_start();
// Imports
include_once dirname(__DIR__).'/components/scripts/links.php';
include_once dirname(__DIR__).'/components/scripts/page_processing.php';
include_once dirname(__DIR__).'/backend/controller.php';
// Initializations
$link = new Links();
$pp = new page_processor();
$controller = new Controller();

$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, check if account is verified
if($pp->logged_in){
    $user = $controller->get_user_details($pp->user_id);
    if(!$pp->is_verified_account($pp->user_id)){
        // Account is not verified
        header("Location: ".$link->path('email_verify_page')); // Redirect to verification page
        die();
    }
} else {
    // User is not logged in
    header("Location: ".$link->path('login_page')."?redirect=https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); // Redirect to login page
    die();
}
?>

<html lang="en">

<head>
    <?php include_once dirname(__DIR__).'/components/scripts/essentials.php'; ?>
    <title>Edit Profile | Pixihire</title>
    <link rel="stylesheet" href="<?php echo $link->path('profile_css'); ?>">
</head>

<body style="padding-bottom: 100px;overflow-x: clip;">
<?php
include_once dirname(__DIR__).'/components/sections/navigation_bar.php';
echo navbar_component($pp->logged_in, $user['profile_pic']);
?>
<header style="width: 100vw;">
    <div class="position-relative d-md-flex flex-md-row" style="padding-top: 120px">
        <div id="profile-picture" class="d-flex justify-content-center align-items-center pfpContainer" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.15);overflow: hidden;background-image: url('<?php echo $link->path('avatar_img') ?>'); background-position: center; background-size: cover; background-repeat: no-repeat;"><input class="form-control" id="image-input-profile" type="file" accept="image/*" name="picture-data" style="opacity: 0;height: 100%;width: 100%;"><i class="fa-solid fa-pen-to-square" style="position: absolute; pointer-events: none; font-size: 42px; opacity: 0.25;"></i></div>
        <div class="nt">
            <p style="font-size: 25px;margin-bottom: 7px;color: #051b3b;"><?php echo $user['firstname']." ".$user['lastname'];?></p>
            <p style="font-size: 18px;color: #71a0e6;">@<?php echo $user['username'];?></p>
        </div>
    </div>
    <div class="headerBack" style="width: 100vw;"></div>
</header>
<div class="content" style="max-width: 1212px;">
    <div class="descriptionSec" style="min-width:100%; max-width: 1100px;margin-top: 20px;margin-bottom: 20px;">
        <p class="description text-center text-lg-start" style="text-align: justify;"><textarea class="form-control" placeholder="Describe yourself."></textarea></p>
    </div>
    <div class="portfolioSec" style="max-width: 1125px;margin-top: 40px;box-shadow: 3px 5px 10px rgba(0,0,0,0.13);">
        <p style="color: #051b3b;font-size: 20px;margin-left: 15px;margin-bottom: 40px;">Portfolio</p>
        <div class="p-row d-flex justify-content-center align-items-center flex-wrap">
            <div class="p-item d-flex flex-column justify-content-center align-items-center" id="add-item-button-portfolio" style="transition: all 0.5s ease-out;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center" style="position: absolute;"><i class="fas fa-plus" style="font-size: 40px;color: var(--bs-white);"></i>
                    <h4 style="font-weight: bold;color: var(--bs-white);text-align: center;">Add item</h4>
                </div><button class="btn btn-primary" type="button" style="width: 100%;height: 100%;background: #0448DA;border-radius: 26px;"></button>
            </div>
        </div>
    </div>
    <div class="portfolioSec" style="max-width: 1125px;margin-top: 40px;box-shadow: 3px 5px 10px rgba(0,0,0,0.13);">
        <p style="color: #051b3b;font-size: 20px;margin-left: 15px;margin-bottom: 40px;">Experience</p>
        <div class="d-flex justify-content-center align-items-center flex-wrap p-row">
            <div id="add-item-button-experience" class="d-flex justify-content-center align-items-center e-item" style="transition: all 0.5s ease-out;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="d-flex d-xxl-flex flex-row justify-content-center align-items-center" style="position: absolute;"><i class="fas fa-plus" style="font-size: 24px;color: var(--bs-white);margin-right: 5px;"></i>
                    <h4 style="font-weight: bold;color: var(--bs-white);text-align: center;margin-bottom: 0px;">Add item</h4>
                </div><button class="btn btn-primary" type="button" style="width: 100%;height: 100%;background: #0448DA;border-radius: 20px;"></button>
            </div>
        </div>
    </div>
    <div class="portfolioSec" style="max-width: 1125px;margin-top: 40px;box-shadow: 3px 5px 10px rgba(0,0,0,0.13);">
        <p style="color: #051b3b;font-size: 20px;margin-left: 15px;margin-bottom: 40px;">Education</p>
        <div class="d-flex justify-content-center align-items-center flex-wrap p-row">
            <div id="add-item-button-education" class="d-flex justify-content-center align-items-center ed-item" style="transition: all 0.5s ease-out;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="d-flex d-xxl-flex flex-row justify-content-center align-items-center" style="position: absolute;"><i class="fas fa-plus" style="font-size: 24px;color: var(--bs-white);margin-right: 5px;"></i>
                    <h4 style="font-weight: bold;color: var(--bs-white);text-align: center;margin-bottom: 0px;">Add item</h4>
                </div><button class="btn btn-primary" type="button" style="width: 100%;height: 100%;background: #0448DA;border-radius: 20px;"></button>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-around align-items-center" style="margin: 50px auto;">
        <button class="btn btn-primary" type="button" style="background: rgb(4,72,218);padding: 15px 30px;border-radius: 10px;font-weight: bold;">Save Changes</button>
        <button class="btn btn-primary" type="button" style="background: rgb(205,215,225);padding: 15px 30px;border-radius: 10px;font-weight: bold;color: var(--bs-btn-disabled-color);border-style: none;">Reset to default</button>
    </div>
</div>
<script src="<?php echo $link->path('profile_edit_js'); ?>"></script>
</body>

</html>
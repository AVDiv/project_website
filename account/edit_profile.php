<?php
session_start();
// Imports
include_once dirname(__DIR__).'/components/scripts/links.php';
include_once dirname(__DIR__).'/components/scripts/page_processing.php';
include_once dirname(__DIR__) . '/backend/controller.php';
// Initializations
$link = new Links();
$pp = new page_processor();
$controller = new Controller();;

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
    header("Location: ".$link->path('login_page')."?redirect=".$link->path('profile_edit_page')); // Redirect to login page
    die();
}
?>

<html lang="en">
<head>
    <?php
        include_once dirname(__DIR__).'/components/scripts/essentials.php';
    ?>
    <title>Edit your profile</title>
</head>

<body>
    <?php
        include_once dirname(__DIR__).'/components/sections/navigation_bar.php';
        echo navbar_component($pp->logged_in, $user['profile_pic']);
    ?>
    <section id="head" style="position: relative;">
        <div style="background: #e7eef9;position: absolute;height: 270px;width: 100%;z-index: -10;"></div>
        <div class="container" style="padding-top: 124px;z-index: 0;">
            <div class="row d-flex justify-content-center justify-content-lg-start">
                <div class="col-md-6 d-flex" style="width: 280px;">
                    <div class="d-flex justify-content-center align-items-center" id="profile-picture" style="height: 300px;width: 250px;background: #ffffff;border-top-left-radius: 10px;border-bottom-left-radius: 10px;border-bottom-right-radius: 50px;box-shadow: 5px 5px 10px rgba(33,37,41,0.1);border-top-right-radius: 50px;position: relative;background-image: url('<?php echo $link->path('avatar_img') ?>'); background-position: center; background-size: cover; background-repeat: no-repeat;"><input class="form-control" id="image-input-profile" type="file" accept="image/*" name="picture-data" style="opacity: 0;height: 100%;width: 100%;"><i class="fa-solid fa-pen-to-square" style="position: absolute; pointer-events: none; font-size: 42px; opacity: 0.25;"></i></div>
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <h2 class="justify-content-sm-center" id="profile-name" style="font-weight: bold;margin-top: 40px;border-color: rgb(5,27,59);">Full name</h2>
                    <div class="d-flex flex-row align-items-center"><input class="form-control justify-content-sm-center" type="text" id="profile-tagline" style="font-size: 24px;background: rgba(255,255,255,0);border-radius: 8px;border: none; color: var(--color-lite-blue);" name="tagline" placeholder="Tagline"><div id="tagline_edit_button"><i class="fa-solid fa-pen-to-square" style="padding-left: 8px; cursor: pointer; font-size: 36px; opacity: 0.25;"></i></div></div>
                </div>
            </div>
        </div>
    </section>
    <section id="achivements" style="width: 100%;padding-top: 50px;">
        <div class="container" id="description" style="margin-top: 30px;">
            <p></p><textarea class="form-control" placeholder="Describe yourself."></textarea>
        </div>
        <div class="container" id="portfolio" style="margin-top: 30px;padding: 20px;background: #eff4ff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);">
            <h3 style="font-weight: bold;border-color: rgb(5,27,59);margin-left: 20px;">Portfolio</h3>
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <div class="d-flex flex-column justify-content-center align-items-center" id="add-item-button-portfolio" style="transition: all 0.5s ease-out;height: 200px;background: #ffffff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);width: 180px;margin: 25px;position: relative;">
                    <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center" style="position: absolute;"><i class="fas fa-plus" style="font-size: 40px;color: var(--bs-white);"></i>
                        <h4 style="font-weight: bold;color: var(--bs-white);text-align: center;">Add item</h4>
                    </div><button class="btn btn-primary" type="button" style="width: 100%;height: 100%;background: #0448DA;border-radius: 26px;"></button>
                </div>
            </div>
        </div>
        <div class="container" id="experience" style="margin-top: 30px;padding: 20px;background: #eff4ff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
            <h3 style="font-weight: bold;border-color: rgb(5,27,59);margin-left: 20px;">Experience</h3>
            <div class="d-flex flex-row justify-content-center align-items-center flex-wrap" style="margin-top: 22px;">
                <div id="add-item-button-experience" class="d-flex justify-content-center align-items-center " style="transition: all 0.5s ease-out;height: 100px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div class="d-flex d-xxl-flex flex-row justify-content-center align-items-center" style="position: absolute;"><i class="fas fa-plus" style="font-size: 24px;color: var(--bs-white);margin-right: 5px;"></i>
                        <h4 style="font-weight: bold;color: var(--bs-white);text-align: center;margin-bottom: 0px;">Add item</h4>
                    </div><button class="btn btn-primary" type="button" style="width: 100%;height: 100%;background: #0448DA;border-radius: 20px;"></button>
                </div>
            </div>
        </div>
        <div class="container" id="education" style="margin-top: 30px;padding: 20px;background: #eff4ff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
            <h3 style="font-weight: bold;border-color: rgb(5,27,59);">Education</h3>
            <div class="d-flex flex-row justify-content-center align-items-center flex-wrap" style="margin-top: 22px;">
                <div id="add-item-button-education" class="d-flex justify-content-center align-items-center" style="transition: all 0.5s ease-out;height: 140px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div class="d-flex d-xxl-flex flex-row justify-content-center align-items-center" style="position: absolute;"><i class="fas fa-plus" style="font-size: 24px;color: var(--bs-white);margin-right: 5px;"></i>
                        <h4 style="font-weight: bold;color: var(--bs-white);text-align: center;margin-bottom: 0px;">Add item</h4>
                    </div><button class="btn btn-primary" type="button" style="width: 100%;height: 100%;background: #0448DA;border-radius: 20px;"></button>
                </div>
            </div>
        </div>
    </section>
    <div class="container d-flex justify-content-around align-items-center" style="margin: 50px auto;"><button class="btn btn-primary" type="button" style="background: rgb(4,72,218);padding: 15px 30px;border-radius: 10px;font-weight: bold;">Save Changes</button><button class="btn btn-primary" type="button" style="background: rgb(205,215,225);padding: 15px 30px;border-radius: 10px;font-weight: bold;color: var(--bs-btn-disabled-color);border-style: none;">Reset to default</button></div>
    <script src="<?php echo $link->path('profile_edit_js'); ?>"></script>
</body>
</html>
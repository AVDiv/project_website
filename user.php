<?php
session_start();
// Imports
include_once 'components/scripts/links.php';
include_once 'components/scripts/page_processing.php';
include_once 'backend/controller.php';
include_once 'backend/mitigator.php';
// Initializations
$link = new Links();
$pp = new page_processor();
$controller = new Controller();;
$profile_user = null;

$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, check if account is verified
if($pp->logged_in){
    if(!$pp->is_verified_account($pp->user_id)){
        // Account is not verified
        header("Location: ".$link->path('email_verify_page')); // Redirect to verification page
        die();
    }
}

if (!empty($_GET['u'])){
    $user_id = $controller->get_from_username($_GET['u']);
    if ($user_id===false){
        // Redirect to 404 page
        header("HTTP/1.1 404 Not Found");
        header("Location: ". $link->path('404_page'));
        die();
    }else{
        $profile_user = $controller->get_user_details($user_id);
    }
} else {
    // Redirect to 404 page
//    echo "asda";
    header("HTTP/1.1 404 Not Found");
    header("Location: ". $link->path('404_page'));
    die();
}
?>
<html lang="en">
<head>
    <?php include_once 'components/scripts/essentials.php'; ?>
    <title><?php echo $profile_user['username']; ?> @ Pixihire</title>
    <link rel="stylesheet" href="<?php echo $link->path('profile_css'); ?>">
</head>

<body style="padding-bottom: 100px;">
<?php
include_once 'components/sections/navigation_bar.php';
echo navbar_component($pp->logged_in, $controller->get_user_details($pp->user_id)['profile_pic']);
?>
<header style="width: 100vw;">
    <div class="position-relative d-md-flex flex-md-row" style="padding-top: 120px">
        <div class="d-xxl-flex justify-content-xxl-center align-items-xxl-center pfpContainer" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.15);overflow: hidden;"><img class="pfp" src="<?php echo (($profile_user['profile_pic']==='')?$link->path('avatar_img'):$profile_user['profile_pic']); ?>"></div>
        <div class="nt">
            <p style="font-size: 25px;margin-bottom: 7px;color: #051b3b;"><?php echo html_mitigation($profile_user['firstname']." ".$profile_user["lastname"]); ?></p>
            <p style="font-size: 18px;color: #71a0e6;">@<?php echo html_mitigation($profile_user['username']); ?></php></p>
        </div>
    </div>
    <div class="headerBack" style="width: 100vw;"></div>
</header>
<div class="content" style="max-width: 1212px;">
    <div class="descriptionSec" style="min-width:100%; max-width: 1100px;margin-top: 20px;margin-bottom: 20px;">
        <p class="description text-center text-lg-start" style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor neque vitae tempus quam. Turpis massa sed elementum tempus egestas sed. Sed cras ornare arcu dui vivamus arcu felis bibendum. Porttitor lacus luctus accumsan tortor posuere ac ut. Vitae nunc sed velit dignissim sodales ut. Mi proin sed libero enim sed faucibus turpis in eu. Augue eget arcu dictum varius duis at consectetur lorem donec. Diam sollicitudin tempor id eu nisl nunc mi ipsum faucibus. Quis commodo odio aenean sed. Vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt. Varius sit amet mattis vulputate enim nulla aliquet. Pretium lectus quam id leo in. Ut ornare lectus sit amet est placerat in egestas erat. Quam quisque id diam vel quam elementum pulvinar etiam non. Aliquam ut porttitor leo a diam. Suscipit tellus mauris a diam. Lacus vestibulum sed arcu non odio euismod lacinia at quis. Et netus et malesuada fames ac turpis egestas.</p>
    </div>
    <div class="portfolioSec" style="max-width: 1125px;margin-top: 40px;box-shadow: 3px 5px 10px rgba(0,0,0,0.13);">
        <p style="color: #051b3b;font-size: 20px;margin-left: 15px;margin-bottom: 40px;">Portfolio</p>
        <div class="p-row">
            <div class="p-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <img src="" alt="" style="width: 100%;height: 75%;">
                <div class="d-flex justify-content-center align-items-center p-text-container">
                    <p class="d-xxl-flex" style="margin-bottom: 0px;height: auto;color: #71a0e6;font-size: 14px;">Portfolio Item 1</p>
                </div>
            </div>
            <div class="p-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <img src="" alt="" style="width: 100%;height: 75%;">
                <div class="d-flex justify-content-center align-items-center p-text-container">
                    <p class="d-xxl-flex" style="margin-bottom: 0px;height: auto;color: #71a0e6;font-size: 14px;">Portfolio Item 2</p>
                </div>
            </div>
            <div class="p-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <img src="" alt="" style="width: 100%;height: 75%;">
                <div class="d-flex justify-content-center align-items-center p-text-container">
                    <p class="d-xxl-flex" style="margin-bottom: 0px;height: auto;color: #71a0e6;font-size: 14px;">Portfolio Item 3</p>
                </div>
            </div>
            <div class="p-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <img src="" alt="" style="width: 100%;height: 75%;">
                <div class="d-flex justify-content-center align-items-center p-text-container">
                    <p class="d-xxl-flex" style="margin-bottom: 0px;height: auto;color: #71a0e6;font-size: 14px;">Portfolio Item 1</p>
                </div>
            </div>
        </div>
        <div class="p-row">
            <div class="p-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <img src="" alt="" style="width: 100%;height: 75%;">
                <div class="d-flex justify-content-center align-items-center p-text-container">
                    <p class="d-xxl-flex" style="margin-bottom: 0px;height: auto;color: #71a0e6;font-size: 14px;">Portfolio Item 1</p>
                </div>
            </div>
            <div class="p-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <img src="" alt="" style="width: 100%;height: 75%;">
                <div class="d-flex justify-content-center align-items-center p-text-container">
                    <p class="d-xxl-flex" style="margin-bottom: 0px;height: auto;color: #71a0e6;font-size: 14px;">Portfolio Item 1</p>
                </div>
            </div>
            <div class="p-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <img src="" alt="" style="width: 100%;height: 75%;">
                <div class="d-flex justify-content-center align-items-center p-text-container">
                    <p class="d-xxl-flex" style="margin-bottom: 0px;height: auto;color: #71a0e6;font-size: 14px;">Portfolio Item 1</p>
                </div>
            </div>
            <div class="p-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <img src="" alt="" style="width: 100%;height: 75%;">
                <div class="d-flex justify-content-center align-items-center p-text-container">
                    <p class="d-xxl-flex" style="margin-bottom: 0px;height: auto;color: #71a0e6;font-size: 14px;">Portfolio Item 1</p>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolioSec" style="max-width: 1125px;margin-top: 40px;box-shadow: 3px 5px 10px rgba(0,0,0,0.13);">
        <p style="color: #051b3b;font-size: 20px;margin-left: 15px;margin-bottom: 40px;">Experience</p>
        <div class="d-flex flex-wrap p-row">
            <div class="d-flex align-items-center e-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">Sample Corp.</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #71a0e6;">Position</p>
                    </div>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #cdd7e1;">From 2XXX to 2XXX</p>
                </div>
            </div>
            <div class="d-flex align-items-center e-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">Sample Corp.</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #71a0e6;">Position</p>
                    </div>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #cdd7e1;">From 2XXX to 2XXX</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap p-row">
            <div class="d-flex align-items-center e-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">Sample Corp.</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #71a0e6;">Position</p>
                    </div>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #cdd7e1;">From 2XXX to 2XXX</p>
                </div>
            </div>
            <div class="d-flex align-items-center e-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">Sample Corp.</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #71a0e6;">Position</p>
                    </div>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #cdd7e1;">From 2XXX to 2XXX</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap p-row">
            <div class="d-flex align-items-center e-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">Sample Corp.</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #71a0e6;">Position</p>
                    </div>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #cdd7e1;">From 2XXX to 2XXX</p>
                </div>
            </div>
            <div class="d-flex align-items-center e-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">Sample Corp.</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #71a0e6;">Position</p>
                    </div>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #cdd7e1;">From 2XXX to 2XXX</p>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolioSec" style="max-width: 1125px;margin-top: 40px;box-shadow: 3px 5px 10px rgba(0,0,0,0.13);">
        <p style="color: #051b3b;font-size: 20px;margin-left: 15px;margin-bottom: 40px;">Education</p>
        <div class="d-flex flex-wrap p-row">
            <div class="d-flex align-items-center ed-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">BSc. in Mokak hari ekak</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;">4 Years</p>
                    </div>
                    <p style="margin-bottom: 3px;margin-left: 0px;font-size: 15px;color: #71a0e6;">NSBM Green University - Sri Lanka</p>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #71a0e6;">2XXX - 2XXX</p>
                </div>
            </div>
            <div class="d-flex align-items-center ed-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">BSc. in Mokak hari ekak</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;">4 Years</p>
                    </div>
                    <p style="margin-bottom: 3px;margin-left: 0px;font-size: 15px;color: #71a0e6;">NSBM Green University - Sri Lanka</p>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #71a0e6;">2XXX - 2XXX</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap p-row">
            <div class="d-flex align-items-center ed-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">BSc. in Mokak hari ekak</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;">4 Years</p>
                    </div>
                    <p style="margin-bottom: 3px;margin-left: 0px;font-size: 15px;color: #71a0e6;">NSBM Green University - Sri Lanka</p>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #71a0e6;">2XXX - 2XXX</p>
                </div>
            </div>
            <div class="d-flex align-items-center ed-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 45px;">
                    <div class="e-txt-heading" style="font-size: 18px;margin-bottom: 3px;">
                        <p class="e-txt-heading-item" style="margin-left: 0px;">BSc. in Mokak hari ekak</p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;"><strong>•</strong></p>
                        <p class="e-txt-heading-item" style="color: #cdd7e1;">4 Years</p>
                    </div>
                    <p style="margin-bottom: 3px;margin-left: 0px;font-size: 15px;color: #71a0e6;">NSBM Green University - Sri Lanka</p>
                    <p style="margin-bottom: 0px;margin-left: 0px;font-size: 15px;color: #71a0e6;">2XXX - 2XXX</p>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolioSec" style="max-width: 1125px;margin-top: 40px;box-shadow: 3px 5px 10px rgba(0,0,0,0.13);">
        <p style="color: #051b3b;font-size: 20px;margin-left: 15px;margin-bottom: 40px;">Reviews</p>
        <div class="d-flex flex-wrap p-row">
            <div class="d-flex align-items-center r-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 22px;">
                    <div class="d-inline-flex e-txt-heading" style="font-size: 18px;margin-bottom: 0px;">
                        <div style="width: 40px;height: 40px;box-shadow: 4px 4px 4px rgba(0,0,0,0.1);border-radius: 100px;border: 1px solid #cdd7e1;"></div>
                        <p class="e-txt-heading-item" style="margin-left: 20px;margin-top: 3px;">Your Name</p>
                    </div>
                    <p id="fw-less-3" style="margin-bottom: 3px;margin-left: 59px;font-size: 15px;color: #71a0e6;font-weight: 000;text-align: left;margin-top: -8px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor &nbsp;<br></p>
                </div>
            </div>
            <div class="d-flex align-items-center r-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 22px;">
                    <div class="d-inline-flex e-txt-heading" style="font-size: 18px;margin-bottom: 0px;">
                        <div style="width: 40px;height: 40px;box-shadow: 4px 4px 4px rgba(0,0,0,0.1);border-radius: 100px;border: 1px solid #cdd7e1;"></div>
                        <p class="e-txt-heading-item" style="margin-left: 20px;margin-top: 3px;">Your Name</p>
                    </div>
                    <p id="fw-less-1" style="margin-bottom: 3px;margin-left: 59px;font-size: 15px;color: #71a0e6;font-weight: 000;text-align: left;margin-top: -8px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor &nbsp;<br></p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap p-row">
            <div class="d-flex align-items-center r-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 22px;">
                    <div class="d-inline-flex e-txt-heading" style="font-size: 18px;margin-bottom: 0px;">
                        <div style="width: 40px;height: 40px;box-shadow: 4px 4px 4px rgba(0,0,0,0.1);border-radius: 100px;border: 1px solid #cdd7e1;"></div>
                        <p class="e-txt-heading-item" style="margin-left: 20px;margin-top: 3px;">Your Name</p>
                    </div>
                    <p id="fw-less-2" style="margin-bottom: 3px;margin-left: 59px;font-size: 15px;color: #71a0e6;font-weight: 000;text-align: left;margin-top: -8px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor &nbsp;<br></p>
                </div>
            </div>
            <div class="d-flex align-items-center r-item" style="box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
                <div class="e-txt-container" style="margin-left: 22px;">
                    <div class="d-inline-flex e-txt-heading" style="font-size: 18px;margin-bottom: 0px;">
                        <div style="width: 40px;height: 40px;box-shadow: 4px 4px 4px rgba(0,0,0,0.1);border-radius: 100px;border: 1px solid #cdd7e1;"></div>
                        <p class="e-txt-heading-item" style="margin-left: 20px;margin-top: 3px;">Your Name</p>
                    </div>
                    <p id="fw-less-4" style="margin-bottom: 3px;margin-left: 59px;font-size: 15px;color: #71a0e6;font-weight: 000;text-align: left;margin-top: -8px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor &nbsp;<br></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
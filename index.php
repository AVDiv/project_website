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

$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, check if account is verified
if($pp->logged_in){
    if(!$pp->is_verified_account($pp->user_id)){
        // Account is not verified
        header("Location: ".$link->path('email_verify_page')); // Redirect to verification page
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'components/scripts/essentials.php'; ?>
    <title>Home | Pixihire</title>
    <link rel="stylesheet" href="<?php echo $link->path('home_css') ?>">
</head>
<body>
<!-- Navigation bar -->
<?php
include 'components/sections/navigation_bar.php';
echo navbar_component($pp->logged_in, ($pp->logged_in?$controller->get_user_details($pp->user_id)["profile_pic"]:""));
?>
<!-- Hero -->
<section id="hero" style="width: 100%;height: 100%;z-index: 0;"><img src="<?php echo $link->path('hero_bg'); ?>" alt="background_image">
    <div class="justify-content-between align-items-xl-center">
        <div id="Context">
            <h1 class="fw-bold" style="color: var(--color-dark-blue);font-size: 45px;font-weight: 600;">Want to get some task done?</h1>
            <p class="fw-bold" style="color: var(--color-white);font-size: 22px;margin: 30px 0;font-weight: 600;">Find and hire top-rated freelancers for your business needs. Streamline your outsourcing with our platform.&nbsp;<br></p>
            <div id="Button"><a class="text-uppercase fw-bold" href="<?php echo $link->path('signup_page'); ?>" style="color: var(--color-white);text-decoration: none;background: var(--color-dark-blue);padding: 10px 20px;border-radius: 5px;border-style: none;font-size: 17px;font-weight: 600;">get started&nbsp;<i class="fa-solid fa-arrow-right"></i></a></div>
        </div>
        <div class="d-xxl-flex justify-content-xxl-center align-items-xxl-center" id="Image"><img src="<?php echo $link->path('hero_img'); ?>" style="width: 100%;" alt="image"></div>
    </div>
</section>
<section class="d-flex flex-column justify-content-center align-items-center Skills" id="skill" style="width: 100%;max-width: none;">
    <h1>Show your skills</h1>
    <p>Join pixihire and earn from your skills related to these subjects</p>
    <div class="d-grid d-xxl-flex flex-row justify-content-evenly justify-items-center flex-wrap raw">
        <div class="d-flex flex-column justify-content-xl-center align-items-xl-center justify-content-xxl-center align-items-xxl-center skill class"><i class="fa-solid fa-code"></i>
            <h1>DEVELOPING &amp; PROGRAMMING</h1>
            <p><i class="fas fa-star"></i>&nbsp;4.9/5 Rating</p>
        </div>
        <div class="d-flex flex-column justify-content-xl-center align-items-xl-center justify-content-xxl-center align-items-xxl-center skill class"><i class="fa-solid fa-bezier-curve"></i>
            <h1>GRAPHICS &amp; DESIGNING</h1>
            <p><i class="fas fa-star"></i>&nbsp;4.9/5 Rating</p>
        </div>
        <div class="d-flex flex-column justify-content-xl-center align-items-xl-center justify-content-xxl-center align-items-xxl-center skill class"><i class="fa-solid fa-pencil"></i>
            <h1>CONTENT WRITING</h1>
            <p><i class="fas fa-star"></i>&nbsp;4.9/5 Rating</p>
        </div>
        <div class="d-flex flex-column justify-content-xl-center align-items-xl-center justify-content-xxl-center align-items-xxl-center skill class"><i class="fa-solid fa-microphone"></i>
            <h1>AUDIO &amp; MUSIC</h1>
            <p><i class="fas fa-star"></i>&nbsp;4.9/5 Rating</p>
        </div>
        <div class="d-flex flex-column justify-content-xl-center align-items-xl-center justify-content-xxl-center align-items-xxl-center skill class"><i class="fa-solid fa-photo-film"></i>
            <h1>VIDEO &amp; ANIMATION</h1>
            <p><i class="fas fa-star"></i>&nbsp;4.9/5 Rating</p>
        </div>
        <div class="d-flex flex-column justify-content-xl-center align-items-xl-center justify-content-xxl-center align-items-xxl-center skill class"><i class="fa-solid fa-bullhorn"></i>
            <h1>DIGITAL MARKETING</h1>
            <p><i class="fas fa-star"></i>&nbsp;4.9/5 Rating</p>
        </div>
    </div>
</section>
<!-- Footer -->
<?php
include 'components/sections/footer.php';
echo footer_component();
?>
</body>
</html>

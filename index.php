<?php
//    session_start();
//    include_once 'components/page_processing.php';
//    $pp = new page_processor();
//    $pp->is_logged_in($_COOKIE); // Check if user is logged in

?>

<html>
<head>
    <?php include_once 'components/essentials.php'; ?>
    <title>Home | Pixihire</title>
    <?php
    include_once 'components/links.php';
    $link = new Links();
    echo '<link rel="stylesheet" href="'. $link->path('home_css') .'">';
    ?>
</head>
<body>
<!-- Navigation bar -->
<?php
include 'components/navigation_bar.php';
echo navbar_component(false);
?>
<!-- Hero -->
<section id="hero" style="width: 100%;height: 100%;z-index: 0;"><img src=<?php echo $link->path('hero_bg'); ?>>
    <div class="justify-content-between align-items-xl-center">
        <div id="Context">
            <h1 class="fw-bold" style="color: var(--color-dark-blue);font-size: 45px;font-weight: 600;">Want to get some task done?</h1>
            <p class="fw-bold" style="color: var(--color-white);font-size: 22px;margin: 30px 0px;font-weight: 600;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis molestie mi vel erat blandit dignissim. Donec quis imperdiet eros, a facilisis ligula.&nbsp;<br></p>
            <div id="Button"><a class="text-uppercase fw-bold" href="#" style="color: var(--color-white);text-decoration: none;background: var(--color-dark-blue);padding: 10px 20px;border-radius: 5px;border-style: none;font-size: 17px;font-weight: 600;">get started&nbsp;<i class="fa-solid fa-arrow-right"></i></a></div>
        </div>
        <div class="d-xxl-flex justify-content-xxl-center align-items-xxl-center" id="Image"><img src=<?php echo $link->path('hero_img'); ?> style="width: 100%;"></div>
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
            <h1>GRAPHICS &amp; DESIGING</h1>
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
</body>
</html>

<?php
    // Imports
    include dirname(__DIR__).'/components/scripts/links.php';
    include_once dirname(__DIR__).'/components/scripts/page_processing.php';

    // Initializations
    $pp = new page_processor();
    $link = new Links();
?>
<html lang="en">

<head>
    <?php
    include dirname(__DIR__).'/components/scripts/essentials.php'
    ?>
    <link rel="stylesheet" href="<?php echo $link->path('404_css'); ?>">
    <title>404 Not Found | Pixihire</title>
</head>
<body>
    <!-- Navigation bar -->
    <?php
        include dirname(__DIR__).'/components/sections/navigation_bar.php';
        echo navbar_component($pp->logged_in, ($pp->logged_in?$controller->get_user_details($pp->user_id)["profile_pic"]:""));
    ?>
    <div class="d-flex">
        <div class="d-flex text-container">
            <h1 class="hero glitch layers" data-text="404"><span>404</span></h1>
            <p class="mid-text">Page not found</p>
            <p class="below-text">The page you are finding for does not exist!</p>
        </div>
        <div class="d-flex image-container">
            <img class="404-img" src="<?php echo $link->path('404_img'); ?>" alt="404 Image">
        </div>
    </div>
</body>

</html>

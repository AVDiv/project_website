<?php
    // Imports
    include '../components/links.php';
    include_once '../components/page_processing.php';

    // Initializations
    $pp = new page_processor();
    $link = new Links();
?>
<html lang="en">

<head>
    <?php
        include '../components/essentials.php'
    ?>
    <link rel="stylesheet" href="<?php echo $link->path('404_css')?>">
    <title>404 Not Found | Pixihire</title>
</head>
<body>
    <!-- Navigation bar -->
    <?php
        include '../components/navigation_bar.php';
        echo navbar_component(false);
    ?>
    <div class="d-flex">
        <div class="d-flex text-container">
            <h1>404</h1>
            <p class="mid-text">Page not found</p>
            <p class="below-text">The page you are finding for does not exist!</p>
        </div>
        <div class="d-flex image-container">
            <img class="404-img" src="<?php echo $link->path('404_img'); ?>" alt="404 Image">
        </div>
    </div>
</body>

</html>
<?php
    // Imports
    include '../components/links.php';
    include '../components/page_processing.php';
    // Initializations
    $link = new Links();
    $pp = new page_processor();
?>
<html class="text-center" lang="en">

<head>
    <?php include '../components/essentials.php'; ?>
    <link rel="stylesheet" href="<?php echo $link->path('email_verify_css'); ?>">
    <title>Verify your email address | Pixihire</title>
</head>
<body>
    <!-- Navigation bar -->
    <?php
        include '../components/navigation_bar.php';
        echo navbar_component(false);
    ?>
    <div class="text-nowrap fs-2 d-xxl-flex justify-content-center align-items-center align-self-center justify-content-xxl-center align-items-xxl-center h1" style="width: 100vw; height: 100vh">
        <div class="container d-flex justify-content-center align-items-center" style="width: 100%;height: 100%;">
            <img class="bg" src="<?php echo $link->path('email_img') ?>" loading="lazy">
            <div class="txtContainer">
                <h1 class="mainHead" style="font-size: 64px;font-weight: bold;margin-bottom: 24px;">We’ve sent an email !</h1>
                <p style="font-size: 24px;"><strong>We sent a link to your email in order to verify this is your email address.</strong></p>
                <p style="font-size: 20px;color: #71A0E6;line-height: 30px;"><strong>You will be redirected to another page to create the account</strong><br><strong>Follow those instructions to continue</strong></p>
            </div>
        </div>
    </div>
</body>

</html>
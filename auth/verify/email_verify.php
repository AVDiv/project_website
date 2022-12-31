<?php
    // Imports
    include_once dirname(__DIR__, 2).'/components/scripts/links.php';
    include_once dirname(__DIR__, 2).'/components/scripts/page_processing.php';
    include_once dirname(__DIR__, 2).'/backend/account.php';
    // Initializations
    $link = new Links();
    $pp = new page_processor();
    $controller = new Account();
    $error_code = 0;
    $email = "";
    $profile_pic = "";
    if (empty($_GET['send_otp'])){
        $_GET=array('send_otp'=>'false');
    } elseif ($_GET['send_otp']!=="true"){
        $_GET['send_otp']='false';
    }

    // Program
    $pp->is_logged_in($_COOKIE); // Check if user is logged in
    // If not logged in, Redirect to login page
    if(!$pp->logged_in){
        header("Location: ".$link->path('login_page')); // Redirect to login page
        die();
    } else {
        $is_verified = $controller->check_email_verification($pp->user_id);
        // If logged in, Check if email is verified
        if($is_verified){
            // If email is verified, Redirect to 404 page
            header("HTTP/1.1 404 Not Found"); // Redirect to 404-page
            header("Location: ".$link->path('404_page')); // Redirect to 404-page
            die();
        }
        else{
            // If not verified, show the verification page
            // Check if form is submitted
            if(!empty($_POST)){
                // Form is submitted
                // Get all the data
                $otp = $_POST['otp'];
                // Verify the OTP
                $result = $controller->verify_otp($pp->user_id, $otp);
                echo $result;
                if ($result===0){
                    // OTP verified successfully
                    // Redirect to dashboard page
                    header("Location: ".$link->path('home_page')); // Redirect to dashboard page
                    die();
                } elseif($result>0) {
                    $error_code = $result;
                    // Get email address and assign to the data-email attribute for API support
                    $user_dat = $controller->get_user_details($pp->user_id);
                    $email = $user_dat['email'];
                    $profile_pic = $user_dat['profile_pic'];
                }
                echo $error_code;
            } else {
                // Form is not submitted
                // Get email address and assign to the data-email attribute for API support
                $user_dat = $controller->get_user_details($pp->user_id);
                $email = $user_dat['email'];
                $profile_pic = $user_dat['profile_pic'];
            }
        }
    }
?>
<html class="text-center" lang="en">

<head>
    <?php include dirname(__DIR__, 2).'/components/scripts/essentials.php'; ?>
    <link rel="stylesheet" href="<?php echo $link->path('email_verify_css'); ?>">
    <title>Verify your email address | Pixihire</title>
</head>
<body <?php echo $_GET['send_otp']==='true'?"onload='resendOtp()'":""; ?> >
    <!-- Navigation bar -->
    <?php
        include dirname(__DIR__, 2).'/components/sections/navigation_bar.php';
        echo navbar_component($pp->logged_in, $profile_pic);
    ?>
    <div class="text-nowrap fs-2 d-xxl-flex justify-content-center align-items-center align-self-center justify-content-xxl-center align-items-xxl-center h1" style="width: 100vw; height: 100vh">
        <div class="container d-flex justify-content-center align-items-center" style="width: 100%;height: 100%;">
            <img class="bg" src="<?php echo $link->path('email_img') ?>" loading="lazy" alt="bg_img">
            <div class="txtContainer">
                <h1 class="mainHead" style="font-size: 64px;font-weight: bold;margin-bottom: 24px;">We’ve sent an email !</h1>
                <p style="font-size: 24px;"><strong>We sent a link to your email in order to verify this is your email address.</strong></p>
                <p style="font-size: 20px;color: #71A0E6;line-height: 30px;"><strong>You will be redirected to another page to create the account</strong><br><strong>Follow those instructions to continue</strong></p>
                <form method="post" action="">
                    <div class="otp-holder">
                        <div class="input-field">
                            <input type="text" id="otp" name="otp" minlength="6" maxlength="6" required/>
                            <label for="otp">Pin code</label>
                        </div>
                        <input type="submit" id="verify" name="submit"/>
                    </div>
                    <div class="resend-holder">
                        <button name="resend" id="resend" onclick="resendOtp()" data-url="<?php echo $link->path('otp_resend_api'); ?>" data-email="<?php echo $email; ?>" disabled>Resend code</button>
                        <div class="resend-timer">
                            <span id="mins">02</span>:<span id="secs">00</span>
                        </div>
                    </div>
                    <div class="error-holder">
                        <i class="fa-solid fa-circle-exclamation"></i><p id="error-text"></p>
                    </div>
                    <script src="<?php echo $link->path('email_verify_js'); ?>"></script>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
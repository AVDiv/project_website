<?php
    session_start();
    include dirname(__DIR__, 1).'/components/scripts/links.php';
    include_once dirname(__DIR__, 1).'/components/scripts/page_processing.php';
    include_once dirname(__DIR__, 1).'/backend/account.php';
    // Initializations
    $pp = new page_processor();
    $link = new Links();
    $controller = new Account();
    $error_code = 0;
    $cookie_name = 'LOGSESSID';
    // Program
    $pp->is_logged_in($_COOKIE); // Check if user is logged in
    // If logged in, redirect to dashboard page
    if($pp->logged_in){
        header("Location: ".$link->path('dashboard_page')); // Redirect to dashboard page
        die();
    }
    // If not logged in, Can create a new account
    // Check if form is submitted
    if(!empty($_POST)){
        // Form is submitted
        // Get all the data
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone_no = $_POST['phone'];
        $dob = $_POST['dob'];
        $password = $_POST['pass'];
        $confirm_password = $_POST['cpass'];
        // Create account
        $result = $controller->create_account($firstname, $lastname, $username, $email, $phone_no, $dob, $password, $confirm_password);
        if ($result===0){
            // Account created successfully
            // Create a login session and redirect to email verification page
            $result = $controller->create_login_session($email, $password);
            if (is_string($result)){
                // Login attempt successful
                setcookie($cookie_name, $result, time() + (86400 * 30), "/"); // 86400 = 1 day, 86400 * 30 = 30 days
            }
            header("Location: ".$link->path('email_verify_page')."?send_otp=true"); // Redirect to verification page
            die();
        } elseif($result>0) $error_code = $result;
    }

?>
<html lang="en">
<head>
    <?php
    include dirname(__DIR__, 1).'/components/scripts/essentials.php'
    ?>
    <link href="<?php echo $link->path('signup_css'); ?>" rel="stylesheet"/>
    <title>Signup | Pixihire</title>
</head>
<body>
<!-- Navigation bar -->
<?php
    include dirname(__DIR__, 1).'/components/sections/navigation_bar.php';
    echo navbar_component($pp->logged_in, $link->path('avatar_img'));
?>
<div id="signup" class="d-xxl-flex">
    <div id="imageCol" style="background-image: url(<?php echo $link->path('signup_img'); ?>);">
    </div>
    <div class="col d-xl-flex d-xxl-flex align-items-xxl-center">
        <div class="container">
            <h1 class="d-flex justify-content-center mainHead" style="text-align: center;color: #051B3B;margin-top: 90px;">Join Pixihire.</h1>
            <h1 class="secondHead" style="margin-top: 40px;">Sign up with</h1>
            <div class="d-xxl-flex justify-content-xxl-center align-items-xxl-center buttonContainer">
                <a class="sm" href="#" style="padding-bottom: 0;"><button class="btn btn-primary d-xxl-flex justify-content-xxl-center align-items-xxl-center smBtn" type="button"><i class="fa-brands fa-google" style="font-size: 20px;"></i>Google</button></a>
                <a class="sm" href="#" style="padding-bottom: 0;"><button class="btn btn-primary d-xxl-flex justify-content-xxl-center align-items-xxl-center smBtn" type="button" style="width: 160px;"><i class="fa-brands fa-facebook" style="font-size: 22px;"></i>Facebook</button></a>
                <a class="sm" href="#" style="padding-bottom: 0;"><button class="btn btn-primary d-xxl-flex justify-content-xxl-center align-items-xxl-center smBtn" type="button"><i class="fa-brands fa-apple" style="font-size: 22px;"></i>Apple</button></a></div>
            <h1 class="d-flex d-xxl-flex justify-content-center justify-content-xxl-center secondHead" style="margin-top: 30px;">Or</h1>
            <h1 class="secondHead" style="margin-top: 40px;margin-bottom: 20px;">Create account by giving these details</h1>
            <p class="about">Give accurate information as it will be taken for futher verifications of your profile.<br></p>
            <h1 class="secondHead" style="margin-top: 40px;margin-bottom: 4px;font-size: 16px;"><span style="color: rgb(255, 0, 0);">*</span> for required fields</h1>
            <form class="signupForm" method="POST" action="">
                <div style="overflow: visible;">
                    <div>
                        <div class="d-xxl-flex justify-content-xxl-center">
                            <div class="<?php echo $error_code===1?'error':'' ?>"><label class="form-label inputHead"><input class="form-control inputf" type="text" name="fname" required placeholder="John" minlength="2" maxlength="40" style="width: 220px;"><p class="float-placeholder">First Name <span>*</span></p><p class="error-text"><?php echo $error_code===1?'Name you typed is invalid':'' ?></p></label></div>
                            <div class="<?php echo $error_code===2?'error':'' ?>"><label class="form-label inputHead"><input class="form-control inputf" type="text" name="lname" required placeholder="Lark" minlength="2" maxlength="40" style="width: 220px;"><p class="float-placeholder">Last Name <span>*</span></p><p class="error-text"><?php echo $error_code===2?'Name you typed is invalid':'' ?></p></label></div>
                        </div>
                        <div class="d-xxl-flex justify-content-xxl-center">
                            <div class="<?php echo $error_code===4 || $error_code===14?'error':'' ?>"><label class="form-label inputHead"><input class="form-control inputf" type="email" name="email" required style="width: 480px;" placeholder="example123@email.com" minlength="5" maxlength="50"><p class="float-placeholder">Email <span>*</span></p><p class="error-text"><?php echo $error_code === 4 ? 'Email address you provided is invalid' : ($error_code === 14 ? 'An account with this email exists!' : '') ?></p></label></div>
                        </div>
                        <div class="d-xxl-flex justify-content-xxl-center">
                            <div class="<?php echo $error_code===10 || $error_code===12?'error':'' ?>"><label class="form-label inputHead"><input class="form-control inputf" type="password" name="pass" required minlength="3" maxlength="20" style="width: 220px;"><p class="float-placeholder">Password <span>*</span></p><p class="error-text"><?php echo $error_code===10? 'This field can\'t be empty!' : ($error_code===12 ? 'Password you provided was invalid' : '' ) ?></p></label></div>
                            <div class="<?php echo $error_code===9 || $error_code===11?'error':'' ?>"><label class="form-label inputHead"><input class="form-control inputf" type="password" name="cpass" required minlength="3" maxlength="20" style="width: 220px;"><p class="float-placeholder">Confirm Password <span>*</span></p><p class="error-text"><?php echo $error_code===9?'The passwords did not match':($error_code===11? 'This field can\'t be empty!': '') ?></p></label></div>
                        </div>
                        <div class="d-xxl-flex justify-content-xxl-center">
                            <div class="<?php echo $error_code==3 || $error_code===13?'error':'' ?>"><label class="form-label inputHead"><input class="form-control inputf" type="text" name="username" required minlength="2" maxlength="20" placeholder="_uSer_123_" style="width: 480px;"><p class="float-placeholder">Username <span>*</span></p><p class="error-text"><?php echo $error_code === 3 ? 'Username you typed is invalid' : ($error_code === 13 ? 'This username is taken!' : '') ?></p></label></div>
                        </div>
                        <div class="d-xxl-flex justify-content-xxl-center">
                            <div class="<?php echo $error_code===5 || $error_code===15?'error':'' ?>"><label class="form-label inputHead"><input class="form-control inputf" type="tel" name="phone" required placeholder="+XXX (XXX) XXX XXXX" minlength="18" maxlength="19" style="width: 220px;"><p class="float-placeholder">Phone number <span>*</span></p><p class="error-text"><?php echo $error_code===5?'Phone number you typed is invalid!': ($error_code===15?'An account with this number exists!':'') ?></p></label></div>
                            <div class="<?php echo $error_code===6 || $error_code===7 || $error_code===8?'error':'' ?>"><label class="form-label inputHead"><input class="form-control inputf" type="date" name="dob" required style="width: 220px;"><p class="float-placeholder">Date of birth <span>*</span></p><p class="error-text"><?php if($error_code===6){
                                echo 'Invalid format!';
                            }elseif ($error_code===7){
                                echo 'You must be at least 13 years';
                            }elseif($error_code===8){
                                echo 'No one over 100 years of age is allowed!';
                            }else{
                                echo '';
                            } ?></p></label></div>
                        </div>
                        <div class="d-xxl-flex justify-content-xxl-evenly">
                            <div class="d-xxl-flex align-items-xxl-center" style="width: 190px;"><button class="btn btn-primary submitBtn" id="submitBtn" type="submit" style="margin-right: 0;margin-left: 10px;">Next</button></div>
                            <div class="d-xxl-flex align-items-xxl-center">
                                <h1 class="secondHead" style="margin-top: 0;margin-bottom: 0;font-size: 16px;padding-left: 0;"><strong>Already got an account?</strong><a id="login" href="<?php echo $link->path('login_page') ?>" style="padding-bottom: 0;">Login</a></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

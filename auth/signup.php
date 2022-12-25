<?php
include '../components/links.php';
$link = new Links();
?>
<html lang="en">
<head>
    <?php
    include '../components/essentials.php'
    ?>
    <link href="../assets/css/signup.css" rel="stylesheet"/>
    <title>Signup | Pixihire</title>
</head>
<body>
<div class="d-xxl-flex">
    <div class="col-xxl-5 d-flex justify-content-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center align-items-xxl-center" id="imageCol" style="background: var(--bs-white);"><img class="d-xxl-flex justify-content-xxl-center align-items-xxl-center bgArt" src="<?php echo $link->path('signup_img'); ?>" width="605" height="437" style="margin-left: 89px;"></div>
    <div class="col d-xl-flex d-xxl-flex align-items-xxl-center">
        <div class="container">
            <h1 class="d-flex justify-content-center mainHead" style="text-align: center;color: #051B3B;">Join Pixihire.</h1>
            <h1 class="secondHead" style="margin-top: 40px;">Sign up with</h1>
            <div class="d-xxl-flex justify-content-xxl-center align-items-xxl-center buttonContainer"><a class="sm" href="#google" style="padding-bottom: 0px;"><button class="btn btn-primary d-xxl-flex justify-content-xxl-center align-items-xxl-center smBtn" type="button"><img class="d-xxl-flex align-items-xxl-center icon" src="assets/img/google.png" width="22" height="22">Google</button></a><a class="sm" href="#facebook" style="padding-bottom: 0px;"><button class="btn btn-primary d-xxl-flex justify-content-xxl-center align-items-xxl-center smBtn" type="button" style="width: 160px;"><img class="d-xxl-flex align-items-xxl-center icon" src="assets/img/facebook.png" width="22" height="22">Facebook</button></a><a class="sm" href="#apple" style="padding-bottom: 0px;"><button class="btn btn-primary d-xxl-flex justify-content-xxl-center align-items-xxl-center smBtn" type="button"><img class="d-xxl-flex align-items-xxl-center icon" src="assets/img/apple.png" width="22" height="22">Apple</button></a></div>
            <h1 class="d-flex d-xxl-flex justify-content-center justify-content-xxl-center secondHead" style="margin-top: 30px;">Or</h1>
            <h1 class="secondHead" style="margin-top: 40px;margin-bottom: 20px;">Create account by giving these details</h1>
            <p class="about">Give accurate information as it will be taken for futher verifications of your profile.<br></p>
            <h1 class="secondHead" style="margin-top: 40px;margin-bottom: 4px;font-size: 14px;"><span style="color: rgb(255, 0, 0);">*</span> for required fields</h1>
            <form class="signupForm" method="GET">
                <div class="table-responsive" style="width: 550px;overflow: hidden;">
                    <table class="table">
                        <thead>
                        <tr></tr>
                        </thead>
                        <tbody style="width: 374px;">
                        <tr class="d-xxl-flex justify-content-xxl-start" style="width: 460px;">
                            <td style="width: 230px;"><label class="form-label inputHead">First Name *<input class="form-control inputf" type="text" placeholder="First Name *" name="fname" required="" style="width: 185px;"></label></td>
                            <td><label class="form-label inputHead">Last Name *<input class="form-control inputf" type="text" placeholder="Last Name *" name="lname" required="" style="width: 185px;"></label></td>
                        </tr>
                        <tr class="d-xxl-flex justify-content-xxl-start" style="width: 460px;">
                            <td colspan="2" style="width: 230px;"><label class="form-label inputHead">Email *<input class="form-control inputf" type="email" placeholder="Email *" name="email" required="" style="width: 415px;"></label></td>
                        </tr>
                        <tr class="d-xxl-flex justify-content-xxl-start" style="width: 460px;">
                            <td style="width: 230px;"><label class="form-label inputHead">Password *<input class="form-control inputf" type="password" placeholder="Password *" name="pass" required="" style="width: 185px;"></label></td>
                            <td><label class="form-label inputHead">Confirm Password *<input class="form-control inputf" type="password" placeholder="Confirm Password *" name="cpass" required="" style="width: 185px;"></label></td>
                        </tr>
                        <tr class="d-xxl-flex justify-content-xxl-start" style="width: 460px;">
                            <td colspan="2" style="width: 230px;"><label class="form-label inputHead">Email *<input class="form-control inputf" type="email" placeholder="Email *" name="email" required="" style="width: 415px;"></label></td>
                        </tr>
                        <tr class="d-xxl-flex justify-content-xxl-start" style="width: 460px;">
                            <td style="width: 230px;"><label class="form-label inputHead">Password *<input class="form-control inputf" type="password" placeholder="Password *" name="pass" required="" style="width: 185px;"></label></td>
                            <td><label class="form-label inputHead">Confirm Password *<input class="form-control inputf" type="password" placeholder="Confirm Password *" name="cpass" required="" style="width: 185px;"></label></td>
                        </tr>
                        <tr class="d-xxl-flex justify-content-xxl-start" style="width: 460px;">
                            <td class="d-xxl-flex align-items-xxl-center" style="width: 190px;"><button class="btn btn-primary submitBtn" id="submitBtn" type="submit" style="margin-right: 0px;margin-left: 10px;">Next</button></td>
                            <td class="d-xxl-flex align-items-xxl-center" style="width: 270px;">
                                <h1 class="secondHead" style="margin-top: 0px;margin-bottom: 0px;font-size: 14px;padding-left: 0px;"><strong>Already got an account?</strong><a id="login" href="#loginpage" style="padding-bottom: 0px;">Login</a></h1>
                            </td>
                        </tr>
                        <tr></tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
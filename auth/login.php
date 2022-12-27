<?php
  // Imports
  include '../components/links.php';
  include_once '../components/page_processing.php';
    include_once '../backend/account.php';
  // Initializations
  $link = new Links();
  $controller = new Account();
  $pp = new page_processor();
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
      $identity = $_POST['identity'];
      $password = $_POST['pass'];
      // Create account
      $result = $controller->create_login_session($identity, $password);
      if (is_string($result)){
          // Login attempt successful
          setcookie($cookie_name, $result, time() + (86400 * 30), "/"); // 86400 = 1 day, 86400 * 30 = 30 days
          header("Location: ".!empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:$link->path('dashboard_page')); // Redirect to verification page
          die();
      }else{
          // Login attempt failed
          $error_code = $result;
      }

  }
?>
<html>
<head>
  <?php 
  include '../components/essentials.php'
  ?>
  <link href="<?php echo $link->path('login_css'); ?>" rel="stylesheet"/>
  <title>Login | Pixihire</title>
</head>
<body>
  <div style="background-image: url('<?php echo $link->path('login_img'); ?>');" class="background container-fluid h-100">
    <div class="login-section">
      <!-- Logo section -->
      <div class="logo-card">
        <img src="<?php echo $link->path('logo'); ?>" alt="Pixihire Logo" class="logo"/>
      </div>
      <!-- Login card -->
      <div class="login-card">
        <!-- Log in text -->
        <div class="login-text <?php echo $error_code!==0?'error':'' ?>">
          <p>Login to Pixihire</p>
            <p class="error-text"><i class="fa-solid fa-circle-exclamation"></i>&nbsp;
            <?php
                if ($error_code === 1) {
                    echo 'Email/Username or Password is incorrect';
                } elseif ($error_code === 2) {
                    echo 'Account is banned';
                } elseif ($error_code === 3) {
                    echo 'Cannot log in to account at this time';
                }
            ?></p>
        </div>
        <!-- Login form -->
        <div class="row credentials">
          <form action="" method="post">
            <div class="input-field-holder">
              <div class="input-field">
                <input type="text" name="identity" required>
                <label for="username">Username/Email</label>
              </div>
              <div class="input-field">
                <input type="password" name="pass" required>
                <label for="password">Password</label>
              </div>
            </div>
            <div class="login-btn">
              <input type="submit" name="login" value="">
              <label for="login">Login</label>
            </div>
          </form>
        </div>
        <!-- Forgot password -->
        <div class="forgot-password">
          <p>Forgot your password? <a href="#">Click here</a></p>
        </div>
         <!-- Seperator -->
        <div class="seperator">
          <hr>
        </div>
        <!-- Login with -->
        <div class="log-with">
          <p>Login with</p>
          <div class="accounts">
            <div class="account-circle">
              <a href="#"><i class="fab fa-google"></i></a>
            </div>
            <div class="account-circle">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>
            <div class="account-circle">
              <a href="#"><i class="fab fa-apple"></i></a>
            </div>
          </div>
        </div>
        <!-- Create account -->
        <div class="no-account">
          <p>Haven't got an account? <a href="<?php echo $link->path('signup_page'); ?>">Create account</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
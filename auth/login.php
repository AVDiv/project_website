<?php

?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script type="text/javascript" src="../vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
  <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="../assets/css/master.css" rel="stylesheet"/>
  <link href="../assets/css/login.css" rel="stylesheet"/>
  <?php 
    include '../components/fa-config/fa_script.php'; // Fontawesome icon scripts
  ?>
  <title>Login | Pixihire</title>
</head>
<body>
  <div class="background container-fluid h-100">
    <div class="container login-section">
      <!-- Logo section -->
      <div class="logo-card">
        <img src="../assets/images/logo.png" alt="Pixihire Logo" class="logo"/>
      </div>
      <!-- Login card -->
      <div class="login-card">
        <!-- Log in text -->
        <div class="login-text">
          <p>Login to Pixihire</p>
        </div>
        <!-- Login form -->
        <div class="row credentials">
          <form action="" method="post">
            <div class="input-field-holder">
              <div class="input-field">
                <input type="text" name="username" required>
                <label for="username">Username/Email</label>
              </div>
              <div class="input-field">
                <input type="password" name="password" required>
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
          <p>Haven't got an account? <a href="#">Create account</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
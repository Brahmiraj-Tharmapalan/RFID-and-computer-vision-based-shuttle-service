<?php
session_start();
if (isset($_SESSION['Admin-name'])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>

<html>

<head>
  <title>Log In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' type='text/css' href="css/bootstrap.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/header.css" />
  <script src="js/jquery-2.2.3.min.js"></script>
  <script>
    $(window).on("load resize ", function () {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({ 'padding-right': scrollWidth });
    }).resize();
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $(document).on('click', '.message', function () {
        $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
        $('h1').animate({ height: "toggle", opacity: "toggle" }, "slow");
      });
    });
  </script>
</head>

<body>
  <main>
    <div class="header">
      <div class="logo">
        <img class="logo1" src="./icons/logo.png" alt="123" />
      </div>
    </div>
    <h1 class="slideInDown animated">Admin View Only</h1>
    <h1 class="slideInDown animated" id="reset">Enter your Email to send the reset password link</h1>
    <!-- Log In -->

    <section>
      <div class="slideInDown animated">
        <div class="imagelog">
          <img class="image" src="./icons/login.gif" alt="123" />
          <div>
            <div class="login-page">
              <div class="form">
                <?php
                if (isset($_GET['error'])) {
                  if ($_GET['error'] == "invalidEmail") {
                    echo '<div class="alert alert-danger">
                        This E-mail is invalid!!
                      </div>';
                  } elseif ($_GET['error'] == "sqlerror") {
                    echo '<div class="alert alert-danger">
                        There a database error!!
                      </div>';
                  } elseif ($_GET['error'] == "wrongpassword") {
                    echo '<div class="alert alert-danger">
                        Wrong password!!
                      </div>';
                  } elseif ($_GET['error'] == "nouser") {
                    echo '<div class="alert alert-danger">
                        This E-mail does not exist!!
                      </div>';
                  }
                }
                if (isset($_GET['reset'])) {
                  if ($_GET['reset'] == "success") {
                    echo '<div class="alert alert-success">
                        Check your E-mail!
                      </div>';
                  }
                }
                if (isset($_GET['account'])) {
                  if ($_GET['account'] == "activated") {
                    echo '<div class="alert alert-success">
                        Please Login
                      </div>';
                  }
                }
                if (isset($_GET['active'])) {
                  if ($_GET['active'] == "success") {
                    echo '<div class="alert alert-success">
                        The activation like has been sent!
                      </div>';
                  }
                }
                ?>
                <div class="alert1"></div>
                <form class="reset-form" action="reset_pass.php" method="post" enctype="multipart/form-data">
                  <input class="input1" type="email" name="email" placeholder="E-mail..." required />
                  <button class="custom-btn btn-3" type="submit" name="login"><span>Reset</span></button>
                  <p class="message"><a href="#"> Back to Login</a></p>
                </form>
                <form class="login-form" action="ac_login.php" method="post" enctype="multipart/form-data">

                  <div class="input1">
                    <input type="email" name="email" id="email" required>
                    <label>
                      <span style="transition-delay:0ms">E</span><span style="transition-delay:50ms">-</span><span
                        style="transition-delay:100ms">m</span><span style="transition-delay:150ms">a</span><span
                        style="transition-delay:200ms">i</span><span style="transition-delay:250ms">l</span>
                    </label>
                  </div>



                  <div class="input1">
                    <input type="password" name="pwd" id="pwd" required>
                    <label>
                      <span style="transition-delay:0ms">P</span><span style="transition-delay:50ms">a</span><span
                        style="transition-delay:100ms">s</span><span style="transition-delay:150ms">s</span><span
                        style="transition-delay:200ms">w</span><span style="transition-delay:250ms">o</span><span
                        style="transition-delay:300ms">r</span><span style="transition-delay:350ms">d</span>
                    </label>
                  </div>

                  <button class="btn-shine" type="submit" name="login"><span>Login</span></button>
                  <p class="message"><a href="#">Reset your password</a></p>
                  <!-- <input class="input1" type="email" name="email" id="email" placeholder="E-mail..." required/> -->
                  <!-- <input class="input2" type="password" name="pwd" id="pwd" placeholder="Password" required/> -->
              </div>
            </div>
          </div>
    </section>
    </div>
    </div>
  </main>
</body>

</html>
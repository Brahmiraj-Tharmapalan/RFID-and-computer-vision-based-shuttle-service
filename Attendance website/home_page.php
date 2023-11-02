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
        <a href="index.php">FYP Shuttle Service</a>
      </div>
    </div>
    <h1 class="slideInDown animated" id="reset">Enter your Email to send the reset password link</h1>
    <!-- Log In -->
    <section>
      <div class="imagelog1">
        <a href="#"><img class="image1" src="./icons/teacher.gif" alt="admin" />
          <div class="text-block1">
            <h4>Admin</h4>
        </a>
      </div>
      <div>
        <div class="imagelog1">
          <a href="#"><img class="image2" src="./icons/student.gif" alt="user" />
            <div class="text-block2">
              <h4>User</h4>
          </a>
        </div>
        <div>
    </section>
    </div>
    </div>
  </main>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Users Logs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="icon" type="image/png" href="icon/ok_check.png"> -->
  <link rel="stylesheet" type="text/css" href="css/userslog.css">

  <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
    </script>
  <script type="text/javascript" src="js/bootbox.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script src="js/user_log.js"></script>
  <script>
    $(window).on("load resize ", function () {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({ 'padding-right': scrollWidth });
    }).resize();
  </script>
  <script>
    $(document).ready(function () {
      $.ajax({
        url: "user_log_up_student.php",
        type: 'POST',
        data: {
          'select_date': 1,
        }
      }).done(function (data) {
        $('#userslog').html(data);
      });
      //set timeout
      setInterval(function () {
        $.ajax({
          url: "user_log_up_student.php",
          type: 'POST',
          data: {
            'select_date': 0,
          }
        }).done(function (data) {
          $('#userslog').html(data);
        });
      }, 10000);
    });
  </script>
</head>

<body>
  <?php include 'header_student.php'; ?>
  <section class="container py-lg-5">
    <div class="slideInRight animated">
      <div id="userslog"></div>
    </div>
  </section>
  </main>
</body>

</html>
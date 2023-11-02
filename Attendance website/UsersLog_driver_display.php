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
      $('.tbl-header_driver').css({ 'padding-right': scrollWidth });
    }).resize();
  </script>
  <script>
    $(document).ready(function () {
      $.ajax({
        url: "user_log_up.php",
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
          url: "user_log_up.php",
          type: 'POST',
          data: {
            'select_date': 0,
          }
        }).done(function (data) {
          $('#userslog').html(data);
        });
      }, 100);
    });
  </script>
</head>

<body>
  <?php include 'header_driver_display.php'; ?>
  <main>
    <section class="container">
      <div id="container123">
        <div id="error-box">
          <div class="dot"></div>
          <div class="dot two"></div>
          <div class="face2">
            <div class="eye"></div>
            <div class="eye right"></div>
            <div class="mouth sad"></div>
          </div>
          <div class="shadow move"></div>
          <h1 class="alert">Driver goes to sleep!</br>Carefull!</h1>
        </div>
      </div>
      <div class="slideInRight animated">
        <div id="userslog"></div>
      </div>
    </section>
  </main>

  <script>
    // Listen for real-time updates in the 'drowsiness' section of the database
    const database = firebase.database();
    const errorBox = document.getElementById('error-box');

    database.ref('drowsiness').on('value', (snapshot) => {
      const drowsinessData = snapshot.val(); // Check if there is an update in the 'drowsiness' section

      if (drowsinessData) {
        // If there is an update, show the error box
        errorBox.style.display = 'block';
      } else {
        // If there is no update, hide the error box
        errorBox.style.display = 'none';
      }
    });
  </script>


<script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.0.2/firebase-database.js"></script>

<script>
  // Initialize Firebase
  const firebaseConfig = {
    apiKey: "AIzaSyBz_WqN-gXmAmzlOmjImiP-REg8tSr0BwE",
    authDomain: "fyp-project-a415d.firebaseapp.com",
    databaseURL: "https://fyp-project-a415d-default-rtdb.firebaseio.com",
    projectId: "fyp-project-a415d",
    storageBucket: "fyp-project-a415d.appspot.com",
    messagingSenderId: "414751786501",
    appId: "1:414751786501:web:3b610c314ee48ccef33e6c"
  };

  firebase.initializeApp(firebaseConfig);
</script>


</body>

</html>

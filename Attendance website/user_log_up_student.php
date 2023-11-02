<?php
session_start();
// $Name = " $_SESSION['Admin-name']";
// echo $Name;
?>
<link rel="stylesheet" type="text/css" href="css/Users.css">
<div class="table-responsive" style="max-height: 500px;">
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Serial Number</th>
        <th>Card UID</th>
        <th>Device Dep</th>
        <th>Date</th>
        <th>Time In</th>
        <th>Time Out</th>
      </tr>
    </thead>
    <tbody class="table-secondary">
      <?php

      //Connect to database
      require 'connectDB.php';
      $searchQuery = " ";
      $Start_date = " ";
      $Card_sel = " ";


      if (isset($_SESSION['Admin-name'])) {
        $name = $_SESSION['Admin-name'];


        $sql = "SELECT * FROM users_logs WHERE username= '$name'";


        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
          // echo '<p class="error">SQL Error</p>';
        } else {
          mysqli_stmt_execute($result);
          $resultl = mysqli_stmt_get_result($result);
          if (mysqli_num_rows($resultl) > 0) {
            while ($row = mysqli_fetch_assoc($resultl)) {

              ?>
              <TR>
                <TD>
                  <?php echo $row['id']; ?>
                </TD>
                <TD>
                  <?php echo $row['username']; ?>
                </TD>
                <TD>
                  <?php echo $row['serialnumber']; ?>
                </TD>
                <TD>
                  <?php echo $row['card_uid']; ?>
                </TD>
                <TD>
                  <?php echo $row['device_dep']; ?>
                </TD>
                <TD>
                  <?php echo $row['checkindate']; ?>
                </TD>
                <TD>
                  <?php echo $row['timein']; ?>
                </TD>
                <TD>
                  <?php echo $row['timeout']; ?>
                </TD>

              </TR>
              <?php

            }
          }
        }
      }

      ?>
    </tbody>
  </table>
</div>
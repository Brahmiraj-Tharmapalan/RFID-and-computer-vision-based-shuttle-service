<?php // Check if login button was clicked
if (isset($_POST['login'])) {
    // Connect to database
    require 'connectDB.php';
    // Get user email and password from form
    $Usermail = $_POST['email'];
    $Userpass = $_POST['pwd'];
    // Check if fields are empty
    if (empty($Usermail) || empty($Userpass)) {
        header("location: login.php?error=emptyfields");
        exit();
    }
    // Check if email is valid
    else if (!filter_var($Usermail, FILTER_VALIDATE_EMAIL)) {
        header("location: login.php?error=invalidEmail");
        exit();
    }
    // If email is valid, check if user exists in database
    else {

        $sql = "SELECT * FROM admin WHERE admin_email=?";
        $result = mysqli_stmt_init($conn);

        // $sql = "SELECT * FROM users WHERE email=?";
        // $result1 = mysqli_stmt_init($conn);

        // Check if query was successful
        if (!mysqli_stmt_prepare($result, $sql)) {
            header("location: login.php?error=sqlerror");
            exit();
        }
        // If query was successful, check if password is correct
        else {
            mysqli_stmt_bind_param($result, "s", $Usermail);
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                if ($Userpass !== $row['admin_pwd']) {
                    header("location: login.php?error=wrongpassword");
                    exit();
                }
                // If password is correct, start session and redirect to index page
                else if ($Userpass == $row['admin_pwd']) {
                    session_start();
                    $_SESSION['Admin-name'] = $row['admin_name'];
                    $_SESSION['Admin-email'] = $row['admin_email'];
                    $_SESSION['Admin-pwd'] = $row['admin_pwd'];
                    header("location: index.php?login=success");
                    exit();
                }
            }
            // If user does not exist, redirect to login page
            else {
                header("location: login.php?error=nouser");
                exit();
            }
        }
    }
    // Close connection
    mysqli_stmt_close($result);
    mysqli_close($conn);
}
// If login button was not clicked, redirect to login page
else {
    header("location: login.php");
    exit();
}

?>
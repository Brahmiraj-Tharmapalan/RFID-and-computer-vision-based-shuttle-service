<?php
session_start();
require('connectDB.php');

if (isset($_POST['update'])) {

    $useremail = $_SESSION['Admin-email'];

    $up_name = $_POST['up_name'];
    $up_email = $_POST['up_email'];
    $up_password = $_POST['up_pwd'];
    $up_password1 = $_POST['up_pwd1'];

    if (empty($up_name) || empty($up_email) || empty($up_password)) {
        header("location: index_student.php?error=emptyfields");
        exit();
    } elseif (!filter_var($up_email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z 0-9]*$/", $up_name)) {
        header("location: index_student.php?error=invalidEN&UN=" . $up_name);
        exit();
    } elseif (!filter_var($up_email, FILTER_VALIDATE_EMAIL)) {
        header("location: index_student.php?error=invalidEN&UN=" . $up_name);
        exit();
    } elseif (!preg_match("/^[a-zA-Z 0-9]*$/", $up_name)) {
        header("location: index_student.php?error=invalidName&E=" . $up_email);
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE email=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            header("location: index_student.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($result, "s", $useremail);
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                $pwdCheck = ($up_password === $row['User_pwd']);
                if ($up_password !== $row['User_pwd'] && !$pwdCheck) {
                    header("location: index_student.php?error=wrongpasswordup");
                    exit();
                } else if ($up_password == $row['User_pwd'] || $pwdCheck) {
                    // $hashedPwd = md5($up_password1);
                    // Check if new password field is empty
                    if (empty($up_password1)) {
                        $up_password1 = $row['User_pwd'];
                    }

                    if ($useremail == $up_email) {
                        $sql = "UPDATE users SET username=?, User_pwd=? WHERE email=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("location: index_student.php?error=sqlerror");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "sss", $up_name, $up_password1, $useremail);
                            mysqli_stmt_execute($stmt);
                            $_SESSION['Admin-name'] = $up_name;
                            header("location: index_student.php?success=updated");
                            exit();
                        }
                    } else {
                        $sql = "SELECT email FROM users WHERE email=?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            header("location: index_student.php?error=sqlerror1");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($result, "s", $up_email);
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            if (!$row = mysqli_fetch_assoc($resultl)) {
                                $sql = "UPDATE users SET username=?, email=?, User_pwd=? WHERE email=?";
                                $stmt = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header("location: index._studentphp?error=sqlerror");
                                    exit();
                                } else {
                                    mysqli_stmt_bind_param($stmt, "ssss", $up_name, $up_email, $useremail, $up_password1);
                                    mysqli_stmt_execute($stmt);
                                    $_SESSION['Admin-name'] = $up_name;
                                    $_SESSION['Admin-email'] = $up_email;
                                    header("location: index_student.php?success=updated");
                                    exit();
                                }
                            } else {
                                header("location: index_student.php?error=nouser2");
                                exit();
                            }
                        }
                    }
                }
            } else {
                header("location: index_student.php?error=nouser1");
                exit();
            }
        }
    }
} else {
    header("location: index_student.php");
    exit();
}
//*********************************************************************************
?>
<?php
session_start();
include("connection.php");
include("functions.php");

$email = "";
$errors = array();

if (isset($_POST['login'])) {
    //something was posted

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (!empty($email) && !empty($password)) {

        //read from database
        $query = "select * from users where email = '$email'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            $fetch_pass = $user_data['password'];

            if (password_verify($password, $fetch_pass)) {
                $_SESSION['email'] = $email;
                $status = $user_data['verification_status'];
                if ($status == 'verified') {


                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header('location: ../php/chat.php?bot_id=2');
                } else {
                    $info = "It looks like you haven't verify your email, yet - $email";
                    $_SESSION['info'] = $info;
                    header('location: ../php/user_otp.php');
                }
            } else {
                $errors['email'] = "Incorrect email or password!";
            }
        } else {
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    } else {
        $errors['email'] = "Please fill up the form to proceed!";
    }
}



//forgot password
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE users SET otp = $code WHERE email = '$email'";
        $run_query =  mysqli_query($con, $insert_code);
        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "From: sophia.granado12@gmail.com";
            if (mail($email, $subject, $message, $sender)) {
                $info = "We've sent a password reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset_code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

//reset code
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE otp = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new_password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered an incorrect code!";
    }
}



//change pass
if (isset($_POST['change_pass'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Passwo not matched!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE users SET otp = $code, password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if ($run_query) {
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: change_success.php');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}


//login
if (isset($_POST['login_user'])) {
    header('Location: login.php');
}

<?php

session_start();
require "../php/function-class/connection.php";
require "../php/function-class/functions.php";

$email = "";
$user_name = "";
$errors = array();

//if user signup button
if (isset($_POST['signup'])) {
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $email = mysqli_real_escape_string($con, $_POST['mail']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_pass = mysqli_real_escape_string($con, $_POST['confirm_pass']);
    $splitpass = str_split($password);

    $haslowercase = false;
    $hasuppercase = false;

    foreach ($splitpass as $char){
        if ($char == strtolower($char)){
            $haslowercase = true;
        }
        if ($char != strtolower($char)){
            $hasuppercase = true;
        }
    }
    if(!$haslowercase){
        $errors['password'] = "A password must have lower case character.";
    }
    if(!$hasuppercase){
        $errors['password'] = "A password must have upper case character.";
    }
    if (!(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password))){
        $errors['password'] = "A password must have special character.";  
    }
    if ($password !== $confirm_pass) {
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);

    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you have entered is already exist!";
    }

    if (count($errors) === 0) {

        if (isset($_FILES['image'])) {

            $img_name = $_FILES['image']['name'];
            $img_type = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];

            if (in_array($img_ext, $extensions) === true) {
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if (in_array($img_type, $types) === true) {
                    $time = time();
                    $new_img_name = $time . $img_name;
                    if (move_uploaded_file($tmp_name, "../images/users/" . $new_img_name)) {
                        $user_id = random_num(20);
                        $encpass = password_hash($password, PASSWORD_BCRYPT);
                        $code = rand(999999, 111111);
                        $status = "notverified";
                        $insert_data = "INSERT INTO users (user_id, user_name, email, password, img, otp, verification_status)
                        values('$user_id', '$user_name', '$email', '$encpass', '$new_img_name', '$code', '$status')";
                        $data_check = mysqli_query($con, $insert_data);
                        if ($data_check) {
                            $subject = "Email Verification Code";
                            $message = "Your verification code is $code";
                            $sender = "From: sophia.granado12@gmail.com";
                            if (mail($email, $subject, $message, $sender)) {
                                $info = "We've sent a verification code to your email - $email";
                                $_SESSION['info'] = $info;
                                $_SESSION['email'] = $email;
                                $_SESSION['password'] = $password;

                                header('location: ../php/user_otp.php');
                                exit();
                            } else {
                                $errors['otp-error'] = "Failed while sending code!";
                            }
                        } else {
                            $errors['db-error'] = "Failed while inserting data into database!";
                        }
                    }
                } else {
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            } else {
                echo "Please upload an image file - jpeg, png, jpg";
            }
        }
    }
}


if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM users WHERE otp = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['otp'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE users SET otp = $code, verification_status = '$status' WHERE otp = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if ($update_res) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header('location: ../php/login.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

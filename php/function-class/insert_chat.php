<?php 

    session_start();
    if(isset($_SESSION['user_id'])){
        include_once "connection.php";
        $outgoing_id = mysqli_real_escape_string($con, $_POST['user_outgoing_id']);
        $incoming_id = mysqli_real_escape_string($con, $_POST['bot_incoming_id']);
        $message = mysqli_real_escape_string($con, $_POST['message']);
        date_default_timezone_set('Asia/Manila'); 
        $time = date('Y-m-d H:i:s', time());
        if(!empty($message)){
            $sql = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_date)
                                        VALUES ('{$incoming_id}', '{$outgoing_id}', '{$message}', '{$time}')") or die();
        }
        // $chatbot_response = exec("");

        // echo $chatbot_response;
    }else{
        header("location: ../login.php");
    }
    
?>
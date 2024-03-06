<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        include_once "connection.php";
        $outgoing_id = $_SESSION['user_id'];
        $incoming_id = mysqli_real_escape_string($con, $_POST['bot_incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.user_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($con, $sql);

        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $time = strtotime($row['msg_date']);
                $new_date = date('h:i A', $time);

                // Display user and bot messages
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="message my_message">
                                    <p>'. $row['msg'].' <br> <span>'.$new_date .'</span></p>
                                </div>';
                }else{
                    $output .= '<div class="message bot_message">
                                    <p>'. $row['msg'].' <br> <span>'.$new_date .'</span></p>
                                </div>';
                }
            }
        }else{

            $que = "SELECT * FROM chatbot WHERE bot_id = {$incoming_id}";
            $sql2 = mysqli_query($con, $que);
            if (mysqli_num_rows($sql2) > 0) {
                $row2 = mysqli_fetch_assoc($sql2);
            }
            
            $output .= '<div class="start_message">
                            <img src="../images/bot/'.$row2['bot_img'].'" alt="" class="bot_header">
                            <h2>Start a conversation with '.$row2['bot_name'].' by sending your first message</h2>
                        </div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>
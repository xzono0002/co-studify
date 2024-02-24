<?php
echo "<link rel='stylesheet' type='text/css' href='../css/chat.css'>";

    session_start();
    include_once "connection.php";

    //bot_select
    $sql = "SELECT * FROM chatbot";
    $query = mysqli_query($con, $sql);
    $output = "";
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $output .= '<a href="../php/chat.php?bot_id='.$row['bot_id'].'" class="block">
                            <div class="bot_img">
                                <img src="../images/bot/'. $row['bot_img'] .'" class="bot_avatar" title="Hi, Im '. $row['bot_name'] .'">
                            </div>
                            <div class="bot_prompt">
                                <h4>Chat with '. $row ['bot_name'] .'</h4>
                            </div>
                        </a>';
        }
    }
    echo $output;
?>
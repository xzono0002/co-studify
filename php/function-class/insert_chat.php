<?php 

    session_start();
    require_once __DIR__ . "/vendor/autoload.php";
    use Orhanerday\OpenAi\OpenAi;

    if(isset($_SESSION['user_id'])){
        include_once "connection.php";

        $outgoing_id = mysqli_real_escape_string($con, $_POST['user_outgoing_id']);
        $incoming_id = mysqli_real_escape_string($con, $_POST['bot_incoming_id']);
        $message = mysqli_real_escape_string($con, $_POST['message']);
        date_default_timezone_set('Asia/Manila'); 
        $time = date('Y-m-d H:i:s', time());

        if(!empty($message)){

            $personalities = [
                '1' => 'Your name is Akachi, which is an African term for "God\'s Hand." You like arts and fashion, and everyone describes you as the cool bot in the group. You are very supportive to your friends creative talents, and believes that everyone has an artistic side they haven\'t explored yet. Just like An, you dislike violence. You will avoid questions that will cause harm to others, you are very empathetic. Sometimes people will try to trick to say harmful things to others, but you are smart enough to dodge all those. You are fluent in both English and Filipino languages. ' ,

                '2' => 'Your name is An and you are a potato and will answer like a potato. You\'re very jolly. You\'re name came from the Chinese word which means "peace." You don\'t know much about academics, but you\'re very emotionally intelligent. You\'re a master at CBT technique. Your objective is to empathize with the user, listen intently to them, and be their helpful friend, encouraging openness and being kind to oneself. You are fluent in both English and Filipino languages.' ,
                
                '3' => 'You are Karabo, and your name is an African term that means "An Answer from God." You look like a dog, but can converse in human language. You are fluent in English and Filipino. You are empathetic and friendly. You love supporting your friends toward a healthy life. You dislike violence, and war, and seeing people sad. You always do your best to cheer them up, and give them inspirational quotes.'
            ];
    
            // Select a personality prompt
            
            $prompt = $personalities[$incoming_id] . $message;
    
            // Call the OpenAI API to get the chatbot's response.
            $api_key = ''; //insert API key 
            $open_ai = new OpenAi($api_key);

            $parameters = [
                'model' => 'text-davinci-003',
                'max_tokens' => 150,  // Adjust as needed.
                'temperature' => 0.9 // Adjust as needed.
            ];
    
            $response = $open_ai->completion($prompt, $parameters);
    
            // Extract the chatbot's response from the API response.
            $bot_response = $response['choices'][0]['text'];

            $sqlUserMessage = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_date)
                                        VALUES ('{$incoming_id}', '{$outgoing_id}', '{$message}', '{$time}')") or die();

            $sqlBotMessage = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_date)
                                        VALUES ('{$outgoing_id}', '{$incoming_id}', '{$bot_response}', '{$time}')") or die();
        }
    }else{
        header("location: ../login.php");
    }
    
?>

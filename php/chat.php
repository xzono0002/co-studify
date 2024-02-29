<?php
session_start();
include("../php/function-class/connection.php");
include("../php/function-class/functions.php");
$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/chat.css">
    <link rel="icon" type="image/x-icon" href="../images/fav.ico">
    <script src="https://kit.fontawesome.com/01f2bb5cfc.js" crossorigin="anonymous"></script>

    <title>kaagapAI</title>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <main>
        <section class="hero_container" id="Hero">
            <?php
            $botId = mysqli_real_escape_string($con, $_GET['bot_id']);
            $que = "SELECT * FROM users, chatbot WHERE user_id = {$_SESSION['user_id']} AND bot_id = {$botId}";
            $sql = mysqli_query($con, $que);
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            }
            ?>

            <div id="tutorial" class="tutorial">
                <div class="tuto intro">
                    <div class="img_container">
                        <img src="../images/hello.png" alt="">
                    </div>
                    <div class="details">
                        <p>Hi, <?php echo $row['user_name'] ?>. I'm Emran and welcome to kaagapAI! I will be guiding you today as we navigate through all the features and make the most out of your experience with us. Let's dive in and start exploring together!</p>
                        <div class="navigate">
                            <p>1/5</p>
                            <button class="forward"><i class="fa-solid fa-greater-than"></i></button>
                        </div>
                    </div>
                </div>

                <div class="tuto section-a">
                    <div class="img_container">
                        <img src="../images/chatbot3.png" alt="">
                    </div>
                    <div class="details">
                        <p>This is your menu section. Here you can find the general navigation to the website: your <strong> home button, chat, account setting, and logout.</strong></p>
                        <div class="navigate">
                            <button class="back"><i class="fa-solid fa-less-than"></i></button>
                            <p>2/5</p>
                            <button class="forward"><i class="fa-solid fa-greater-than"></i></button>
                        </div>
                    </div>
                </div>

                <div class="tuto section-b">
                    <div class="img_container">
                        <img src="../images/chatbot3.png" alt="">
                    </div>
                    <div class="details">
                        <p>Select a bot in the chats section to open conversation.</p>
                        <div class="navigate">
                            <button class="back"><i class="fa-solid fa-less-than"></i></button>
                            <p>3/5</p>
                            <button class="forward"><i class="fa-solid fa-greater-than"></i></button>
                        </div>
                    </div>
                </div>

                <div class="tuto section-c">
                    <div class="img_container">
                        <img src="../images/chatbot3.png" alt="">
                    </div>
                    <div class="details">
                        <p>You can choose to delete the entire conversation or start a secret one that will automatically be deleted after 24 hours.</p>
                        <div class="navigate">
                            <button class="back"><i class="fa-solid fa-less-than"></i></button>
                            <p>4/5</p>
                            <button class="forward"><i class="fa-solid fa-greater-than"></i></button>
                        </div>
                    </div>
                </div>

                <div class="tuto section-d">
                    <div class="img_container">
                        <img src="../images/chatbot3.png" alt="">
                    </div>
                    <div class="details">
                        <p>Start your journey by sending your first message to any of our bots.</p>
                        <div class="navigate">
                            <button class="back"><i class="fa-solid fa-less-than"></i></button>
                            <p>5/5</p>
                            <button class="done">DONE</i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="wrapper" class="wrapper">
                <div class="menu">
                    <div class="menu-icon">
                        <div class="block_a">
                            <div class="block_img">
                                <a onclick=showSidebar() href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" fill="#BAC6D1"/></svg></a>
                            </div>
                        </div>
                    </div>

                    <div class="item navigation">
                        <div class="block_b">
                            <div class="block_img">
                                <a href="../php/onboarding.php" class="logo"><i id="block_icon" class="fa-solid fa-house" title="Home"></i></a>
                            </div>
                        </div>

                        <div class="block_b">
                            <div class="block_img">
                                <i id="block_icon" class="fa-solid fa-comment" title="Chat"></i>
                            </div>
                        </div>

                        <div class="block_b">
                            <div class="block_img">
                                <i id="block_icon" class="fa-solid fa-gear" title="Settings"></i>
                            </div>
                        </div>
                    </div>

                    <div class="item bottom">
                        <div class="block_profile">
                            <div class="user_img">
                                <img src="../images/users/<?php echo $row['img'] ?>" class="user_avatar" alt="<?php echo $row['user_name'] ?>" title="<?php echo $row['user_name'] ?>">
                            </div>
                        </div>

                        <div class="block_b">
                            <div id="help" class="block_img">
                                <i id="block_icon" class="fa fa-regular fa-circle-question" title="Tutorial"></i>
                            </div>
                        </div>

                        <div class="block_b">
                            <div class="block_img">
                                <a href="../php/function-class/logout.php?logout_id=<?php $row['user_id'] ?>"><i id="block_icon" class="fa fa-solid fa-arrow-right-from-bracket" title="Logout"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="nav_menu">
                    <header class="nav">
                        <div class="nav_wrapper">
                            <nav>
                                <h3 class="logo">Chats</h3>
                                <a onclick=onHidebar() href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" fill="#BAC6D1"/></svg></a>
                            </nav>
                        </div>
                    </header>
                    <div class="bot_list">
                        
                    </div>
                </div>

                <div class="chat_module">
                    <div id="chat_container" class="chat-container">

                        <div class="header">
                            <div class="bot_nav">
                                    <a onclick=showSidebar1() href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" fill="#BAC6D1"/></svg></a>
                                </div>
                            <div class="image_text">
                                <div class="bot_img">
                                    <img src="../images/bot/<?php echo $row['bot_img'] ?>" class="bot_avatar">
                                </div>
                                <div class="bot_name">
                                    <h4>You're talking to <?php echo $row['bot_name'] ?></h4>
                                </div>
                            </div>

                            <div class="nav_icon">
                                <i id="menu" class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                        </div>

                        <div class="transition">
                            <div class="chat_box">

                            </div>

                            <div class="chatbot">
                                <form action="../php/chat.php?bot_id=<?php echo $botId ?>" class="forms" autocomplete="off">
                                    <div class="input-field">
                                        <input type="text" class="outgoing_id" name="user_outgoing_id" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                                        <input type="text" class="incoming_id" name="bot_incoming_id" value="<?php echo $botId; ?>" hidden>
                                        <input id="input" class="input_text" type="text" name="message" placeholder="Type a message here..." title="Send" autocomplete="off">
                                        <button class="submit">
                                            <i id="send" class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <script src="../js/chat.js"></script>

</body>

</html>
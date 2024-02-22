<?php
require_once "../php/function-class/login_acc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" type="image/x-icon" href="../images/fav.ico">
    <title>kaagapAI</title>
</head>

<body>
    <p class = "link-back">
        
        <a href = "onboarding.php"> 
            <label> &#8592; Back to Home Screen</label>
        </a>
    </p>
    <main>        
        <div class="logo-container">
            <!--Pls change the logo here with the official logo -->
            <img class = "logo-container__img" src="../images/chatbot.png">            
        </div> 
        <section class="login-container">
            <form class="login-contents" action="../php/login.php" enctype="multipart/form-data" method="post" autocomplete="">

                <div class="header">
                    <h2>Login to</h2>
                    <h1>kaagapAI</h1>
                </div>

                <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                <div class="input-field">
                    <input type="email" class="input" name="email" placeholder="Email" required value="<?php echo $email ?>">
                    <i id="form" class="fa-solid fa-envelope"></i>
                </div>

                <div class="input-field">
                    <input type="password" class="input" name="password" placeholder="Password" required autocomplete="off">
                    <i id="form" class="fa-solid fa-lock"></i>
                    <i id="eye1" class="fa-solid fa-eye-slash"></i>
                    <div class="bottom">
                        <div class="right">
                            <label><a href="../php/forgot_pass.php">Forgot Password?</a></label>
                        </div>
                    </div>
                </div>

                <input class="cta" type="submit" name="login" value="LOGIN">

                <!-- <div class="border-container">
                    <div class="border"> </div>
                    <p>OR</p>
                    <div class="border"> </div>
                </div>

                <div class="sso">
                    <ion-icon name="logo-google" class="sites"></ion-icon>
                    <ion-icon name="logo-facebook" class="sites"></ion-icon>
                </div> -->

                <div class="sign">
                    <p class="create">Don't have an account?</p>
                    <a href="../php/signup.php" class="create">Signup</a>
                </div>
            </form>
        </section>

    </main>

    <script src="https://kit.fontawesome.com/01f2bb5cfc.js" crossorigin="anonymous"></script>
    <script src="../js/show-hide-password.js"></script>
</body>

</html>

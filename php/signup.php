<?php
require_once "../php/function-class/create_acc.php";
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
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="icon" type="image/x-icon" href="../images/fav.ico">
    <title>kaagapAI</title>
</head>

<body>
    <main>
        <section class="login-container">
            <form class="login-contents" action="../php/signup.php" method="post" enctype="multipart/form-data" autocomplete="">

                <div class="header">
                    <h2>Create Account</h2>
                    <h1>kaagapAI</h1>
                </div>
                
                <?php
                if (count($errors) == 1) {
                ?>
                    <div class="alert alert-success text-center">
                        <?php
                        foreach ($errors as $showerror) {
                            echo $showerror;
                        }
                        ?>
                    </div>
                <?php
                } elseif (count($errors) > 1) {
                ?>
                    <div class="alert alert-success text-center">
                        <?php
                        foreach ($errors as $showerror) {
                        ?>
                            <li><?php echo $showerror; ?></li>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>

                <div class="input-field">
                    <input class="input" type="text" name="user_name" placeholder="Username" required value="<?php echo $user_name ?>">
                    <i id="form" class="fa-solid fa-user"></i>
                </div>

                <div class="input-field">
                    <input class="input" type="email" name="mail" placeholder="Email" required value="<?php echo $email ?>">
                    <i id="form" class="fa-solid fa-envelope"></i>
                </div>

                <div class="input-field">
                    <input class="input" type="password" name="password" placeholder="Password" required autocomplete="off">
                    <i id="form" class="fa-solid fa-lock"></i>
                    <i id="eye1" class="fa-solid fa-eye-slash"></i>
                </div>

                <div class="input-field">
                    <input class="input" type="password" name="confirm_pass" placeholder="Confirm Password" required autocomplete="off">
                    <i id="form" class="fa-solid fa-lock"></i>
                    <i id="eye2" class="fa-solid fa-eye-slash"></i>
                </div>

                <div class="img-field">
                    <label>Select User Image</label>
                    <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                </div>

                <input class="cta" type="submit" name="signup" value="CREATE ACCOUNT">

                <div class="sign">
                    <p class="create">Already have an account?</p>
                    <a href="../php/login.php" class="create">Login</a>
                </div>
            </form>
        </section>

    </main>

    <script src="https://kit.fontawesome.com/01f2bb5cfc.js" crossorigin="anonymous"></script>
    <script src="../js/show-hide-password.js"></script>
</body>

</html>

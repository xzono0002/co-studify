<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/setting.css">
    <link rel="icon" type="image/x-icon" href="../images/fav.ico">
    <script src="https://kit.fontawesome.com/01f2bb5cfc.js" crossorigin="anonymous"></script>

    <title>kaagapAI</title>
</head>
<body>
    <main>
        <section class="hero_container" id="Hero">
            <div id="wrapper" class="wrapper">
                <div class="menu">
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
            </div>
            <div class="setting_module">
                <h1>Settings</h1>
                <div class="row">
                    <div class="container1">
                        <div class="card">
                            <div class="card-header">
                                <h3>Profile Settings</h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li><a href="#" onclick=showAcc()>Account</a></li>
                                    <li><a href="#" onclick=showPass()>Password</a></li>
                                    <li><a href="#">Delete Account</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container2">
                        <div class="tab-content">
                            <div class="public-info">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title mb-0">Public info</h3>
                                    </div>                  
                                    <div class="card-body">
                                        <form class="cb-form">
                                            <div class="row1">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="inputUsername">Username</label>
                                                        <input type="text" class="form-control" id="inputUsername" placeholder="Change Username Here">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="change_dp">
                                                        <p>Change Profile</p>
                                                        <div class="dp">
                                                            <a href="#" ><svg xmlns="http://www.w3.org/2000/svg" height="100" viewBox="0 -960 960 960" width="100"><path d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z" fill="white"/></svg></a>
                                                        </div>
                                                        <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="password-info">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Password</h3>
                                        <form class="pd-form">
                                            <div class="form-group">
                                                <label for="inputPasswordCurrent">Current password</label>
                                                <input type="password" class="form-control" id="inputPasswordCurrent">
                                                <small><a href="#">Forgot your password?</a></small>
                                            </div>
                                            <div class="form-group">
                                            <label for="inputPasswordNew">New password</label>
                                            <input type="password" class="form-control" id="inputPasswordNew">
                                            </div>
                                            <div class="form-group">
                                            <label for="inputPasswordNew2">Verify password</label>
                                            <input type="password" class="form-control" id="inputPasswordNew2">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
    </main>

    <script src="../js/setting.js"></script>
</body>
</html>
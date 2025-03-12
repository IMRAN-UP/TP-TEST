<?php if( isset($_COOKIE['loggedin'])) { ?>

    <?php if( isset($_COOKIE['Username_Admin']) && isset($_COOKIE['Password_Admin']) ) { ?>
        <script src="./Login.js"></script>
    <?php } ?>

    <?php if( isset($_SESSION['Username_Admin']) && isset($_SESSION['Password_Admin']) ) { ?>
        <script src="./Login.js"></script>
    <?php } ?>
    
<?php } ?>
<?php
session_start();
unset($_SESSION['Id_Admin']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>IHUB login</title>
</head>

<body>
    <div class="animation-container">
        <?php for( $i = 0 ; $i <= 256 ; $i++ ){?>
        <span></span>
        <?php }?>
    </div>
    <div class="conatainer">
        <h1 class="Login-text">LOGIN</h1>
        <div class="error-container" >
            <?php  if (isset($_GET['error'])) {?>
            <p> <?php  echo $_GET['error'] ?> </p>
            <?php } ?>
        </div>
        <form method="POST" action="Sessions_And_Cookies.php" class="form-container">
            <div class="box-input">
                <label for="Username">Username</label>
                <input type="text" name="Username" placeholder="Username"
                    value="<?php if (isset($_COOKIE['Username_Admin'])) {
                        echo $_COOKIE['Username_Admin'];
                    }else if( isset($_SESSION['Username_Admin']  ) ){
                        echo $_SESSION['Username_Admin'];
                    }?>">
            </div>
            <div class="box-input">
                <label for="pass">Password</label>
                <input type="password" name="Password" placeholder="Password"
                    value="<?php if (isset($_COOKIE['Password_Admin'])) {
                        echo $_COOKIE['Password_Admin'];
                    }else if( isset($_SESSION['Password_Admin']) ){
                        echo $_SESSION['Password_Admin'];
                    }?>">
            </div>
            <div id="last-box-input" class="box-input">
                <label>Save your login</label>
                <input type="checkbox" name="Checkbox">
            </div>
            <button type="submit" id="login-btn" >Login</button>
        </form>
    </div>
</body>

</html>
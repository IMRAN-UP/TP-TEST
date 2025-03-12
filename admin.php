<?php
$servername = "localhost"; // MySQL server address
$username = "IMRANE";        // MySQL username
$password = "0707";            // MySQL password (empty by default in XAMPP)
$dbname = "IHUB";          // Replace with your database name (use 'test' if unsure)

try {
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
}
session_start();
$hashedpassword = strlen($_SESSION['Password_Admin'])
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./admin.css">
    <title>Admin</title>
</head>

<body>

    <header class="header">
        <h1><span>I</span>HUB</h1>
        <nav>
            <a class="icon user-btn" id="menu_btn" ><i class='bx bx-menu'></i></a>
        </nav>
    </header>

    <nav class="hidden_nav" id="hidden_nav" >
        <a class="icon user-btn" id="cancel_menu"><i class='bx bx-x'></i></a>
        <a href="dashboard.php" class="icon user-btn"><i class='bx bxs-dashboard'></i></a>
        <a href="departement.php" class="icon user-btn"><i class='bx bxs-business'></i></a>
        <a href="intern.php" class="icon user-btn"><i class='bx bx-male-female'></i></a>
        <a href="Internship.php" class="icon user-btn"><i class='bx bx-transfer-alt'></i></a>
        <a href="logout.php" class="icon logout-btn"><i class='bx bx-log-out'></i></a>
        <a></a>
    </nav>

    <div class="animation-container" id="animation-container">

        <?php for( $i = 0 ; $i <= 256 ; $i++ ){?>
        <span></span>
        <?php }?>

    </div>

    <section class="container admin_container" id="admin_container">
        <div>

            <h1>Name admin</h1>
            <a id="username_btn"><?php echo  $_SESSION['Username_Admin'] ?></a>

            <h1>Password admin</h1>
            <a id="password"><?php for( $i = 0 ; $i < $hashedpassword ; $i++ ){ echo "*";} ?></a>

        </div>
    </section>

    <section class="forms_conatainer" id="forms_conatainer">
        <form class="username_edit" id="username_edit" onsubmit="return validationUsername()">
            <label for="new_name">New name</label>
            <input type="text" name="new_name" placeholder="Enter the new admin name">
            <label for="confirm_new_name">Confirm new name</label>
            <input type="text" name="Confirm_new_name" placeholder="Confirm the new admin name">
            <p class="error" id="error_user"></p>
            <nav>
                <button type="button" id="edit_username">Edit</button>
                <button type="button" id="cancel_edit_username">Cancel</button>
            </nav>
        </form>
        <form class="password_edit" id="password_edit">
            <label for="old_password">Old password</label>
            <input type="password" name="old_pass" placeholder="Enter the old password">
            <label for="new_name">New password</label>
            <input type="password" name="new_pass" placeholder="Enter the new password">
            <label for="confirm_new_name">Confirm new password</label>
            <input type="password" name="confirm_new_pass" placeholder="Confirm new passworfd">
            <p class="error" id="error_pass"></p>
            <nav>
                <button type="button" id="edit_password">Edit</button>
                <button type="button" id="cancel_edit_password">Cancel</button>
            </nav>
            
        </form>
    </section>

    <script>
        var is_old_password = <?php echo json_encode($_SESSION['Password_Admin']); ?>;
    </script>


    <script src="./admin.js"></script>

</body>

</html>
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

    if(empty($_SESSION['Id_Admin'])) header('Location: login.php') ;

    $_SESSION['internships_number'] = count($conn->query("SELECT * FROM internship WHERE Id_Admin = '{$_SESSION['Id_Admin']}'")->fetchAll(PDO::FETCH_ASSOC ));
    $_SESSION['departements_number'] = count($conn->query("SELECT * FROM departement WHERE Id_Admin = '{$_SESSION['Id_Admin']}'")->fetchAll(PDO::FETCH_ASSOC ));
    $_SESSION['interns_number'] = count($conn->query("SELECT * FROM intern ")->fetchAll(PDO::FETCH_ASSOC ));


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>IHUB dashboard</title>

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
        <a href="admin.php" class="icon user-btn"><i class='bx bxs-user'></i></a> 
        <a href="departement.php" class="icon user-btn"><i class='bx bxs-business'></i></a>
        <a href="intern.php" class="icon user-btn"><i class='bx bx-male-female'></i></a>
        <a href="Internship.php" class="icon user-btn"><i class='bx bx-transfer-alt'></i></a>
        <a href="logout.php" class="icon logout-btn"><i class='bx bx-log-out'></i></a>
        <a></a>
    </nav>

    <div class="animation-container">

        <?php for( $i = 0 ; $i <= 256 ; $i++ ){?>
        <span></span>
        <?php }?>

    </div>


    <section class="dashboard" id="dashboard">
        <div>
            <h1><?php echo $_SESSION['departements_number'];?></h1>
            <a href="departement.php">Departements</a>
        </div>
        <div>
            <h1><?php echo $_SESSION['interns_number'];?></h1>
            <a href="intern.php">Interns</a>
        </div>
        <div>
            <h1><?php echo $_SESSION['internships_number'];?></h1>
            <a href="Internship.php">Internships</a>
        </div>
        <div class="last_child">
            <h1>Welcome <?php echo $_SESSION['Username_Admin'] ?> in <span>I</span><span>HUB</span></h1>
            <p>Welcome to the IHUB Dashboard! This central hub streamlines the management of your internship program, offering easy access to all essential functions. The Administrator Panel lets you manage system users and settings. In the Intern Directory, view and manage intern profiles and track their progress. Department Management allows you to oversee department information and assign interns to specific departments. The Internship Programs section details all offered programs, enabling intern assignments and progress tracking. The IHUB Dashboard ensures a user-friendly experience, providing essential information and tools for effective internship management. For assistance, refer to the help section or contact the system administrator.</p>
        </div>
    </section>

    <script src="./dashboard.js"></script>
</body>
</html>
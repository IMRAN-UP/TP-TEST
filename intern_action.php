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

if ( isset($_GET['removed_intern_id']) ){

    $conn->query("DELETE FROM intern WHERE Id_Intern = {$_GET['removed_intern_id']}");
    header("Location: intern.php");

}

if( isset($_GET['edited_intern_id']) ){
    
    if( !empty($_GET['new_first_name']) && !empty($_GET['new_last_name']) && !empty($_GET['new_birthday']) ){
        
        $conn->query("UPDATE intern SET First_Name = '{$_GET['new_first_name']}', Last_Name = '{$_GET['new_last_name']}', Birthday = '{$_GET['new_birthday']}' WHERE Id_Intern = {$_GET['edited_intern_id']}");
        header("Location: intern.php");

    }
}

if ( isset($_SESSION['Id_Admin']) ){
    if( !empty($_GET['first_name']) && !empty($_GET['last_name']) && !empty($_GET['birthday']) ){

        $conn->query("INSERT INTO intern(First_Name,Last_Name,Birthday,Id_Admin) VALUES ('{$_GET['first_name']}','{$_GET['last_name']}','{$_GET['birthday']}','{$_SESSION['Id_Admin']}') ");
        header("Location: intern.php");

    }
}
?>
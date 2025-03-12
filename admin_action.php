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

if( isset($_GET['new_name']) ){
    $conn->query("UPDATE administrator SET Name_Admin = '{$_GET['new_name']}' WHERE Id_Admin = '{$_SESSION['Id_Admin']}'");
    header("Location: logout.php?change=1");
}
if( isset($_GET['new_pass']) ){
    $conn->query("UPDATE administrator SET Password_Admin = '{$_GET['new_pass']}' WHERE Id_Admin = '{$_SESSION['Id_Admin']}'");
    header("Location: logout.php?change=1");
}
?>
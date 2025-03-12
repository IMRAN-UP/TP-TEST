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

if ( isset($_GET['removed_departement_id']) ){

    $conn->query("DELETE FROM departement WHERE Id_Depart = {$_GET['removed_departement_id']}");
    header("Location: departement.php");

}

if( isset($_GET['edited_departement_id']) ){
    
    if( !empty($_GET['new_departement_name']) ){
        
        $conn->query("UPDATE departement SET Name_Depart = '{$_GET['new_departement_name']}' WHERE Id_Depart = {$_GET['edited_departement_id']}");
        header("Location: departement.php");

    }
}

if ( isset($_SESSION['Id_Admin']) ){
    if( !empty($_GET['name']) ){

        $conn->query("INSERT INTO departement(Name_Depart,Id_Admin) VALUES ('{$_GET['name']}','{$_SESSION['Id_Admin']}') ");
        header("Location: departement.php");

    }
}
?>
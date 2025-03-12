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

if( isset($_GET['removed_internship_id'])){
    $conn->query("DELETE FROM internship WHERE Id_Internship = {$_GET['removed_internship_id']}");
    header("Location: internship.php");
}

if(isset($_GET['internship_edited_id'])){

    if( !empty($_GET['departement_id'])  && !empty($_GET['intern_id']) && !empty($_GET['start_date']) && !empty($_GET['end_date']) ){
        $conn->query("UPDATE internship SET Id_Depart = '{$_GET['departement_id']}', Id_Intern = '{$_GET['intern_id']}', StartDate = '{$_GET['start_date']}', EndDate = '{$_GET['end_date']}' WHERE Id_Internship = '{$_GET['internship_edited_id']}'");
        header("Location: internship.php");
    }else{
        header("Location: internship.php?error=Modification failed");
    }
    
}

if ( isset($_GET['added_departement_id']) && isset($_GET['added_intern_id']) && isset($_GET['added_start_date']) && isset($_GET['added_end_date']) ){
    if( !empty($_GET['added_departement_id']) && !empty($_GET['added_intern_id']) && !empty($_GET['added_start_date']) && !empty($_GET['added_end_date'])){
        $conn->query("INSERT INTO internship (Id_Depart, Id_Intern, Id_Admin, StartDate, EndDate) VALUES ('{$_GET['added_departement_id']}', '{$_GET['added_intern_id']}', '{$_SESSION['Id_Admin']}', '{$_GET['added_start_date']}', '{$_GET['added_end_date']}');");
        header("Location: internship.php");
    }else{
        header("Location: internship.php?error=Addition failed");
    }
}


?>
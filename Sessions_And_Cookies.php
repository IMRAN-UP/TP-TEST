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
        
        echo "Connected successfully"; 
    }
    catch(PDOException $e) {
    }

    session_start();

    if( empty($_POST['Username']) || empty($_POST['Password']) ){

        header('Location: login.php?error=All fields are required') ;

    }else{
        $query = $conn->query("SELECT * FROM administrator WHERE Name_Admin = '{$_POST['Username']}'")->fetch(PDO::FETCH_ASSOC) ;

        if( $_POST['Password'] !== $query['Password_Admin'] ){

            header('Location: login.php?error=Invalid Password or Username');

        } else {

            $_SESSION['Id_Admin'] = $query['Id_Admin'];
            $_SESSION['Username_Admin'] = $query['Name_Admin'];
            $_SESSION['Password_Admin'] = $_POST['Password'];

            setcookie('loggedin', '1', time() + 365*24*3600, "/");
            
            if( isset($_POST['Checkbox'])){
                setcookie('Username_Admin', $_SESSION['Username_Admin'] , time() + 365*24*3600 , '/');
                setcookie('Password_Admin', $_SESSION['Password_Admin'] , time() + 356*24*3600 , '/');
                setcookie('Id_Admin', $_SESSION['Id_Admin'] , time() + 356*24*3600 , '/');
            }

            header('Location: dashboard.php');
        }
    }

?>
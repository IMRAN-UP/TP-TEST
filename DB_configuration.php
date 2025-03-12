<?php
try {
    $DB_connection = new PDO("mysql:host=localhost;dbname=java_test", "root","0707");
    $DB_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}
?>

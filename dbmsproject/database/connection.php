<?php
    $servername = 'localhost:3306:3377';
    $username = 'root';
    $password ='#Aryanmehta181719';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=inventory", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
    } catch(\Exception $e) {
        $error_message=$e->getMessage();
    }
?>

<?php
function connect_to_sql()
{
    $servername = "localhost";
    $database_name = "shoe_seller";
    $username = "root";
    $password = "";

    try {
        return new PDO("mysql:host=$servername;dbname=$database_name;charset=UTF8", $username, $password);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
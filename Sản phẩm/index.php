<?php
include "sql_connection.php";
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id))
{
    header("location:login.php");
}
else {
    header("location:home.php");
}
if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header("location:login.php");
};

?>
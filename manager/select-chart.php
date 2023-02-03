<?php 
session_start();
if (isset($_GET['select-chart'])) {
    $_SESSION['select-chart'] = $_GET['select-chart'];
    header("location: ./");
    exit;
}
?>
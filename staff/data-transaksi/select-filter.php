<?php 
session_start();
if (isset($_GET['select-year'])) {
    $_SESSION['select-year'] = $_GET['select-year'];
    header("location: ./");
    exit;
} else if (isset($_GET['select-month'])) {
    $_SESSION['select-month'] = $_GET['select-month'];
    header("location: ./");
    exit;
} else if (isset($_GET['show-all'])) {
    $_SESSION['select-month'] = 0;
    $_SESSION['select-year'] = 0;
    header("location: ./");
    exit;
}
?>
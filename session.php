<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
if(!isset($_SESSION['reg_username']) and !isset($_SESSION['reg_password'])) {

header('location:../index.php');
}
?>
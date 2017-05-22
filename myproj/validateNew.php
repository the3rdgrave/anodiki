<?php
session_start();
include 'header.php';

$_SESSION['hotelname']=$_POST['hotelname'];
$_SESSION['address']=$_POST['address'];
$_SESSION['phone1']=$_POST['phone1'];

header('Location: mainpage.php');
?>

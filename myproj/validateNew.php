<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

$_SESSION['hotelname']=$_POST['hotelname'];
$_SESSION['address']=$_POST['address'];
$_SESSION['phone1']=$_POST['phone1'];
$_SESSION['phone2']=$_POST['phone2'];
$_SESSION['emailreport']=$_POST['emailreport'];
$_SESSION['emailreport2']=$_POST['emailreport2'];

echo addWork($_POST['hotelname'],$_POST['address'],1,$_POST['phone1'],$_POST['phone2'],$_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'],$_POST['work'],$_POST['days']);

?><br>
<a href="mainpage.php">Go Back</a>
<?php
// header('Location: mainpage.php');
?>

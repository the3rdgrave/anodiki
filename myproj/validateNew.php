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

if(!isset($_GET['id'])) {
// echo 'New entry';
  echo addWork($_POST['hotelname'],$_POST['address'],2,$_POST['phone1'],$_POST['phone2'],$_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'],$_POST['work'],$_POST['days']);?><br>
  <a href="mainpage.php">Προσθήκη νέας εργασίας</a><br>
  <a href="mainmenu.php">Επιστροφή στο βασικό μενού</a>
<?php
} else {
  // echo 'Entry edited';
  echo updateWork($_GET['id'],$_POST['hotelname'],$_POST['address'],2,$_POST['phone1'],$_POST['phone2'],$_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'],$_POST['work'],$_POST['days']);?><br>
  <a href="worklist.php">Πίσω στις εργασίες</a>
<?php } ?>

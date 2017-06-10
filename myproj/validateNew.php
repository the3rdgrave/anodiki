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
$_SESSION['maintainer']=$_POST['maintainer'];

if (isset($_POST['newworkbutton'])){
// echo 'New entry';
  echo $_POST['maintainer'];
  echo addWork($_POST['hotelname'],$_POST['address'],getMaintainerId($_POST['maintainer'])['Id'],$_POST['phone1'],$_POST['phone2'],$_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'],$_POST['work'],$_POST['days']);?><br>
  <a href="mainpage.php">Προσθήκη νέας εργασίας</a><br>
  <a href="mainmenu.php">Επιστροφή στο βασικό μενού</a>
<?php
} if (isset($_POST['updateworkbutton'])) {
  // echo 'Entry edited';
  $work=getWorkById($_GET['id']);
  echo updateWork($_GET['id'],$_POST['hotelname'],$_POST['address'],getMaintainerId($_POST['maintainer'])['Id'],$_POST['phone1'],$_POST['phone2'],$_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'],$_POST['work'],
  $_POST['days'], $work['Date'];?><br>
  <a href="worklist.php">Πίσω στις εργασίες</a>
<?php } ?>

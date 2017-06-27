<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {

  $_SESSION['hotelname']=$_POST['hotelname'];
  $_SESSION['address']=$_POST['address'];
  $_SESSION['phone1']=$_POST['phone1'];
  $_SESSION['phone2']=$_POST['phone2'];
  $_SESSION['maintainer1']=$_POST['maintainer1'];
  $_SESSION['maintainer2']=$_POST['maintainer2'];
  $_SESSION['maintainer3']=$_POST['maintainer3'];


if (isset($_POST['newhotelbutton'])){

  $newhotel=addHotel($_POST['hotelname'],$_POST['address'],$_POST['maintainer1']==""?null:getMaintainerId($_POST['maintainer1'])['Id'], $_POST['maintainer2']==""?null:getMaintainerId($_POST['maintainer2'])['Id'],
    $_POST['maintainer3']==""?null:getMaintainerId($_POST['maintainer1'])['Id'], $_POST['phone1'],$_POST['phone2']).'<br>';
  echo $newhotel; ?>
    <a href="addhotel.php">Προσθήκη νέας εργασίας</a><br>
  <a href="mainmenu.php">Επιστροφή στο βασικό μενού</a>

<?php

if($newhotel!="Hotel added"){
  $_SESSION['failedhn']=$_POST['hotelname'];
  $_SESSION['failedad']=$_POST['address'];
  $_SESSION['failedp1']=$_POST['phone1'];
  $_SESSION['failedp2']=$_POST['phone2'];
  $_SESSION['failedm1']=$_POST['maintainer1'];
  $_SESSION['failedm2']=$_POST['maintainer2'];
  $_SESSION['failedm3']=$_POST['maintainer3'];
}


} else if (isset($_POST['updatehotelbutton'])) {
  // echo 'Entry edited';
  $work=getWorkById($_GET['id']);
  echo updateWork($_GET['id'],$_POST['hotelname'],$_POST['address'],getMaintainerId($_POST['maintainer'])['Id'],$_POST['phone1'],$_POST['phone2'],$_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'],$_POST['work'],
  $_POST['days'], $work['Date'], $work['Confirmation'], $work['Notes']);?><br>
  <a href="worklist.php">Πίσω στις εργασίες</a>
<?php }
else{
  header('Location: mainpage.php');
}
}

include 'footer.php'; ?>

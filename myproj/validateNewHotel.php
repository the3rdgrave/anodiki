<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {

  // $_SESSION['hotelname']=$_POST['hotelname'];
  // $_SESSION['address']=$_POST['address'];
  // $_SESSION['phone1']=$_POST['phone1'];
  // $_SESSION['phone2']=$_POST['phone2'];
  // $_SESSION['maintainer1']=$_POST['maintainer1'];
  // $_SESSION['maintainer2']=$_POST['maintainer2'];
  // $_SESSION['maintainer3']=$_POST['maintainer3'];
  // $_SESSION['un']=$_POST['un'];
  // $_SESSION['pw']=$_POST['pw'];
  // $_SESSION['rpw']=$_POST['rpw'];


if (isset($_POST['newhotelbutton'])){

  $newhotel=addHotel(trim($_POST['hotelname']),trim($_POST['address']),trim($_POST['maintainer1']), trim($_POST['maintainer2']),
    trim($_POST['maintainer3']), trim($_POST['phone1']),trim($_POST['phone2']), trim($_POST['emailreport']),trim($_POST['emailreport2']), $_POST['date'],trim($_POST['un']),
    trim($_POST['pw']),trim($_POST['rpw']));
  echo $newhotel.'<br>'; ?>
  <?php if($newhotel!="Hotel added"){?>
  <a href="addHotel.php">Νέα προσπάθεια</a><br>
  <?php } else { ?>
  <a href="addHotel.php">Προσθήκη νέου</a><br>
  <?php } ?>
  <a href="mainmenu.php">Επιστροφή στο βασικό μενού</a>

<?php

if($newhotel!="Hotel added"){
  $_SESSION['failedhn']=$_POST['hotelname'];
  $_SESSION['failedad']=$_POST['address'];
  $_SESSION['failedp1']=$_POST['phone1'];
  $_SESSION['failedp2']=$_POST['phone2'];
  $_SESSION['failedp1']=$_POST['emailreport'];
  $_SESSION['failedp2']=$_POST['emailreport2'];
  $_SESSION['failedm1']=$_POST['maintainer1'];
  $_SESSION['failedm2']=$_POST['maintainer2'];
  $_SESSION['failedm3']=$_POST['maintainer3'];
  $_SESSION['failedun']=$_POST['un'];
  $_SESSION['failedpw']=$_POST['pw'];
  $_SESSION['failedrpw']=$_POST['rpw'];
  $_SESSION['faileddate']=$_POST['date'];
}




} else if (isset($_POST['updatehotelbutton'])) {
  // echo 'Entry edited';
  $hotel=getHotelById($_GET['id']);
  $updatedhotel=updateHotel($_GET['id'], trim($_POST['hotelname']),trim($_POST['address']),trim($_POST['maintainer1']), trim($_POST['maintainer2']),
    trim($_POST['maintainer3']), trim($_POST['phone1']), trim($_POST['phone2']), trim($_POST['emailreport']), trim($_POST['emailreport2']), $_POST['date'], trim($_POST['un']),
    trim($_POST['pw']),trim($_POST['rpw']));
  if ($updatedhotel=="Hotel updated"){
    updateWorkDateByHotel($_GET['id'], $_POST['date']);
  }
  echo $updatedhotel.'<br>';

  if($updatedhotel!="Hotel updated"){ ?>
  <a href="addHotel.php?id=<?php echo $_GET['id'];?>">Νέα προσπάθεια</a><br>
  <?php } else { ?>
  <a href="hotellist.php">Επιστροφή στα ξενοδοχεία</a><br>
  <?php } ?>
  <a href="mainmenu.php">Επιστροφή στο βασικό μενού</a>

<?php
if($updatedhotel!="Hotel updated"){
  $_SESSION['failedhn']=$_POST['hotelname'];
  $_SESSION['failedad']=$_POST['address'];
  $_SESSION['failedp1']=$_POST['phone1'];
  $_SESSION['failedp2']=$_POST['phone2'];
  $_SESSION['faileder1']=$_POST['emailreport'];
  $_SESSION['faileder2']=$_POST['emailreport2'];
  $_SESSION['failedm1']=$_POST['maintainer1'];
  $_SESSION['failedm2']=$_POST['maintainer2'];
  $_SESSION['failedm3']=$_POST['maintainer3'];
  $_SESSION['failedun']=$_POST['un'];
  $_SESSION['failedpw']=$_POST['pw'];
  $_SESSION['failedrpw']=$_POST['rpw'];
  $_SESSION['faileddate']=$_POST['date'];
  }

}
else{
  header('Location: mainpage.php');
}
}

include 'footer.php'; ?>

<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {

$_SESSION['hotelname']=$_POST['hotelname'];
$_SESSION['emailreport']=$_POST['emailreport'];
$_SESSION['emailreport2']=$_POST['emailreport2'];


if (isset($_POST['newworkbutton'])){
  echo addWork(getHotelId($_POST['hotelname'])['Id'], $_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'],$_POST['work'],
  $_POST['days']);?> για το ξενοδοχείο <?php echo $_POST['hotelname'];?><br>
  <a href="mainpage.php">Προσθήκη νέας εργασίας</a><br>
  <a href="mainmenu.php">Επιστροφή στο βασικό μενού</a>
<?php
} else if (isset($_POST['updateworkbutton'])) {
  // echo 'Entry edited';
  $work=getWorkById($_GET['id']);
  echo updateWork($_GET['id'], getHotelId($_POST['hotelname'])['Id'],$_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'],$_POST['work'],
  $_POST['days'], $work['Date'], $work['Confirmation'], $work['Notes']);?><br>
  <a href="worklist.php">Πίσω στις εργασίες</a>
<?php }
else{
  header('Location: mainpage.php');
}
}

include 'footer.php'; ?>

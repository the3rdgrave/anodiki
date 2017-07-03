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
  for($i = 0; $i < sizeof($_POST['device']); ++$i){
  if (trim($_POST['device'][$i])!="" && trim($_POST['work'][$i])!="" && $_POST['days']>0){
  echo addWork(getHotelId($_POST['hotelname'])['Id'], $_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'][$i],$_POST['work'][$i],
  $_POST['days'][$i]);?> :<?php echo $_POST['work'][$i];?><br>
  <?php
    }
  } ?>
  <a href="mainpage.php">Προσθήκη περισσοτέρων εργασιών</a><br>
  <a href="mainmenu.php">Επιστροφή στο βασικό μενού</a>
<?php
} else if (isset($_POST['updateworkbutton'])) {
  // echo 'Entry edited';
  $work=getWorkById($_GET['id']);
  echo updateWork($_GET['id'], getHotelId($_POST['hotelname'])['Id'],$_POST['emailreport'],$_POST['emailreport2'],$_POST['room'],$_POST['device'][0],$_POST['work'][0],
  $_POST['days'][0], $work['Date'], $work['Confirmation'], $work['Notes']);?><br>
  <a href="worklist.php">Πίσω στις εργασίες</a>
<?php }
else{
  header('Location: mainpage.php');
}
}

include 'footer.php'; ?>

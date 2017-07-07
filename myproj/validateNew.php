<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {




if (isset($_POST['newworkbutton'])){
  $_SESSION['hotelname']=$_POST['hotelname'];
  $_SESSION['room']=$_POST['room'];
  $_SESSION['device']=$_POST['device'];
  $_SESSION['work']=$_POST['work'];
  $_SESSION['days']=$_POST['days'];


  $startingdate=getHotelId($_POST['hotelname'])['StartingDate'];

  for($i = 0; $i < sizeof($_POST['device']); ++$i){
  if (trim($_POST['room'])!="" && trim($_POST['device'][$i])!="" && trim($_POST['work'][$i])!="" && $_POST['days'][$i]>0){
  echo addWork(getHotelId($_POST['hotelname'])['Id'], $_POST['room'],$_POST['device'][$i],$_POST['work'][$i], $_POST['days'][$i], $startingdate);
  ?> : <?php echo $_POST['work'][$i];?><br>
  <?php
} else if(trim($_POST['device'][$i])!="" || trim($_POST['work'][$i])!=""|| $_POST['days'][$i]>0){
  echo 'Ελλειπή στοιχεία. Η εργασία '.($i+1).' δεν προστέθηκε.<br>';
}
  } ?>
  <a href="mainpage.php">Επιστροφή στην προσθήκη εργασιών</a><br>
  <a href="mainmenu.php">Επιστροφή στο βασικό μενού</a>
<?php


} else if (isset($_POST['updateworkbutton'])) {
  $startingdate=getHotelId($_POST['hotelname'])['StartingDate'];
  $work=getWorkById($_GET['id']);
  if (trim($_POST['room'])!="" && trim($_POST['device'][0])!="" && trim($_POST['work'][0])!="" && $_POST['days'][0]>0){
  echo updateWork($_GET['id'], getHotelId($_POST['hotelname'])['Id'], $_POST['room'],$_POST['device'][0],$_POST['work'][0], $_POST['days'][0],
  $startingdate, $work['Confirmation'], $work['Notes']);?><br>
  <?php } else {
    echo 'Ελλειπή στοιχεία. Η εργασία δεν τροποποιήθηκε.<br>';?>
    <a href="mainpage.php?id=<?php echo $_GET['id'];?>">Νέα προσπάθεια</a><br>
 <?php }?>
  <a href="worklist.php">Πίσω στις εργασίες</a>

<?php } else if (isset($_POST['cloneroombutton'])){
  if (trim($_POST['room'])==""){?>
    Δεν εισήχθη χώρος/δωμάτιο
    <br>
    <a href="mainpage.php">Πίσω</a>
    <?php
      } else {
      $_SESSION['clonehn']=$_POST['hotelname'];
      $_SESSION['cloneroom']=trim($_POST['room']);
      header('Location: roomsList.php');

        }
    } else {
        header('Location: mainpage.php');
    }
  }

    include 'footer.php'; ?>

<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if(isset($_POST['submitnewmain'])) {
  $newmaintainer=addMaintainer($_POST['fn'],$_POST['ln']);
  echo $newmaintainer;
  ?>
  <br>
  <?php if($newmaintainer!="Maintainer added"){?>
  <a href="addMaintainer.php">Νέα προσπάθεια</a><br>
  <?php } else { ?>
  <a href="addMaintainer.php">Προσθήκη νέου</a><br>
  <?php } ?>
  <a href="mainmenu.php">Επιστροφή στο Μενού</a>

  <?php if($newmaintainer!="Maintainer added"){
    $_SESSION['failedfn']=$_POST['fn'];
    $_SESSION['failedln']=$_POST['ln'];

  }
}


if(isset($_POST['submitupdatemain'])) {
  $updatedmaintainer=updateMaintainer($_GET['id'],$_POST['fn'],$_POST['ln']);
  echo $updatedmaintainer;
?>
<br>
<?php if($updatedmaintainer!="Maintainer updated"){?>
<a href="addMaintainer.php?id=<?php echo $_GET['id'];?>">Νέα προσπάθεια</a><br>
<?php } else { ?>
<a href="maintainersList.php">Επιστροφή στους Συντηρητές</a><br>
<?php } ?>
<a href="mainmenu.php">Επιστροφή στο Μενού</a>

<?php if($updatedmaintainer!="Maintainer updated"){
  $_SESSION['failedfn']=$_POST['fn'];
  $_SESSION['failedln']=$_POST['ln'];

  }

}
  include 'footer.php';
  ?>

<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if(isset($_POST['submitnewmain'])) {
  $newuser=addMaintainer($_POST['un'],$_POST['pw'],$_POST['rpw'],$_POST['fn'],$_POST['ln']);
  echo $newuser;
  ?>
  <br>
  <?php if($newuser!="User added"){?>
  <a href="addMaintainer.php">Νέα προσπάθεια</a><br>
  <?php } else { ?>
  <a href="addMaintainer.php">Προσθήκη νέου</a><br>
  <?php } ?>
  <a href="mainmenu.php">Επιστροφή στο Μενού</a>

  <?php if($newuser!="User added"){
    $_SESSION['failedun']=$_POST['un'];
    $_SESSION['failedpw']=$_POST['pw'];
    $_SESSION['failedrpw']=$_POST['rpw'];
    $_SESSION['failedfn']=$_POST['fn'];
    $_SESSION['failedln']=$_POST['ln'];

  }
}


if(isset($_POST['submitupdatemain'])) {
  $updateduser=updateMaintainer($_GET['id'],$_POST['un'],$_POST['pw'],$_POST['rpw'],$_POST['fn'],$_POST['ln']);
  echo $updateduser;
?>
<br>
<?php if($updateduser!="User updated"){?>
<a href="addMaintainer.php?id=<?php echo $_GET['id'];?>">Νέα προσπάθεια</a><br>
<?php } else { ?>
<a href="maintainersList.php">Επιστροφή στους Συντηρητές</a><br>
<?php } ?>
<a href="mainmenu.php">Επιστροφή στο Μενού</a>

<?php if($updateduser!="User updated"){
  $_SESSION['failedun']=$_POST['un'];
  $_SESSION['failedpw']=$_POST['pw'];
  $_SESSION['failedrpw']=$_POST['rpw'];
  $_SESSION['failedfn']=$_POST['fn'];
  $_SESSION['failedln']=$_POST['ln'];

  }

}
  include 'footer.php';
  ?>

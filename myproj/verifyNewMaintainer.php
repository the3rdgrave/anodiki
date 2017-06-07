<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if(isset($_POST['submitnewmain'])) {
  $newuser=addMaintainer($_POST['un'],$_POST['pw'],$_POST['rpw'],$_POST['fn'],$_POST['ln']);
  echo $newuser;
}
?>
<br>
<?php if($newuser!="User created"){?>
<a href="addMaintainer.php">Διόρθωση</a><br>
<?php } else {?>
<a href="addMaintainer.php">Προσθήκη νέου</a><br>
<?php } ?>
<a href="mainmenu.php">Επιστροφή στο Μενού</a>

<?php if($newuser!="User created"){
  $_SESSION['failedun']=$_POST['un'];
  $_SESSION['failedpw']=$_POST['pw'];
  $_SESSION['failedrpw']=$_POST['rpw'];
  $_SESSION['failedfn']=$_POST['fn'];
  $_SESSION['failedln']=$_POST['ln'];

}
  ?>

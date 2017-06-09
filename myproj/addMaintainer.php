<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if(isset($_GET['id']) && $_GET['id']!=0){
  $maintainer=getUserById($_GET['id']);
  if($maintainer!=null){
    $_SESSION['failedfn']=$maintainer['FirstName'];
    $_SESSION['failedln']=$maintainer['LastName'];
    $_SESSION['failedun']=$maintainer['Username'];
    $_SESSION['failedpw']=$maintainer['Password'];
    $_SESSION['failedrpw']=$maintainer['Password'];
  }
}

?>


<form id="newMaintainerForm" method="post" action="verifyNewMaintainer.php">
<table id="addMaintainerTable">
  <tr>
    <td><label for="fn">ONOMA</label>
    </td>
    <td>
      <input type="text" id="fn" name="fn" value="<?php echo (isset($_SESSION['failedfn'])?$_SESSION['failedfn']:"");?>">
    </td>
  </tr>
  <tr>
    <td><label for="ln">ΕΠΩΝΥΜΟ</label>
    </td>
    <td>
      <input type="text" id="ln" name="ln" value="<?php echo (isset($_SESSION['failedln'])?$_SESSION['failedln']:"");?>">
    </td>
  </tr>
  <tr>
    <td><label for="un">ONOMA ΧΡΗΣΤΗ</label>
    </td>
    <td>
      <input type="text" id="un" name="un" value="<?php echo (isset($_SESSION['failedun'])?$_SESSION['failedun']:"");?>">
    </td>
  </tr>
  <tr>
    <td><label for="pw">ΚΩΔΙΚΟΣ</label>
    </td>
    <td>
      <input type="text" id="pw" name="pw" value="<?php echo (isset($_SESSION['failedpw'])?$_SESSION['failedpw']:"");?>">
    </td>
  </tr>
  <tr>
    <td><label for="prw">ΕΠΑΝΑΛΗΨΗ ΚΩΔΙΚΟΥ</label>
    </td>
    <td>
      <input type="text" id="rpw" name="rpw" value="<?php echo (isset($_SESSION['failedrpw'])?$_SESSION['failedrpw']:"");?>">
    </td>
  </tr>
  <tr>
    <td style="text-align: center">
      <button name="submitnewmain" type="submit">Προσθήκη</button>
    </td>
    <td>
      <a href="mainmenu.php">Πίσω</a>
    </td>
  </tr>
</table>
</form>

<?php
  unset($_SESSION['failedfn']);
  unset($_SESSION['failedln']);
  unset($_SESSION['failedun']);
  unset($_SESSION['failedpw']);
  unset($_SESSION['failedrpw']);
?>

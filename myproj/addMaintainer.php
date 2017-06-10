<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if(isset($_GET['id']) && $_GET['id']!=0){
  $maintainer=getUserById($_GET['id']);
  if($maintainer!=null){
    if(!isset($_SESSION['failedfn']))
      $_SESSION['failedfn']=$maintainer['FirstName'];
    if(!isset($_SESSION['failedln']))
      $_SESSION['failedln']=$maintainer['LastName'];
    if(!isset($_SESSION['failedun']))
      $_SESSION['failedun']=$maintainer['Username'];
    if(!isset($_SESSION['failedpw']))
      $_SESSION['failedpw']=$maintainer['Password'];
    if(!isset($_SESSION['failedrpw']))
      $_SESSION['failedrpw']=$maintainer['Password'];
  }
}

?>

<?php if (isset($_GET['id']) && ($_GET['id'])!=null){?>
<form method="post" action="verifyNewMaintainer.php?id=<?php echo $_GET['id'];?>"><?php } else {?>
<form method="post" action="verifyNewMaintainer.php"><?php } ?>
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
      <?php if(isset($_GET['id']) && $_GET['id']!=0) { ?>
        <button name="submitupdatemain" type="submit">Τροποποίηση</button>
      <?php } else { ?>
        <button name="submitnewmain" type="submit">Προσθήκη</button>
      <?php } ?>
    </td>
    <td style="text-align: right">
      <?php if(isset($_GET['id']) && $_GET['id']!=0){?>
      <a href="maintainersList.php">Πίσω</a>
      <?php } else { ?>
        <a href="mainmenu.php">Πίσω</a>
      <?php } ?>
    </td>
  </tr>
  <?php if(isset($_GET['id']) && $_GET['id']!=0){?>
    <tr>
      <td colspan="2" style="text-align: center">
        <a class="deleteButton" href="deleteMaintainer.php?id=<?php echo $maintainer['Id'];?>">Διαγραφή</a>
      </td>
    </tr>
    <?php } ?>
</table>
</form>

<?php
  unset($_SESSION['failedfn']);
  unset($_SESSION['failedln']);
  unset($_SESSION['failedun']);
  unset($_SESSION['failedpw']);
  unset($_SESSION['failedrpw']);
?>

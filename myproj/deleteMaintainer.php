<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {

if(isset($_POST['deletemaitainerbutton'])){
  deleteMaintainer($_GET['id']);
  header('Location: mainmenu.php');

}

$maintainer=getMaintainerById($_GET['id']);


?>
<form method="post" action="addMaintainer.php?id=<?php echo $user['Id'];?>">
<table align="center">
  <tr>
    <td colspan="2" style="text-align:center">
      <p>Διαγραφή του συντηρητή <?php echo $maintainer['FirstName'].' '.$maintainer['LastName'];?>;</p>
    </td>
    <tr>
      <td style="text-align: center">
        <button type="submit" name="deletemaintainerbutton">Ναι</button>
      </td>
      <td style="text-align: center">
        <a href="addMaintainer.php?id=<?php echo $maintainer['Id'];?>">Όχι</a>
      </td>
    </tr>
  </table>
</form>

<?php }
include 'footer.php'; ?>

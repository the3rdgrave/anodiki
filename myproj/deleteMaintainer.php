<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if(isset($_POST['deletemaitainerbutton'])){
  deleteUser($_GET['id']);
  deleteWorksByMaintainer($_GET['id']);
  header('Location: mainmenu.php');

}

$user=getUserById($_GET['id']);
$hotels=sizeof(getHotelsByMaintainer($_GET['id']));


?>
<form method="post" action="addMaintainer.php?id=<?php echo $user['Id'];?>">
<table align="center">
  <tr>
    <td colspan="2" style="text-align:center">
      <p>Διαγραφή του χρήστη <?php echo $user['Username'];?> (<?php echo $user['FirstName'].' '.$user['LastName'];?>);</p>
      <?php if($hotels>0) {?>
        <p>ΠΡΟΣΟΧΗ: Οι εργασίες που του έχουν ανατεθεί θα διαγραφούν!!!</p>
      <?php } ?>
    </td>
    <tr>
      <td style="text-align: center">
        <button type="submit" name="deletemaintainerbutton">Ναι</button>
      </td>
      <td style="text-align: center">
        <a href="addMaintainer.php?id=<?php echo $user['Id'];?>">Όχι</a>
      </td>
    </tr>
  </table>
</form>

<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {

  if(isset($_POST['deleteworkbutton'])){
    deleteWork($_GET['id']);
    deletePendingWork($_GET['id']);
    header('Location: worklist.php');
  }

$work=getWorkById($_GET['id']);
?>
<form method="post" action="deleteWork.php?id=<?php echo $_GET['id'];?>">
<table align="center">
  <tr>
    <td colspan="2" style="text-align: center">
      <p>Διαγραφή της εργασίας <?php echo $work['Device'].': '.$work['Work'];?></p>
      <p>στο δωμάτιο <?php echo $work['Room'].'/'.getHotelById($work['HotelId'])['HotelName'];?>;</p>
    </td>
    <tr>
      <td style="text-align: center">
        <button type="submit" name="deleteworkbutton">Ναι</button>
      </td>
      <td style="text-align: center">
        <a href="mainpage.php?id=<?php echo $work['Id'];?>">Όχι</a>
      </td>
    </tr>
  </table>
</form>

  <?php }
  include 'footer.php'; ?>

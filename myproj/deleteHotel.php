<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {

  if(isset($_POST['deletehotelbutton'])){
    deleteHotel($_GET['id']);
    deleteWorksByHotel($_GET['id']);
    deletePendingWorksByHotel($_GET['id']);
    header('Location: hotellist.php');
  }

$hotel=getHotelById($_GET['id']);
?>
<form method="post" action="deleteHotel.php?id=<?php echo $_GET['id'];?>">
<table align="center">
  <tr>
    <td colspan="2" style="text-align: center">
      <p>Διαγραφή του ξενοδοχείου <?php echo $hotel['HotelName'].', '.$hotel['Address'];?></p>
      <p>Όλες οι εργασίες που έχουν ανατεθεί σε αυτό το ξενοδοχείο θα διαγραφούν</p>
    </td>
    <tr>
      <td style="text-align: center">
        <button type="submit" name="deletehotelbutton">Ναι</button>
      </td>
      <td style="text-align: center">
        <a href="mainpage.php?id=<?php echo $hotel['Id'];?>">Όχι</a>
      </td>
    </tr>
  </table>
</form>

  <?php }
  include 'footer.php'; ?>

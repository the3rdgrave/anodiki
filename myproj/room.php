<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {
  $worksPerRoom=getWorksByRoom($_GET['room'],$_GET['hotelid']);
?>
<table id="roomworkstable" align="center" frame="void" border="2px solid black" style="width: 50%">
  <tr>
    <td colspan="2" style="text-align: center">
      <p><?php echo $_GET['room'].'/'.getHotelById($_GET['hotelid'])['HotelName'];?></p>
    </td>
  <tr>
    <td>
      <p>ΣΥΣΚΕΥΗ</p>
    </td>
    <td>
      <p>ΕΡΓΑΣΙΑ</p>
    </td>
  </tr>
<?php foreach ($worksPerRoom as $row){?>
  <tr>
    <td>
      <p><?php echo $row['Device'];?></p>
    </td>
    <td>
      <p><?php echo $row['Work'];?></p>
    </td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="2" style="text-align: center; border:0">
      <a href="cloneRoom.php?id=<?php echo $row["Id"];?>">Κλωνοποίηση για <?php echo $_SESSION['cloneroom'].'/'.$_SESSION['clonehn'];?></a>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="text-align: center; border:0">
      <a href="roomsList.php">Επιστροφή στη λίστα</a>
    </td>
  </tr>
</table>
<?php
}
include 'footer.php';
?>

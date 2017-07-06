<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {

  $rooms=isset($_GET['searchroomfield']) && $_GET['searchroomfield']!=""?searchRoom($_GET['searchroomfield']):getAllRooms();
?>
<table id="roomstable" align="center" frame="void" border="2px solid black" style="width: 50%">
  <tr>
    <td>
      <p>ΞΕΝΟΔΟΧΕΙΟ</p>
    </td>
    <td>
      <p>ΔΩΜΑΤΙΟ</p>
    </td>
    <td colspan="2">
      <form>
      <input type="text" id="searchroomfield" name="searchroomfield" placeholder = "ΑΝΑΖΗΤΗΣΗ">
      <button id = "searchroombutton" name="searchroombutton" type="submit"><img src="images/lens1.png" id="lens"></button >
      </form>
    </td>
  </tr>
<?php foreach ($rooms as $row){?>
  <tr>
    <td>
      <p><?php echo getHotelById($row['HotelId'])['HotelName'];?></p>
    </td>
    <td>
      <p><?php echo $row['Room'];?><p>
    </td>
    <td>
      <a href="cloneRoom.php?room=<?php echo $row['Room'];?>&hotelid=<?php echo $row['HotelId'];?>">Κλωνοποίηση</a>
    </td>
    <td>
      <a href="room.php?room=<?php echo $row['Room'];?>&hotelid=<?php echo $row['HotelId'];?>">Λίστα εργασιών</a>
    </td>
  </tr>

<?php } ?>
  <tr>
    <td colspan="4" style="text-align: center; border: 0">
      <a href="mainpage.php">Πίσω</a>
    </td>
  </tr>
</table>
<?php
}
include 'footer.php';
?>

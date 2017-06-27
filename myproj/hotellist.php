<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

?>
<table id="hoteltable" style="width: 96%" align="center" frame="void" border="2px solid black">
  <tr>
    <td>
      <p>ΞΕΝΟΔΟΧΕΙΟ</p>
    </td>
    <td>
      <p>ΔΙΕΥΘΥΝΣΗ</p>
    </td>
    <td>
      <p>ΣΥΝΤΗΡΗΤΗΣ 1</p>
    </td>
    <td>
      <p>ΣΥΝΤΗΡΗΤΗΣ 2</p>
    </td>
    <td>
      <p>ΣΥΝΤΗΡΗΤΗΣ 3</p>
    </td>
    <td>
      <p>ΤΗΛΕΦΩΝΟ 1</p>
    </td>
    <td>
      <p>ΤΗΛΕΦΩΝΟ 2</p>
    </td>
    <td>
    </td>

  </tr>
  <?php
  $hotels=getHotels();
  foreach ($hotels as $row){?>
<tr>
  <td>
  <p><?php echo $row['HotelName'];?></p>
</td>
<td>
  <p><?php echo $row['Address'];?></p>
</td>
<td>
  <p><?php echo $row['Maintainer1']==null?"":getMaintainerById($row['Maintainer1'])["FirstName"].' '.getMaintainerById($row['Maintainer1'])["LastName"];?></p>
</td>
<td>
  <p><?php echo $row['Maintainer2']==null?"":getMaintainerById($row['Maintainer2'])["FirstName"].' '.getMaintainerById($row['Maintainer2'])["LastName"];?></p>
</td>
<td>
  <p><?php echo $row['Maintainer3']==null?"":getMaintainerById($row['Maintainer3'])["FirstName"].' '.getMaintainerById($row['Maintainer3'])["LastName"];?></p>
</td>
<td>
  <p><?php echo $row['Phone1'];?></p>
</td>
<td>
  <p><?php echo $row['Phone2'];?><p>
</td>
<td>
  <a href="addHotel.php?id=<?php echo $row['Id'];?>">Τροποποίηση</a>
</td>
</tr>
  <?php } ?>
<tr>
  <td colspan="9" style="text-align: center; border: 0">
    <a href="mainmenu.php">Πίσω</a>
</tr>
  <table>
<?php


unset($_SESSION['failedhn']);
unset($_SESSION['failedad']);
unset($_SESSION['failedp1']);
unset($_SESSION['failedp2']);
unset($_SESSION['failedm1']);
unset($_SESSION['failedm2']);
unset($_SESSION['failedm3']);
unset($_SESSION['failedun']);
unset($_SESSION['failedpw']);
unset($_SESSION['failedrpw']);


include 'footer.php'; ?>

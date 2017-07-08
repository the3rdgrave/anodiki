<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {

$works=isset($_GET['searchfield']) && $_GET['searchfield']!=""?searchWork($_GET['searchfield']):getWorks();

?>
<table id="worktable" style="width: 96%" align="center" frame="void" border="2px solid black">
  <tr>
    <td colspan="8" style="text-align: center; border: 0">
      <a href="mainmenu.php">Πίσω</a>
  </tr>
  <tr>
    <td>
      <p>ΞΕΝΟΔΟΧΕΙΟ</p>
    </td>
    <td>
      <p>ΔΩΜΑΤΙΟ</p>
    </td>
    <td>
      <p>ΣΥΣΚΕΥΗ</p>
    </td>
    <td>
      <p>ΕΡΓΑΣΙΑ</p>
    </td>
    <td>
      <p>ΗΜΕΡΕΣ</p>
    </td>
    <td>
      <p>ΕΠΙΒΕΒΑΙΩΣΗ</p>
    </td>
    <td>
      <form method="get" action="worklist.php">
      <input type="text" id="searchfield" name="searchfield" placeholder = "ΑΝΑΖΗΤΗΣΗ">
      <button id = "searchbutton" name="searchbutton" type="submit"><img src="images/lens1.png" id="lens"></button>
      </form>
    </td>

  </tr>
  <?php
  // $works=getWorks();
  foreach ($works as $row){?>
<tr>
  <td>
  <p><?php echo getHotelById($row['HotelId'])['HotelName'];?></p>
</td>
<td>
  <p><?php echo $row['Room'];?></p>
</td>
<td>
  <p><?php echo $row['Device'];?></p>
</td>
<td>
  <p><?php echo $row['Work'];?></p>
</td>
<td>
  <p><?php echo $row['Days'];?><p>
</td>
<td>
  <p><?php echo getConfirmationById($row['Confirmation'])['Confirmation'];?><p>
</td>

<td>
  <a href="mainpage.php?id=<?php echo $row['Id'];?>">Τροποποίηση</a>
</td>
</tr>
  <?php } ?>
<tr>
  <td colspan="8" style="text-align: center; border: 0">
    <a href="mainmenu.php">Πίσω</a>
</tr>
  <table>
<?php }
include 'footer.php'; ?>

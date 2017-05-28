<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

?>
<table id="worktable" style="width: 90%" align="center" frame="void" border="2px solid black">
  <tr>
    <td>
      <p>ΞΕΝΟΔΟΧΕΙΟ</p>
    </td>
    <td>
      <p>ΣΥΝΤΗΡΗΤΗΣ</p>
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
    </td>

  </tr>
  <?php
  $works=getWorks();
  foreach ($works as $row){?>
<tr>
  <td>
  <p><?php echo $row['Hotel'];?></p>
</td>
<td>
  <p><?php echo getUserById($row['MaintainerId'])["FirstName"].' '.getUserById($row['MaintainerId'])["LastName"];?></p>
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
  <td colspan="9" style="text-align: center; border: 0">
    <a href="mainmenu.php">Πίσω</a>
</tr>
  <table>

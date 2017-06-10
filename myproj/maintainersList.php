<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

?>

<table id="maintainerstable" style="width: 90%" align="center" frame="void" border="2px solid black">
  <tr>
    <th colspan="5">
      <p>ΛΙΣΤΑ ΣΥΝΤΗΡΗΤΩΝ</p>
    </th>
  </tr>
  <tr>
    <th>
      <p>ΕΠΩΝΥΜΟ</p>
    </th>
    <th>
      <p>ΟΝΟΜΑ</p>
    </th>
    <th>
      <p>ΟΝΟΜΑ ΧΡΗΣΤΗ</p>
    </th>
    <th>
      <p>ΚΩΔΙΚΟΣ</p>
    </th>
    <th>
    </th>
  </tr>
  <?php $ms=getMaintainers();
  foreach ($ms as $row) {?>
    <tr>
      <td>
        <p><?php echo $row['LastName'];?></p>
      </td>
      <td>
        <p><?php echo $row['FirstName'];?></p>
      </td>
      <td>
        <p><?php echo $row['Username'];?></p>
      </td>
      <td>
        <p><?php echo $row['Password'];?></p>
      </td>
      <td>
        <a href="addMaintainer.php?id=<?php echo $row['Id'];?>">Τροποποίηση</a>
      </td>
    </tr>


<?php  } ?>
    <tr>
      <td colspan="5" style="text-align: center; border: 0">
        <a href="mainmenu.php">Πίσω</a>
      </td>
    </tr>

</table>

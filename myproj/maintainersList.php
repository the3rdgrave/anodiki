<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {

?>

<table id="maintainerstable" style="width: 60%" align="center" frame="void" border="2px solid black">
  <tr>
    <th colspan="3">
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
        <a href="addMaintainer.php?id=<?php echo $row['Id'];?>">Τροποποίηση</a>
      </td>
    </tr>


<?php  } ?>
    <tr>
      <td colspan="3" style="text-align: center; border: 0">
        <a href="mainmenu.php">Πίσω</a>
      </td>
    </tr>

</table>
<?php }

unset($_SESSION['failedfn']);
unset($_SESSION['failedln']);

include 'footer.php'; ?>

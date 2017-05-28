<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

$maintainer=getUserById($_SESSION['userid']);
?>

<table id="maintaintable" style="width:90%" frame="void" border="2px solid black">
  <tr>
    <td>
      <p>Συντηρητής: <?php echo $maintainer['FirstName'].' '.$maintainer['LastName'];?></p>
    </td>
  </tr>
  <tr>
  <tr>
    <td>
      <p>ΣΤΟΙΧΕΙΑ ΞΕΝΟΔΟΧΕΙΟΥ</p>
    </td>
  </tr>
  <tr>
    <td colspan="4">
      <p>ΗΜΕΡΟΛΟΓΙΟ ΕΡΓΑΣΙΩΝ</p>
    </td>
  </tr>
  <tr>
    <td>
      <p>ΗΜΕΡΟΜΗΝΙΑ/ΔΩΜΑΤΙΑ</p>
    </td>
    <td>
      <p>ΕΡΓΑΣΙΑ</p>
    </td>
    <td>
      <p>ΕΠΙΒΕΒΑΙΩΣΗ</p>
    </td>
    <td>
      <p>ΣΗΜΕΙΩΣΕΙΣ</p>
    </td>
  </tr>
  <?php
  $works=getWorksByMaintainer($maintainer['Id']);
  foreach($works as $row) {?>
  <tr>
    <td>
      <p><?php echo $row['Room'];?></p>
    </td>
    <td>
      <p><?php echo $row['Work'];?></p>
    </td>
    <td style="text-align: center">
        <input type="checkbox" name="confirmed" value="confirmed"><br>
    </td>

    <td>
        <input type="text" name="notes" placeholder="ΣΗΜΕΙΩΣΕΙΣ">
    </td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3" style="text-align: center; border: 0">
      <button type="submit">Αποστολή Αναφοράς</button>
    </td>
    <td style="text-align: right; border: 0">
      <a href="logout.php">Έξοδος</a>
    </td>
  </tr>

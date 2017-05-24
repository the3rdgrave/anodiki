<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

?>
<table align="center" style="width: 90%">
  <?php
  $works=getWorks();
  foreach ($works as $row){?>
<tr>
  <td>
  <?php echo $row['Hotel'];?>
</td>
<td>
  <?php echo $row['MaintainerId'];?>
</td>
<td>
  <?php echo $row['Room'];?>
</td>
<td>
  <?php echo $row['Device'];?>
</td>
<td>
  <?php echo $row['Work'];?>
</td>
<td>
  <?php echo $row['Days'];?>
</td>
<td>
  <a href="mainpage.php?id=<?php echo $row['Id'];?>">Τροποποίηση</a>
</td>
<tr>
  <?php } ?>
  <table>

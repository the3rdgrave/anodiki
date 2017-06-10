<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

$work=getWorkById($_GET['id']);
?>
<table align="center">
  <tr>
    <td colspan="2">
      <p>Διαγραφή της εργασίας <?php echo $work['Work'];?> στο δωμάτιο <?php echo $work['Room'].'/'.$work['Hotel'];?>;</p>
    </td>
    <tr>
      <td style="text-align: center">
        <button type="submit">Ναι</button>
      </td>
      <td style="text-align: center">
        <a href="mainpage.php?id=<?php echo $work['Id'];?>">Όχι</a>
      </td>
    </tr>
  </table>

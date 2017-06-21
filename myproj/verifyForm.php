<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';


if(isset($_POST['submitreport'])){

  if(!empty($_POST['notes'])){

  foreach($_POST['notes'] as $row1){
    $work1=getWorkById(array_search($row1, $_POST['notes']));
    updateWork($work1['Id'], $work1['Hotel'], $work1['Address'], $work1['MaintainerId'], $work1['Phone1'], $work1['Phone2'], $work1['EmailReport1'], $work1['EmailReport2'], $work1['Room'], $work1['Device'], $work1['Work'], $work1['Days'],
    $work1['Date'], $work1['Confirmation'], $row1);
    }
  }


  if(!empty($_POST['confirmed'])){?>
    <table id="reporttable" frame="void" border="2px solid black" align="center">
      <tr>
        <td colspan="2">
          <p><?php echo getUserById($_SESSION['userid'])['FirstName'].' '.getUserById($_SESSION['userid'])['LastName'];?></p>
        </td>
        <td colspan="2">
          <?php echo date("j/n/Y");?>
        </td>
        <tr>
          <tr>
            <th>
              <p>ΕΡΓΑΣΙΑ</p>
            </th>
            <th>
              <p>ΔΩΜΑΤΙΟ</p>
            </th>
            <th>
              <p>ΞΕΝΟΔΟΧΕΙΟ</p>
            </th>
            <th>
              <p>ΣΗΜΕΙΩΣΕΙΣ</p>
            </th>
      <?php
  foreach($_POST['confirmed'] as $row){
    // echo $row.':'.getWorkById($row)['Work'].'<br>';
    // $workdate=date_parse(getWorkById($row)['Date'])['day'].'/'.date_parse(getWorkById($row)['Date'])['month'].'/'.date_parse(getWorkById($row)['Date'])['year'];
    // echo $workdate.'<br>';
    // echo $currentdate=date("j/n/Y");
    $work=getWorkById($row);
    updateWork($work['Id'], $work['Hotel'], $work['Address'], $work['MaintainerId'], $work['Phone1'], $work['Phone2'], $work['EmailReport1'], $work['EmailReport2'], $work['Room'], $work['Device'], $work['Work'], $work['Days'],
    $work['Date'], 1, array_key_exists($work['Id'], $_POST['notes'])?$_POST['notes'][$work['Id']]:null);
    if(checkPendingByWorkId($work['Id'])==true){
      deletePendingWork($work['Id']);
    } ?>
    <tr>
      <td>
        <p><?php echo getWorkById($row)['Work'];?></p>
      </td>
      <td>
        <p><?php echo getWorkById($row)['Room'];?></p>
      </td>
      <td>
        <p><?php echo getWorkById($row)['Hotel'];?></p>
      </td>
      <td>
        <p><?php echo getWorkById($row)['Notes'];?></p>
      </td>
    </tr>

  <?php
  }
  ?>
  <tr>
    <td colspan="4" style="text-align: center; border: 0">
       <a href="maintainer.php">Επιστροφή στις εργασίες</a>
     </td>
   </tr>
  </table> <?php
  }

}

include 'footer.php';
?>

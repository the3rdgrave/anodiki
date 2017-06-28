<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';


if(isset($_POST['submitreport'])){

  // if(!empty($_POST['notes'])){
  //
  // foreach($_POST['notes'] as $row1){
  //   $work1=getWorkById(array_search($row1, $_POST['notes']));
  //   updateWork($work1['Id'], $work1['Hotel'], $work1['Address'], $work1['MaintainerId'], $work1['Phone1'], $work1['Phone2'], $work1['EmailReport1'], $work1['EmailReport2'], $work1['Room'], $work1['Device'], $work1['Work'], $work1['Days'],
  //   $work1['Date'], $work1['Confirmation'], $row1);
  //   }
  //

  if(!empty($_POST['confirmed'])){?>
    <table id="reporttable" frame="void" border="2px solid black" align="center">
      <tr>
        <td>
          <p><?php echo $_POST['maintainerselect'];?></p>
        </td>
        <td>
          <p><?php echo $_SESSION['hotname'];?></p>
        </td>
        <td>
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
              <p>ΣΗΜΕΙΩΣΕΙΣ</p>
            </th>
      <?php
  foreach($_POST['confirmed'] as $row){

    $work=getWorkById($row);
    updateWork($work['Id'], $work['HotelId'], $work['EmailReport1'], $work['EmailReport2'], $work['Room'], $work['Device'], $work['Work'], $work['Days'],
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
        <p><?php echo getWorkById($row)['Notes'];?></p>
      </td>
    </tr>

  <?php
  }
  ?>
  <tr>
    <td colspan="3" style="text-align: center; border: 0">
       <a href="hotel.php">Επιστροφή στις εργασίες</a>
     </td>
   </tr>
  </table> <?php
  }
  // echo $_SESSION['logintime'].'<br>';
  // echo strtotime($_SESSION['logintime']).'<br><br>';
  //
  // echo time().'<br>';
  // echo date('Y-m-d H:i:s', time()).'<br>';

  $duration=time()-$_SESSION['logintime'];
  $mins=intval($duration/60);
echo $mins.' mins '.($duration-$mins*60).' secs';
}

include 'footer.php';
?>

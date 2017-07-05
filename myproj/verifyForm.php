<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';


if(isset($_POST['submitreport'])){


    // if(!empty($_POST['notes'])){
  //
  // foreach($_POST['notes'] as $row1){
  //   $work1=getWorkById(array_search($row1, $_POST['notes']));
  //   updateWork($work1['Id'], $work1['HotelId'], $work1['Room'], $work1['Device'], $work1['Work'], $work1['Days'],
  //   $work1['Date'], $work1['Confirmation'], $row1);
  //   }
  // }
  $duration=time()-$_SESSION['logintime'];
  $hours=intval($duration/3600);
  $durationleft=$duration-$hours*3600;
  $mins=intval($durationleft/60);
  $secs=$durationleft-$mins*60;

  // if(!empty($_POST['confirmed'])){
  ?>
    <table id="reporttable" style="width: 80%" frame="void" border="2px solid black" align="center">
      <tr>
        <td colspan="2">
          <p><?php echo $_POST['maintainerselect'];?></p>
        </td>
        <td>
          <p><?php echo $_SESSION['hotname'];?></p>
        </td>
        <td>
          <?php echo date("j/n/Y");?>
        </td>
        <td>
          <p><?php echo $hours.' hours '.$mins.' mins '.$secs.' secs';?></p>
        </td>
      </tr>
          <tr>
            <th>
              <p>ΣΥΣΚΕΥΗ</p>
            </th>
            <th>
              <p>ΕΡΓΑΣΙΑ</p>
            </th>
            <th>
              <p>ΔΩΜΑΤΙΟ</p>
            </th>
            <th>
              <p>ΕΠΙΒΕΒΑΙΩΣΗ</p>
            </th>
            <th>
              <p>ΣΗΜΕΙΩΣΕΙΣ</p>
            </th>

      <?php
      if(!empty($_POST['notes'])){
      foreach(array_keys($_POST['notes']) as $row){
    // echo array_search($row, $_POST['notes']);
    $work=getWorkById($row);
    updateWork($work['Id'], $work['HotelId'], $work['Room'], $work['Device'], $work['Work'], $work['Days'],
    $work['Date'], !empty($_POST['confirmed']) && in_array($work['Id'],$_POST['confirmed'])?1:0, $_POST['notes'][$work['Id']]);
    if(!empty($_POST['confirmed']) && in_array($work['Id'],$_POST['confirmed']) && checkPendingByWorkId($work['Id'])==true){
      deletePendingWork($work['Id']);
    }
    $work=getWorkById($row);?>
    <tr>
      <td>
        <p><?php echo $work['Device'];?></p>
      </td>
      <td>
        <p><?php echo $work['Work'];?></p>
      </td>
      <td>
        <p><?php echo $work['Room'];?></p>
      </td>
      <td>
        <p><?php echo getConfirmationById($work['Confirmation'])['Confirmation'];?></p>
      </td>
      <td>
        <p><?php echo $work['Notes'];?></p>
      </td>
    </tr>

  <?php
  } }
  ?>
  <tr>
    <td colspan="5" style="text-align: center; border: 0">
       <a href="hotel.php">Επιστροφή στις εργασίες</a>
     </td>
   </tr>
  </table> <?php
  // }
}

include 'footer.php';
?>

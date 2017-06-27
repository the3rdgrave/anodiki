<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if ($_SESSION['role']==2){

  $user=getUserById($_SESSION['userid']);

  $works=getWorksByHotel($user['HotelId']);
  ?>
  <form id="hotelform" action="verifyForm.php" method="post">
  <table id="hoteltable" style="width:90%" align="center" frame="void" border="2px solid black">

    <tr>
      <td>
        <p>ΣΤΟΙΧΕΙΑ ΞΕΝΟΔΟΧΕΙΟΥ</p>
      </td>
      <td colspan ="4">
        <p><?php echo getHotelById($user['Id'])['HotelName'].', '.getHotelById($user['Id'])['Address'];?></p>
      </td>
    </tr>
    <tr>
      <td style="border: 0">
        <p></p>
      </td>
    </tr>
    <tr>
      <td>
        <p>ΗΜΕΡΟΛΟΓΙΟ ΕΡΓΑΣΙΩΝ</p>
      </td>
      <td colspan="4" style="text-align: center">
        <p>ΗΜΕΡΟΛΟΓΙΟ ΕΡΓΑΣΙΩΝ ΣΗΜΕΡΑ</p>
      </td>
    </tr>
    <tr>
      <td>
        <?php echo date("j/n/Y"); ?>
        <br>
        ΔΩΜΑΤΙΟ:
        <select id="roomselect">
          <option>ΟΛΑ</option>
          <?php $rooms=getRoomsByHotel(getHotelById($user['Id'])['HotelId']);
          foreach ($rooms as $row2){ ?>
              <option><?php echo $row2['Room'];?></option>
          <?php } ?>
        </select>

      </td>
      <td>
        <p>ΣΥΣΚΕΥΗ</p>
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
    $works=getWorksByHotel(getHotelById($user['Id'])['HotelId']);
    foreach($works as $row) { ?>
    <tr class="work <?php echo $row['Room'];?>">
        <td>
            <p><?php echo 'ΔΩΜΑΤΙΟ: '.$row['Room'];?></p>
        </td>
      <td>
        <p><?php echo $row['Device'];?></p>
      </td>
      <td>
        <p><?php echo $row['Work'];?></p>
      </td>
      <td style="text-align: center">
          <input type="checkbox" name="confirmed[]" value="<?php echo $row['Id'];?>"><br>
      </td>

      <td>
          <input type="text" name="notes[<?php echo $row['Id'];?>]" placeholder="ΣΗΜΕΙΩΣΕΙΣ">
      </td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="5" style="border: 0">
        <p></p>
      </td>
    </tr>




    <?php
    $pendingworks=getPendingWorksByHotel(getHotelById($user['Id'])['HotelId']);
    if($pendingworks!=null){ ?>
      <tr>
        <td style="border: 0">
          <p></p>
        </td>
      </tr>
      <tr style="background-color: red">
        <td>
          <p>ΗΜΕΡΟΛΟΓΙΟ ΕΡΓΑΣΙΩΝ</p>
        </td>
        <td colspan="4" style="text-align: center">
          <p>ΗΜΕΡΟΛΟΓΙΟ ΠΕΡΑΣΜΕΝΩΝ ΕΡΓΑΣΙΩΝ</p>
        </td>
      </tr>
      <tr>
        <td>
          <br>ΗΜΕΡΟΜΗΝΙΑ (ΔΩΜΑΤΙΟ/ΞΕΝΟΔ.)
        </td>
        <td>
          <p>ΣΥΣΚΕΥΗ</p>
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

    foreach ($pendingworks as $row1) { ?>
      <tr>
        <td>
          <p><?php echo date("j/n/Y", strtotime($row1['DueDate'])).' ('.getWorkById($row1['WorkId'])['Room'].'/'.getWorkById($row1['WorkId'])['Hotel'].')';?></p>
        </td>
      <td>
        <p><?php echo getWorkById($row1['WorkId'])['Device'];?></p>
      </td>
      <td>
        <p><?php echo getWorkById($row1['WorkId'])['Work'];?></p>
      </td>
      <td style="text-align: center">
          <input type="checkbox" name="confirmed[]" value="<?php echo $row1['WorkId'];?>"><br>
      </td>

      <td>
          <input type="text" name="notes[<?php echo $row1['WorkId'];?>]" placeholder="ΣΗΜΕΙΩΣΕΙΣ">
      </td>
    </tr>


    <?php } ?>
    <tr>
      <td colspan="5" style="border: 0">
        <p></p>
      </td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="4" style="text-align: center; border: 0">
        <button name="submitreport" type="submit">Αποστολή Αναφοράς</button>
      </td>
      <td style="text-align: right; border: 0">
        <a href="logout.php">Έξοδος</a>
      </td>
    </tr>
  </table>
  </form>
  <!-- <button id="tablegone">Εξαφάνιση</button> -->
  <?php } else {
    header('Location: index.php');
  }
include 'footer.php'; ?>

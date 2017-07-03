<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if ($_SESSION['role']==2){

  $user=getHotelById($_SESSION['userid']);

  $works=getWorksByHotel($user['Id']);
  ?>
  <form id="hotelform" action="verifyForm.php" method="post">
  <table id="workshoteltable" style="width:90%" align="center" frame="void" border="2px solid black">

    <tr>
      <td>
        <p>ΣΤΟΙΧΕΙΑ ΞΕΝΟΔΟΧΕΙΟΥ</p>
      </td>
      <td colspan ="4">
        <p><?php echo $user['HotelName'].', '.$user['Address'];?></p>
      </td>
    </tr>
    <tr>
      <td style="border: 0">
        <p></p>
      </td>
    </tr>
    <?php if ($works!=null) {?>
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
          <?php $rooms=getRoomsByHotel($user['Id']);
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
  }
    $pendingworks=getPendingWorksByHotel($user['Id']);
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
          <br>ΗΜΕΡΟΜΗΝΙΑ (ΔΩΜΑΤΙΟ)
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
          <p><?php echo date("j/n/Y", strtotime($row1['DueDate'])).' ('.getWorkById($row1['WorkId'])['Room'].')';?></p>
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
      <td colspan="3" style="text-align: center; border: 0">
        <?php if ($user['Maintainer1']!=null || $user['Maintainer2']!=null || $user['Maintainer3']!=null){?>
        <button name="submitreport" type="submit">Αποστολή Αναφοράς</button>
        <?php } ?>
      </td>
      <td style="text-align: left; border: 0">
        <?php if ($user['Maintainer1']!=null || $user['Maintainer2']!=null || $user['Maintainer3']!=null){ ?>
        <select id="maintainerselect" name="maintainerselect">
            <?php if ($user['Maintainer1']!=null){?>
            <option><?php echo getMaintainerById($user['Maintainer1'])['FirstName'].' '.getMaintainerById($user['Maintainer1'])['LastName'];?></option>
            <?php } if ($user['Maintainer2']!=null){ ?>
            <option><?php echo getMaintainerById($user['Maintainer2'])['FirstName'].' '.getMaintainerById($user['Maintainer2'])['LastName'];?></option>
            <?php } if ($user['Maintainer3']!=null){?>
            <option><?php echo getMaintainerById($user['Maintainer3'])['FirstName'].' '.getMaintainerById($user['Maintainer3'])['LastName'];?></option>
            <?php } ?>
        </select>
        <?php } else {?>
          <p>ΔΕΝ ΥΠΑΡΧΟΥΝ ΣΥΝΤΗΡΗΤΕΣ<p>
          <?php } ?>
        </td>
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

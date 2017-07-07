<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if ($_SESSION['role']==2){

  $user=getHotelById($_SESSION['userid']);

  $works=getWorksByHotel($user['Id']);
  ?>
  <form id="hotelform" action="verifyForm.php" method="post">

  <table id="workshoteltable" style="width:96%" align="center" frame="void" border="2px solid black">

    <tr>
      <td style="width:25%">
        <p>ΣΤΟΙΧΕΙΑ ΞΕΝΟΔΟΧΕΙΟΥ</p>
      </td>
      <td colspan ="5">
        <p><?php echo $user['HotelName'].', '.$user['Address'];?></p>
      </td>
    </tr>
    <tr>
      <td style="border: 0">
        <p></p>
      </td>
    </tr>
    <?php if ($works!=null && strtotime(date('Y-m-d', strtotime($user['StartingDate'])))<=strtotime(date('Y-m-d',strtotime("now")))) {?>
    <tr>
      <td>
        <p>ΗΜΕΡΟΛΟΓΙΟ ΕΡΓΑΣΙΩΝ</p>
      </td>
      <td colspan="5" style="text-align: center">
        <p>ΗΜΕΡΟΛΟΓΙΟ ΕΡΓΑΣΙΩΝ ΣΗΜΕΡΑ</p>
      </td>
    </tr>
    <tr>
      <?php
      $rooms=getRoomsByHotel($user['Id']); ?>
      <td valign="top" rowspan="<?php echo sizeof($works)+1;?>" id="<?php echo sizeof($works)+1;?>">
        <?php echo date("j/n/Y");?>
        <br>
          <button class="roomselect" id="<?php echo date('Y-m-d');?>" type="button" name="ΟΛΑ">ΟΛΑ</button>
        <?php
          foreach ($rooms as $row2){ ?>
              <button class="roomselect" type="button" id="<?php echo date('Y-m-d');?>" name="<?php echo $row2['Room'];?>"><?php echo $row2['Room'];?></button>
          <?php } ?>

      </td>
      <td>
        <p>ΔΩΜΑΤΙΟ</p>
      </td>
      <td>
        <p>ΣΥΣΚΕΥΗ</p>
      </td>
      <td>
        <p>ΕΡΓΑΣΙΑ</p>
      </td>
      <td>
        <p>ΕΠΙΒΕΒ.</p>
      </td>
      <td>
        <p>ΣΗΜΕΙΩΣΕΙΣ</p>
      </td>
    </tr>
    <?php
    foreach($works as $row) { ?>
    <tr class="work <?php echo date('Y-m-d').' '.$row['Room'];?>">

      <td>
        <p><?php echo $row['Room'];?></p>
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
          <input type="text" style="width:100%" name="notes[<?php echo $row['Id'];?>]" placeholder="ΣΗΜΕΙΩΣΕΙΣ">
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


  for ($i=1; $i<8; ++$i){
    $date=date("Y-m-d", strtotime("+".$i." day", strtotime("now")));
    $upcomingworks=getUpcomingWorksByHotel($user["Id"],$date);

    // var_dump($upcomingworks);
    if(!empty($upcomingworks && strtotime(date('Y-m-d', strtotime($user['StartingDate'])))<=strtotime(date('Y-m-d',strtotime($date))))){ ?>
    <tr>
      <td>
        <p>ΗΜΕΡΟΛΟΓΙΟ ΕΡΓΑΣΙΩΝ</p>
      </td>
      <td colspan="6" style="text-align: center">
        <p>ΗΜΕΡΟΛΟΓΙΟ ΕΡΓΑΣΙΩΝ ΓΙΑ <?php echo date('j/n/Y', strtotime($date));?></p>
      </td>
    </tr>

    <tr>
      <?php
      $rooms=getUpcomingRoomsByHotel($user['Id'], $date); ?>
      <td valign="top" rowspan="<?php echo sizeof($upcomingworks)+1;?>" id="<?php echo sizeof($upcomingworks)+1;?>">
        <?php echo date("j/n/Y", strtotime($date));?>
        <br>
          <button class="roomselect" id="<?php echo $date;?>" type="button" name="ΟΛΑ">ΟΛΑ</button>
        <?php
          foreach ($rooms as $row2){ ?>
              <button class="roomselect" type="button" id="<?php echo $date;?>" name="<?php echo $row2['Room'];?>"><?php echo $row2['Room'];?></button>
          <?php } ?>
      </td>
      <td>
        <p>ΔΩΜΑΤΙΟ</p>
      </td>
      <td>
        <p>ΣΥΣΚΕΥΗ</p>
      </td>
      <td colspan="3">
        <p>ΕΡΓΑΣΙΑ</p>
      </td>
    </tr>
    <?php

    foreach($upcomingworks as $row) { ?>
    <tr class="work <?php echo $date.' '.$row['Room'];?>">
      <!-- <td style="border: 0">
        <p>
        </p>
      </td> -->
      <td>
        <p><?php echo $row['Room'];?></p>
      </td>
      <td>
        <p><?php echo $row['Device'];?></p>
      </td>
      <td colspan="3">
        <p><?php echo $row['Work'];?></p>
      </td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="6" style="border: 0">
        <p></p>
      </td>
    </tr>

    <?php
    }
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
        <td colspan="5" style="text-align: center">
          <p>ΗΜΕΡΟΛΟΓΙΟ ΠΕΡΑΣΜΕΝΩΝ ΕΡΓΑΣΙΩΝ</p>
        </td>
      </tr>
      <tr>
        <td>
          <p>ΗΜΕΡΟΜΗΝΙΑ</p>
        </td>
        <td>
          <p>ΔΩΜΑΤΙΟ</p>
        </td>
        <td>
          <p>ΣΥΣΚΕΥΗ</p>
        </td>
        <td>
          <p>ΕΡΓΑΣΙΑ</p>
        </td>
        <td>
          <p>ΕΠΙΒΕΒ.</p>
        </td>
        <td>
          <p>ΣΗΜΕΙΩΣΕΙΣ</p>
        </td>
      </tr>

      <?php

    foreach ($pendingworks as $row1) { ?>
      <tr>
        <td>
          <p><?php echo date("j/n/Y", strtotime($row1['DueDate']));?></p>
        </td>
        <td>
          <p><?php echo getWorkById($row1['WorkId'])['Room'];?></p>
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
      <td colspan="6" style="border: 0">
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
      <td style="text-align: left; border: 0" colspan="2">ΣΥΝΤΗΡΗΤΗΣ:
        <?php if ($user['Maintainer1']!=null || $user['Maintainer2']!=null || $user['Maintainer3']!=null){ ?>
        <select id="maintainerselect" name="maintainerselect">
            <?php if ($user['Maintainer1']!=""){?>
            <option><?php echo $user['Maintainer1'];?></option>
            <?php } if ($user['Maintainer2']!=""){ ?>
            <option><?php echo $user['Maintainer2'];?></option>
            <?php } if ($user['Maintainer3']!=""){?>
            <option><?php echo $user['Maintainer3'];?></option>
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
  <?php } else {
    header('Location: index.php');
  }
include 'footer.php'; ?>

<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
}
else{
  if(isset($_GET['id']) && $_GET['id']!=0){
    $hotel=getHotelById($_GET['id']);
    if($hotel!=null){
      if(!isset($_SESSION['failedhn']))
        $_SESSION['failedhn']=$hotel['HotelName'];
      if(!isset($_SESSION['failedad']))
        $_SESSION['failedad']=$hotel['Address'];
      if(!isset($_SESSION['failedm1']))
        $_SESSION['failedm1']=$hotel['Maintainer1']==null?"":getMaintainerById($hotel['Maintainer1'])["FirstName"].' '.getMaintainerById($hotel['Maintainer1'])["LastName"];
      if(!isset($_SESSION['failedm2']))
        $_SESSION['failedm2']=$hotel['Maintainer2']==null?"":getMaintainerById($hotel['Maintainer2'])["FirstName"].' '.getMaintainerById($hotel['Maintainer2'])["LastName"];
      if(!isset($_SESSION['failedm3']))
        $_SESSION['failedm3']=$hotel['Maintainer3']==null?"":getMaintainerById($hotel['Maintainer3'])["FirstName"].' '.getMaintainerById($hotel['Maintainer3'])["LastName"];
      if(!isset($_SESSION['failedp1']))
        $_SESSION['failedp1']=$hotel['Phone1'];
      if(!isset($_SESSION['failedp2']))
        $_SESSION['failedp2']=$hotel['Phone2'];
      if(!isset($_SESSION['faileder1']))
        $_SESSION['faileder1']=$hotel['EmailReport1'];
      if(!isset($_SESSION['faileder2']))
        $_SESSION['faileder2']=$hotel['EmailReport2'];
      if(!isset($_SESSION['failedun']))
        $_SESSION['failedun']=$hotel['Username'];
      if(!isset($_SESSION['failedpw']))
        $_SESSION['failedpw']=$hotel['Password'];
      if(!isset($_SESSION['failedrpw']))
        $_SESSION['failedrpw']=$hotel['Password'];
      if(!isset($_SESSION['faileddate']))
        $_SESSION['faileddate']=$hotel['StartingDate'];
    }
  }

 if (isset($_GET['id']) && ($_GET['id'])!=null){?>
<form method="post" action="validateNewHotel.php?id=<?php echo $_GET['id'];?>"><?php } else {?>
<form method="post" action="validateNewHotel.php"><?php } ?>
<table id="formtable" align="center" frame="void" border="2px solid black" cellspacing="10">
  <tr>
  <td colspan="4" style="text-align:center">
<p>
  ΕΙΣΑΓΩΓΗ ΣΤΟΙΧΕΙΩΝ ΞΕΝΟΔΟΧΕΙΟΥ
</p>
  </td>
</tr>
    <tr>
      <td>
      <label for="hotelname">ΟΝΟΜΑ</label>
    </td>
    <td colspan="2" style="border: 0">
      <input style="width: 100%" type="text" id="hotelname" name="hotelname" value="<?php echo (isset($_SESSION['failedhn'])?$_SESSION['failedhn']:"");?>">
    </td>
    </tr>
    <tr>
      <td>
      <label for="address">ΔΙΕΥΘΥΝΣΗ</label>
    </td>
    <td colspan="2" style="border: 0">
      <input type="text" id="address" name="address" style="width: 100%" value="<?php echo (isset($_SESSION['failedad'])?$_SESSION['failedad']:"");?>">
    </td>
    </tr>
    <tr>
      <td>
      <label for="maintainer1">ΣΥΝΤΗΡΗΤΕΣ</label>
    </td>
    <td style="border: 0">
      <select id="maintainer1" name="maintainer1">
        <option></option>
        <?php $maintainers=getMaintainers();
        foreach ($maintainers as $row) {?>
          <option <?php
          if (isset($_SESSION['failedm1']) && $row['FirstName'].' '.$row['LastName']==$_SESSION['failedm1']){
             echo 'selected'; } ?>>
           <?php echo $row['FirstName'].' '.$row['LastName'];?></option>
          <?php
          } ?>
        </select>
    </td>
    <td style="border: 0">
      <select id="maintainer2" name="maintainer2">
        <option></option>
        <?php $maintainers=getMaintainers();
        foreach ($maintainers as $row) {?>
          <option <?php
          if (isset($_SESSION['failedm2']) && $row['FirstName'].' '.$row['LastName']==$_SESSION['failedm2']){
             echo 'selected'; } ?>>
           <?php echo $row['FirstName'].' '.$row['LastName'];?></option>
          <?php
          } ?>
        </select>
    </td>
    <td style="border: 0">
      <select id="maintainer3" name="maintainer3">
        <option></option>
        <?php $maintainers=getMaintainers();
        foreach ($maintainers as $row) {?>
          <option <?php
          if (isset($_SESSION['failedm3']) && $row['FirstName'].' '.$row['LastName']==$_SESSION['failedm3']){
             echo 'selected'; } ?>>
           <?php echo $row['FirstName'].' '.$row['LastName'];?></option>
          <?php
          } ?>
        </select>
    </td>
    </tr>
    <tr>
      <td>
      <label for="phone1">ΤΗΛΕΦΩΝΟ</label>
    </td>
    <td style="border: 0">
      <input type="text" id="phone1" name="phone1" value="<?php echo (isset($_SESSION['failedp1'])?$_SESSION['failedp1']:"");?>">
    </td>
    <td style="border: 0">
      <input type="text" id="phone2" name="phone2" value="<?php echo (isset($_SESSION['failedp2'])?$_SESSION['failedp2']:"");?>">
    </td>
    </tr>
    <tr>
      <td>
      <label for="emailreport">EMAIL REPORT</label>
    </td>
    <td style="border: 0">
      <input type="text" id="emailreport" name="emailreport" value="<?php echo (isset($_SESSION['faileder1'])?$_SESSION['faileder1']:"");?>">
    </td>
    <td style="border: 0">
      <input type="text" id="emailreport2" name="emailreport2" value="<?php echo (isset($_SESSION['faileder2'])?$_SESSION['faileder2']:"");?>">
    </td>
    </tr>
    <tr>
      <td>
        <label for="day">ΗΜΕΡΟΜΗΝΙΑ ΕΝΑΡΞΗΣ<br>ΕΡΓΑΣΙΩΝ</label>
      </td>
      <td style="border: 0">
        <input type="date" id="date" name="date" style="width:100%" value="<?php echo (isset ($_SESSION['faileddate'])?date('Y-m-d', strtotime($_SESSION['faileddate'])):date('Y-m-d'));?>">
      </td>
    </tr>

    <tr>
      <td>
      <label for="un">ΟΝΟΜΑ ΧΡΗΣΤΗ</label>
    </td>
    <td style="border: 0" colspan="2">
      <input type="text" id="un" name="un" style="width:100%" value="<?php echo (isset($_SESSION['failedun'])?$_SESSION['failedun']:"");?>">
    </td>
    </tr>
    <tr>
      <td>
      <label for="pw">ΚΩΔΙΚΟΣ</label>
    </td>
    <td style="border: 0" colspan="2">
      <input type="text" id="pw" name="pw" style="width:100%" value="<?php echo (isset($_SESSION['failedpw'])?$_SESSION['failedpw']:"");?>">
    </td>
    </tr>
    <tr>
      <td>
      <label for="rpw">ΕΠΑΝ.ΚΩΔΙΚΟΥ</label>
    </td>
    <td style="border: 0" colspan="2">
      <input type="text" id="rpw" name="rpw" style="width:100%" value="<?php echo (isset($_SESSION['failedrpw'])?$_SESSION['failedrpw']:"");?>">
    </td>
    </tr>
    <tr>
      <td colspan="4" style="text-align: center; border: 0">
        <?php if(isset($_GET['id']) && $_GET['id']!=0){ ?>
        <button type="submit" name="updatehotelbutton">Υποβολή</button>
        <?php } else { ?>
          <button type="submit" name="newhotelbutton">Υποβολή</button>
        <?php } ?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="text-align: center; border: 0">
        <?php if(isset($_GET['id']) && $_GET['id']!=0){?>
        <a href="hotellist.php">Πίσω</a>
        <?php } else { ?>
          <a href="mainmenu.php">Πίσω</a>
        <?php } ?>
      </td>
    </tr>
    </table>
  </form>
    <?php }

    unset($_SESSION['failedhn']);
    unset($_SESSION['failedad']);
    unset($_SESSION['failedp1']);
    unset($_SESSION['failedp2']);
    unset($_SESSION['failedm1']);
    unset($_SESSION['failedm2']);
    unset($_SESSION['failedm3']);
    unset($_SESSION['failedun']);
    unset($_SESSION['failedpw']);
    unset($_SESSION['failedrpw']);
    unset($_SESSION['faileddate']);
    unset($_SESSION['faileder1']);
    unset($_SESSION['faileder2']);

    ?>

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
        $_SESSION['failedm1']=$hotel['Maintainer1']==null?"":getUserById($hotel['Maintainer1'])["FirstName"].' '.getUserById($hotel['Maintainer1'])["LastName"];
      if(!isset($_SESSION['failedm2']))
        $_SESSION['failedm2']=$hotel['Maintainer2']==null?"":getUserById($hotel['Maintainer2'])["FirstName"].' '.getUserById($hotel['Maintainer2'])["LastName"];
      if(!isset($_SESSION['failedm3']))
        $_SESSION['failedm3']=$hotel['Maintainer3']==null?"":getUserById($hotel['Maintainer3'])["FirstName"].' '.getUserById($hotel['Maintainer3'])["LastName"];
      if(!isset($_SESSION['failedp1']))
        $_SESSION['failedp1']=$hotel['Phone1'];
      if(!isset($_SESSION['failedp2']))
        $_SESSION['failedp2']=$hotel['Phone2'];
    }
  }
  ?>

<?php if (isset($_GET['id']) && ($_GET['id'])!=null){?>
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
      <label for="maintainer1">ΣΥΝΤΗΡΗΤΗΣ</label>
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

    ?>

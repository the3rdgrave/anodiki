<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if(isset($_GET['id']) && $_GET['id']!=null){
  $work=getWorkById($_GET['id']);
  if ($work!=null){
    $_SESSION['hotelname']=$work['Hotel'];
    $_SESSION['address']=$work['Address'];
    $_SESSION['phone1']=$work['Phone1'];
    $_SESSION['phone2']=$work['Phone2'];
    $_SESSION['emailreport']=$work['EmailReport1'];
    $_SESSION['emailreport2']=$work['EmailReport2'];
    $_SESSION['room']=$work['Room'];
    $_SESSION['device']=$work['Device'];
    $_SESSION['work']=$work['Work'];
    $_SESSION['days']=$work['Days'];

  }
}
?>

<body>
<form method="post" action="validateNew.php">
<table id="formtable" align="center" frame="void" border="2px solid black" cellspacing="10">
  <tr>
  <td colspan="3" style="text-align:center">
<p>
  ΕΙΣΑΓΩΓΗ ΣΤΟΙΧΕΙΩΝ ΞΕΝΟΔΟΧΕΙΟΥ
</p>
  </td>
</tr>
    <tr>
      <td>
      <label for="hotelname">ΟΝΟΜΑ</label>
    </td>
    <td>
      <input type="text" id="hotelname" name="hotelname" value=<?php echo (isset($_SESSION['hotelname'])?$_SESSION['hotelname']:"");?>>
    </td>
    </tr>
    <tr>
      <td>
      <label for="address">ΔΙΕΥΘΥΝΣΗ</label>
    </td>
    <td>
      <input type="text" id="address" name="address" value=<?php echo (isset($_SESSION['address'])?$_SESSION['address']:"");?>>
    </td>
    </tr>
    <tr>
      <td>
      <label for="maintainer">ΣΥΝΤΗΡΗΤΗΣ</label>
    </td>
    <td colspan="2" style="border: 0">
      <select>
    <option value="maintainer1">ΣΥΝΤΗΡΗΤΗΣ 1</option>
    <option value="maintainer2">ΣΥΝΤΗΡΗΤΗΣ 2</option>
    <option value="maintainer3">ΣΥΝΤΗΡΗΤΗΣ 3</option>
    <option value="maintainer4">ΣΥΝΤΗΡΗΤΗΣ 4</option>
    </select>
    </td>
    </tr>
    <tr>
      <td>
      <label for="phone1">ΤΗΛΕΦΩΝΟ</label>
    </td>
    <td>
      <input type="text" id="phone1" name="phone1" value=<?php echo (isset($_SESSION['phone1'])?$_SESSION['phone1']:"");?>>
    </td>
    <td>
      <input type="text" id="phone2" name="phone2" value=<?php echo (isset($_SESSION['phone2'])?$_SESSION['phone2']:"");?>>
    </td>
    </tr>
    <tr>
      <td>
      <label for="emailreport">EMAIL REPORT</label>
    </td>
    <td>
      <input type="text" id="emailreport" name="emailreport" value=<?php echo (isset($_SESSION['emailreport'])?$_SESSION['emailreport']:"");?>>
    </td>
    <td>
      <input type="text" id="emailreport2" name="emailreport2" value=<?php echo (isset($_SESSION['emailreport2'])?$_SESSION['emailreport2']:"");?>>
    </td>
    </tr>

    <tr>
      <td colspan="3" style="text-align:center">
        <p>ΕΙΣΑΓΩΓΗ ΣΤΟΙΧΕΙΩΝ ΣΥΝΤΗΡΗΣΗΣ</p>
      </td>
    </tr>
  <tr>
    <td style="border: 0"></td>
    <td style="text-align:center">
      <p>ΧΩΡΟΣ</p>
    </td>
    <td style="border: 0"></td>
  </tr>
  <tr>
    <td>
      <label for="room">ΔΩΜΑΤΙΟ</label>
    </td>
    <td>
      <input type="text" id="room" name="room" value=<?php echo (isset($_SESSION['room'])?$_SESSION['room']:"");?>>
    </td>
  </tr>
  <tr>
    <td>
      <p>ΣΥΣΚΕΥΗ</p>
    </td>
    <td>
    <p>ΕΡΓΑΣΙΑ</p>
    </td>
    <td>
    <p>ΗΜΕΡΕΣ ΜΕΧΡΙ ΤΟΝ<br> ΕΠΟΜΕΝΟ ΕΛΕΓΧΟ</p>
    </td>

  </tr>
  <tr>
    <td>
      <input type="text" id="device" name="device" value=<?php echo (isset($_SESSION['device'])?$_SESSION['device']:"");?>>
    </td>
    <td>
      <input type="text" id="work" name="work" value=<?php echo (isset($_SESSION['work'])?$_SESSION['work']:"");?>>
    </td>
    <td>
      <input type="text" id="days" name="days" value=<?php echo (isset($_SESSION['days'])?$_SESSION['days']:"");?>>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="text-align: center; border: 0">
      <button type="submit">Υποβολή</button>
    </td>
  </tr>


</table>
</form>

<body>

  <?php
  unset($_SESSION['hotelname']);
  unset($_SESSION['address']);
  unset($_SESSION['phone1']);
  unset($_SESSION['phone2']);
  unset($_SESSION['emailreport']);
  unset($_SESSION['emailreport2']);
  unset($_SESSION['room']);
  unset($_SESSION['device']);
  unset($_SESSION['work']);
  unset($_SESSION['days']);
  ?>

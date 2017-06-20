<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
}
else{

if(isset($_GET['id']) && $_GET['id']!=0){
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
    $_SESSION['maintainer']=getUserById($work['MaintainerId'])["FirstName"].' '.getUserById($work['MaintainerId'])["LastName"];
    // echo $_SESSION['maintainer'];

  }
}
?>

<body>
  <?php if (isset($_GET['id']) && ($_GET['id'])!=null){?>
<form method="post" action="validateNew.php?id=<?php echo $_GET['id'];?>"><?php } else {?>
  <form method="post" action="validateNew.php"><?php } ?>
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
      <input type="text" id="hotelname" name="hotelname" value="<?php echo (isset($_SESSION['hotelname'])?$_SESSION['hotelname']:"");?>">
    </td>
    </tr>
    <tr>
      <td>
      <label for="address">ΔΙΕΥΘΥΝΣΗ</label>
    </td>
    <td>
      <input type="text" id="address" name="address" value="<?php echo (isset($_SESSION['address'])?$_SESSION['address']:"");?>">
    </td>
    </tr>
    <tr>
      <td>
      <label for="maintainer">ΣΥΝΤΗΡΗΤΗΣ</label>
    </td>
    <td colspan="2" style="border: 0">
      <select id="maintainer" name="maintainer">
        <?php $maintainers=getMaintainers();
        foreach ($maintainers as $row) {?>
          <option <?php
          if (isset($_SESSION['maintainer']) && $row['FirstName'].' '.$row['LastName']==$_SESSION['maintainer']){
             echo 'selected'; } ?>>
           <?php
          echo $row['FirstName'].' '.$row['LastName'];

          ?></option>
          <?php
          } ?>
        </select>
    </td>
    </tr>
    <tr>
      <td>
      <label for="phone1">ΤΗΛΕΦΩΝΟ</label>
    </td>
    <td>
      <input type="text" id="phone1" name="phone1" value="<?php echo (isset($_SESSION['phone1'])?$_SESSION['phone1']:"");?>">
    </td>
    <td>
      <input type="text" id="phone2" name="phone2" value="<?php echo (isset($_SESSION['phone2'])?$_SESSION['phone2']:"");?>">
    </td>
    </tr>
    <tr>
      <td>
      <label for="emailreport">EMAIL REPORT</label>
    </td>
    <td>
      <input type="text" id="emailreport" name="emailreport" value="<?php echo (isset($_SESSION['emailreport'])?$_SESSION['emailreport']:"");?>">
    </td>
    <td>
      <input type="text" id="emailreport2" name="emailreport2" value="<?php echo (isset($_SESSION['emailreport2'])?$_SESSION['emailreport2']:"");?>">
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
      <input type="text" id="room" name="room" value="<?php echo (isset($_SESSION['room'])?$_SESSION['room']:"");?>">
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
      <input type="text" id="device" name="device" value="<?php echo (isset($_SESSION['device'])?$_SESSION['device']:"");?>">
    </td>
    <td>
      <input type="text" id="work" name="work" value="<?php echo (isset($_SESSION['work'])?$_SESSION['work']:"");?>">
    </td>
    <td>
      <input type="text" id="days" name="days" value="<?php echo (isset($_SESSION['days'])?$_SESSION['days']:"");?>">
    </td>
  </tr>
  <tr>
    <td colspan="3" style="text-align: center; border: 0">
      <?php if(isset($_GET['id']) && $_GET['id']!=0){ ?>
      <button type="submit" name="updateworkbutton">Υποβολή</button>
      <?php } else { ?>
        <button type="submit" name="newworkbutton">Υποβολή</button>
      <?php } ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="text-align: center; border: 0">
      <?php if(isset($_GET['id']) && $_GET['id']!=0){?>
        <a href="worklist.php">Πίσω</a>
       <?php } else {?>
        <a href="mainmenu.php">Πίσω</a>
        <?php } ?>
    </td>
  </tr>
    <?php if(isset($_GET['id']) && $_GET['id']!=0){?>
      <tr>
        <td colspan="3" style="text-align: center; border: 0">
          <a class="deleteButton" href="deleteWork.php?id=<?php echo $work['Id'];?>">Διαγραφή</a>
        </td>
      </tr>
      <?php } ?>


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
  unset($_SESSION['maintainer']);
}

  include 'footer.php';
  ?>

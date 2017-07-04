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
    $_SESSION['hotelname']=getHotelById($work['HotelId'])['HotelName'];
    $_SESSION['room']=$work['Room'];
    $_SESSION['device']=$work['Device'];
    $_SESSION['work']=$work['Work'];
    $_SESSION['days']=$work['Days'];
  }
}

 if (isset($_GET['id']) && ($_GET['id'])!=null){?>
<form method="post" action="validateNew.php?id=<?php echo $_GET['id'];?>"><?php } else {?>
  <form method="post" action="validateNew.php"><?php } ?>
<table id="formtable" align="center" frame="void" border="2px solid black" cellspacing="10">
  <tr>
  <td colspan="3" style="text-align:center">
<p>
  ΕΙΣΑΓΩΓΗ ΣΤΟΙΧΕΙΩΝ ΕΡΓΑΣΙΑΣ
</p>
  </td>
</tr>
      <td>
      <label for="hotelname">ΞΕΝΟΔΟΧΕΙΟ</label>
    </td>
    <td colspan="2" style="border: 0">
      <select id="hotelname" name="hotelname">
        <?php $hotels=getHotels();
        foreach ($hotels as $row) {?>
          <option <?php
          if (isset($_SESSION['hotelname']) && $row['HotelName']==$_SESSION['hotelname']){
             echo 'selected'; } ?>>
           <?php
          echo $row['HotelName'];

          ?></option>
          <?php
          } ?>
        </select>
    </td>
    </tr>


    <tr>
      <td colspan="3" style="text-align:center">
        <p>ΕΙΣΑΓΩΓΗ ΣΤΟΙΧΕΙΩΝ ΣΥΝΤΗΡΗΣΗΣ</p>
      </td>
    </tr>

  <tr>
    <td>
      <label for="room">ΧΩΡΟΣ</label>
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
  <?php $numberofworks=isset($_GET['id']) && $_GET['id']!=0?1:10;
    $loop=1;
    while($loop<=$numberofworks){?>
  <tr>
    <td>
      <input type="text" id="device" name="device[]" value="<?php echo (isset($_SESSION['device'])?$_SESSION['device']:"");?>">
    </td>
    <td>
      <input type="text" id="work" name="work[]" value="<?php echo (isset($_SESSION['work'])?$_SESSION['work']:"");?>">
    </td>
    <td>
      <input type="text" id="days" name="days[]" value="<?php echo (isset($_SESSION['days'])?$_SESSION['days']:"");?>">
    </td>
  </tr>
  <?php
  $loop++;
  } ?>
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


  <?php
  unset($_SESSION['hotelname']);
  unset($_SESSION['room']);
  unset($_SESSION['device']);
  unset($_SESSION['work']);
  unset($_SESSION['days']);
}

  include 'footer.php';
  ?>

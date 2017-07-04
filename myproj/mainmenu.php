<?php
session_start();
include 'header.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {
  ?>



    <table id="menutable" align="center" style="text-align: center" cellspacing="10">
      <tr>
        <td>
          <a href="mainpage.php">Προσθήκη Εργασίας</a>
        </td>
      </tr>
      <tr>
        <td>
          <a href="worklist.php">Τροποποίηση Εργασίας</a>
        </td>
      </tr>
      <tr>
        <td>
          <a href="addHotel.php">Προσθήκη Ξενοδοχείου</a>
        </td>
      </tr>
      <tr>
        <td>
          <a href="hotellist.php">Τροποποίηση Ξενοδοχείου</a>
        </td>
      </tr>
      <tr>
        <td>
          <a href="addMaintainer.php">Προσθήκη Συντηρητή</a>
        </td>
      </tr>
      <tr>
        <td>
          <a href="maintainersList.php">Τροποποίηση Συντηρητή</a>
        </td>
      </tr>
      <tr>
        <td>
          <a href="logout.php">Έξοδος</a>
        </td>
      </tr>

    </table>
</body>

<?php
  unset($_SESSION['failedfn']);
  unset($_SESSION['failedln']);
  unset($_SESSION['failedun']);
  unset($_SESSION['failedpw']);
  unset($_SESSION['failedrpw']);
  unset($_SESSION['hotelname']);
  unset($_SESSION['emailreport']);
  unset($_SESSION['emailreport2']);
  unset($_SESSION['room']);
  unset($_SESSION['device']);
  unset($_SESSION['work']);
  unset($_SESSION['days']);
  unset($_SESSION['maintainer']);
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

}
include 'footer.php';
?>

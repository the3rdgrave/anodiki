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

}
include 'footer.php';
?>

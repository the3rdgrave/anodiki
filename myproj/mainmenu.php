<?php
session_start();
include 'header.php'; ?>


  <body>
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
          <a href="addMaintainer.php">Προσθήκη Συντηρητή</a>
        </td>
      </tr>
      <tr>
        <td>
          <a href="worklist.php">Τροποποίηση Συντηρητή</a>
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
?>

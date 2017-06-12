<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

$works=getWorks();
foreach ($works as $row){
  $workdate=date_parse($row['Date'])['day'].'/'.date_parse($row['Date'])['month'].'/'.date_parse($row['Date'])['year'];
  if(date("j/n/Y")==date('j/n/Y', strtotime($row['Date']."+".$row['Days']." days"))){
    resetWorkDate($row['Id']);
  }
  if(date("j/n/Y")==date('j/n/Y', strtotime($row['Date']."+1 days"))){
    if($row['Confirmation']==0 && checkPending($row['Id'],$row['Date'])==null){
      addPendingWork($row['Id'],$row['Date']);
    }
    updateWorkConfirmation($row['Id']);
  }

}


if(isset($_SESSION['role']) && $_SESSION['role']==1){
    header('Location: mainmenu.php');
} else if (isset($_SESSION['role']) && $_SESSION['role']==2){
    header('Location: maintainer.php');
}
else {
 ?>
<body>



  <form method="post" action="verifyLogin.php">
  <table id="logintable" align="center">
    <tr>
      <td><label for="username">ΟΝΟΜΑ ΧΡΗΣΤΗ</label>
      </td>
      <td>
        <input type="text" id="username" name="username">
      </td>
    </tr>
    <tr>
      <td><label for="password">ΚΩΔΙΚΟΣ</label>
      </td>
      <td>
        <input type="text" id="password" name="password">
      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: center">
        <button name="loginbutton">Είσοδος</button>
      </td>
    </tr>
  </table>
</form>
</body>
<?php } ?>
</html>

<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';


$works=getWorks();
foreach ($works as $row) {

  // echo $row['Id'].' '.strtotime("now").' '.strtotime(date('Y/n/j', strtotime("now"))).' '.strtotime(date('Y/n/j', strtotime($row['Date']))).' '.strtotime($row['Date']).'<br>';


  // if(date("j/n/Y")==date('j/n/Y', strtotime($row['Date']."+".$row['Days']." days"))){
if(strtotime(date('Y/n/j', strtotime("now")))>=strtotime(date('Y/n/j', strtotime($row['Date'])))){

$a=1;
  while(true){
    // echo $a;
  // while (strtotime(date('Y/n/j', strtotime("now")))>=strtotime(date('Y/n/j', strtotime($row['Date'])))+intval($a*$row['Days']*86400)){
   if(strtotime(date('Y/n/j', strtotime("now")))==strtotime(date('Y/n/j', strtotime($row['Date']))) + intval($a*$row['Days']*86400)){
    resetWorkDate($row['Id'], date('Y/m/d'));
    updateWorkConfirmation($row['Id']);
    break;

  }
  if(strtotime(date('Y/n/j', strtotime("now")))<strtotime(date('Y/n/j', strtotime($row['Date']))) + intval($a*$row['Days']*86400)){
    if ($a>1){
      updateWorkConfirmation($row['Id']);
      resetWorkDate($row['Id'], date('Y/m/d', strtotime($row['Date']."+".intval(($a-1)*$row['Days'])." days")));
 }
   break;



 }
  $a++;

}

  if(strtotime(date('Y/n/j', strtotime("now")))!=strtotime(date('Y/n/j',strtotime($row['Date'])))) {
    // updateWorkConfirmation($row['Id']);
    if($row['Confirmation']==0 && checkPending($row['Id'])==null) {
      addPendingWork($row['Id'],$row['HotelId'], $row['Date']);
    }
  }
  else {
    deletePendingWork($row['Id']);
  }

}
}


if(isset($_SESSION['role']) && $_SESSION['role']==1){
    header('Location: mainmenu.php');
} else if (isset($_SESSION['role']) && $_SESSION['role']==2){
    header('Location: maintainer.php');
}
else {
 ?>



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


<?php }
include 'footer.php';
?>

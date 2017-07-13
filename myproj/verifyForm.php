<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=2){
  header('Location: index.php');
} else {
if(isset($_POST['submitreport'])){


    // if(!empty($_POST['notes'])){
  //
  // foreach($_POST['notes'] as $row1){
  //   $work1=getWorkById(array_search($row1, $_POST['notes']));
  //   updateWork($work1['Id'], $work1['HotelId'], $work1['Room'], $work1['Device'], $work1['Work'], $work1['Days'],
  //   $work1['Date'], $work1['Confirmation'], $row1);
  //   }
  // }
  $duration=time()-$_SESSION['logintime'];
  $hours=intval($duration/3600);
  $durationleft=$duration-$hours*3600;
  $mins=intval($durationleft/60);
  $secs=$durationleft-$mins*60;

	$table="";

  // if(!empty($_POST['confirmed'])){
  ?>
    <table id="reporttable" style="width: 80%" frame="void" border="2px solid black" align="center">
      <tr>
        <td colspan="2">
          <p><?php echo $_POST['maintainerselect'];
			  $table.=$_POST['maintainerselect'].' '; ?></p>
        </td>
        <td>
          <p><?php echo $_SESSION['hotname'];
			  $table.=$_SESSION['hotname'].' '; ?></p>
        </td>
        <td>
          <?php echo date("j/n/Y");
			$table.=date("j/n/Y").' ';?>
        </td>
        <td>
          <p><?php echo $hours.' hours '.$mins.' mins '.$secs.' secs';
			  $table.=$hours." hours ".$mins.' mins '.$secs." secs\n"?></p>
        </td>
      </tr>
          <tr>
            <th>
              <p>ΣΥΣΚΕΥΗ</p>
            </th>
            <th>
              <p>ΕΡΓΑΣΙΑ</p>
            </th>
            <th>
              <p>ΔΩΜΑΤΙΟ</p>
            </th>
            <th>
              <p>ΕΠΙΒΕΒΑΙΩΣΗ</p>
            </th>
            <th style="width:50% ; word-wrap: break-all">
              <p>ΣΗΜΕΙΩΣΕΙΣ</p>
            </th>

      <?php
      if(!empty($_POST['notes'])){
      foreach(array_keys($_POST['notes']) as $row){
    // echo array_search($row, $_POST['notes']);
    $work=getWorkById($row);
    updateWork($work['Id'], $work['HotelId'], $work['Room'], $work['Device'], $work['Work'], $work['Days'],
    $work['Date'], !empty($_POST['confirmed']) && in_array($work['Id'],$_POST['confirmed'])?1:0, $_POST['notes'][$work['Id']]);
    if(!empty($_POST['confirmed']) && in_array($work['Id'],$_POST['confirmed']) && checkPendingByWorkId($work['Id'])==true){
      deletePendingWork($work['Id']);
    }
    $work=getWorkById($row);?>
    <tr>
      <td>
        <p><?php echo $work['Device'];
			$table.=$work['Device'].' ';?></p>
      </td>
      <td>
        <p><?php echo $work['Work'];
			$table.=$work['Work'].' ';?></p>
      </td>
      <td>
        <p><?php echo $work['Room'];
			$table.=$work['Room'].' ';?></p>
      </td>
      <td>
        <p><?php echo getConfirmationById($work['Confirmation'])['Confirmation'];
			$table.=getConfirmationById($work['Confirmation'])['Confirmation'].' ';?></p>
      </td>
      <td>
        <p><?php echo $work['Notes'];
			$table.=$work['Notes']."\n"?></p>
      </td>
    </tr>

  <?php
  } }
  ?>
  <tr>
    <td colspan="5" style="text-align: center; border: 0">
       <a href="hotel.php">Επιστροφή στις εργασίες</a>
     </td>
   </tr>
  </table> <?php
  // }

  $table;

  file_put_contents("test.txt",$table);

  $file = 'test.txt';
$filename='test.txt';

 $mailto = 'aposdida@yahoo.gr';
 $subject = $_SESSION['hotname'].', '.date('j/n/Y');
 $message = 'Αναφορά για ξενοδοχείο '.$_SESSION['hotname'].', '.date('j/n/Y');

 $content = file_get_contents($file);
 $content = chunk_split(base64_encode($content));

 // a random hash will be necessary to send mixed content
 $separator = md5(time());

 // carriage return type (RFC)
 $eol = "\r\n";

 // main header (multipart mandatory)
 $headers = "From: name <test@test.com>" . $eol;
 $headers .= "MIME-Version: 1.0" . $eol;
 $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
 $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
 $headers .= "This is a MIME encoded message." . $eol;

 // message
 $body = "--" . $separator . $eol;
 $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
 $body .= "Content-Transfer-Encoding: 8bit" . $eol;
 $body .= $message . $eol;

 // attachment
 $body .= "--" . $separator . $eol;
 $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
 $body .= "Content-Transfer-Encoding: base64" . $eol;
 $body .= "Content-Disposition: attachment" . $eol;
 $body .= $content . $eol;
 $body .= "--" . $separator . "--";

 //SEND Mail
 if (mail($mailto, $subject, $body, $headers)) {
     echo "mail send ... OK"; // or use booleans here
 } else {
     echo "mail send ... ERROR!";
     print_r( error_get_last() );
 }
}
}
include 'footer.php';
?>

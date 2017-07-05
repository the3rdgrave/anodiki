<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if($_SESSION['role']!=1){
  header('Location: index.php');
} else {
  if(isset($_GET['id'])){
    $work=getWorkById($_GET['id']);
    $room=$work['Room'];
    $hotelid=$work['HotelId'];
  } else {
    $room=$_GET['room'];
    $hotelid=$_GET['hotelid'];
  }
  $works=getWorksByRoom($room,$hotelid);
  $ok=1;
  $allrooms=getAllRooms();
  foreach ($allrooms as $row) {
    if ($_SESSION['cloneroom']==$row['Room'] && getHotelId($_SESSION['clonehn'])['Id']==$row['HotelId']){
      $ok=0;
    }
  }

  if($room=="" || $hotelid==null || $_SESSION['cloneroom']==""){
    $ok=0;
  }

  if($ok==0){
    echo 'Υπάρχουν ήδη εργασίες για το δωμάτιο '.$_SESSION['cloneroom'].'/'.$_SESSION['clonehn'].'<br>';
  } else {

  for ($i=0; $i<sizeof($works); ++$i){
    // echo $works[$i]['Work'].' '.$works[$i]['Device'].'<br>';
  echo addWork(getHotelId($_SESSION['clonehn'])['Id'], $_SESSION['cloneroom'], $works[$i]['Device'],$works[$i]['Work'], $works[$i]['Days'],
  getHotelId($_SESSION['clonehn'])['StartingDate']).' : '.$works[$i]['Device'].'/'.$works[$i]['Work'].'<br>';
    }
  } ?>
  <a href="mainmenu.php">Επιστροφή</a>

  <?php

}
include 'footer.php';
?>

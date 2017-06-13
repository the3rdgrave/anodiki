<?php
session_start();
include 'header.php';
include 'db/dbfunctions.php';

if(isset($_POST['submitreport'])){
  if(!empty($_POST['confirmed'])){
  foreach($_POST['confirmed'] as $row){
    echo $row.':'.getWorkById($row)['Work'].'<br>';
    // $workdate=date_parse(getWorkById($row)['Date'])['day'].'/'.date_parse(getWorkById($row)['Date'])['month'].'/'.date_parse(getWorkById($row)['Date'])['year'];
    // echo $workdate.'<br>';
    // echo $currentdate=date("j/n/Y");
    $work=getWorkById($row);
    updateWork($work['Id'], $work['Hotel'], $work['Address'], $work['MaintainerId'], $work['Phone1'], $work['Phone2'], $work['EmailReport1'], $work['EmailReport2'], $work['Room'], $work['Device'], $work['Work'], $work['Days'],
    date("Y-m-d",time()), 1, $work['Notes']);
    if(checkPendingByWorkId($work['Id'])==true){
      deletePendingWork($work['Id']);
    }
  }
  }

  if(!empty($_POST['notes'])){

  foreach($_POST['notes'] as $row1){
    $work1=getWorkById(array_search($row1, $_POST['notes']));
    // echo array_search($row1, $_POST['notes']).':'.$row1.'<br>';
    updateWork($work1['Id'], $work1['Hotel'], $work1['Address'], $work1['MaintainerId'], $work1['Phone1'], $work1['Phone2'], $work1['EmailReport1'], $work1['EmailReport2'], $work1['Room'], $work1['Device'], $work1['Work'], $work1['Days'],
    $work1['Date'], $work1['Confirmation'], $row1);
    }
  }
}


?>
<a href="maintainer.php">Επιστροφή στις εργασίες</a>

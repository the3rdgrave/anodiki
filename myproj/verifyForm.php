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
    date("Y-m-d",time()), 1);
  }
  }
}
?>

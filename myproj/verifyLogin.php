<?php session_start();
include 'header.php';
include 'db/dbfunctions.php';
?>



<body>
  <?php



  $login=loginUser($_POST['username'], $_POST['password']);

  if ($login==true) {
    $user=getUserByUsername($_POST['username']);
    $_SESSION['userid']=$user['Id'];
    $_SESSION['username']=$user['Username'];
    $_SESSION['password']=$user['Password'];
    $_SESSION['role']=$user['Role'];

    if($_SESSION['role']==1){
    header('Location: mainmenu.php');
    } else if ($_SESSION['role']==2){
      header('Location: hotel.php');
    }
  }
  else{
    echo 'Invalid username or password';
    ?> <br><a href="index.php">Επιστροφή</a> <?php
  }

  include 'footer.php';
  ?>

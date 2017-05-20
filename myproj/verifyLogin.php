<?php session_start(); ?>

<head>
  <link href="style/style.css" rel="stylesheet">
</head>

<body>
  <?php
   include 'db/dbfunctions.php';


  $login=loginUser($_POST['username'], $_POST['password']);

  if ($login==true) {
    echo 'Hello '.$_POST['username'];
  }
  else{
    echo 'Invalid username or password';
  }
  ?>
</body>

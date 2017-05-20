<?php
// include "config.php";

// try{
//     $db=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT,DB_USER,DB_PASS);
//     $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//     $db->exec("SET NAMES 'utf8'");
//     // echo "Connected<br/>";
//
//
// }
//
// catch (Exception $e) {
//     echo "Could not connect to the database.";
//     exit;
// }

$servername = "localhost";
$user = "root";
$pass = "";

try {
    $db = new PDO("mysql:host=$servername;dbname=anodiki", $user, $pass);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


?>

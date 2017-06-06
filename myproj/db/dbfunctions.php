<?php include "db.php";


function loginUser ($username, $password){
    global $db;
    $results=$db->prepare("SELECT * FROM Users WHERE Username = ? AND Password = ?");
    $results->bindValue(1, $username);
    $results->bindValue(2, $password);
    $results->execute();
    $user=$results->fetch(PDO::FETCH_ASSOC);

    if($user==false) {
        return false;
    }
    else {
        $_SESSION['username']=$username;
        $_SESSION['password']=$password;


        return true;
    }

}

function addWork($hotel, $address, $maintainer, $phone1, $phone2, $report1, $report2, $room, $device, $work, $days){
    global $db;



    try {
        $results = $db->prepare("insert into Works (Hotel, Address, MaintainerId, Phone1, Phone2, EmailReport1, EmailReport2, Room, Device, Work, Days) values(?,?,?,?,?,?,?,?,?,?,?)");


        $results->bindValue(1, $hotel);
        $results->bindValue(2, $address);
        $results->bindValue(3, $maintainer);
        $results->bindValue(4, $phone1);
        $results->bindValue(5, $phone2);
        $results->bindValue(6, $report1);
        $results->bindValue(7, $report2);
        $results->bindValue(8, $room);
        $results->bindValue(9, $device);
        $results->bindValue(10, $work);
        $results->bindValue(11, $days);


        $results->execute();
        $userid = $db->lastInsertId();


        return "Work added";


    }
    catch(Exception $e) {
        return "Error adding work".$e;
    }

}

function getWorks(){
    global $db;
    $results=$db->prepare("Select * from works");
    $results->execute();

    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
  }

  function getWorkById($workid){
    global $db;

    $results=$db->prepare("Select * from Works WHERE Id=?");
    $results->bindValue(1, $workid);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function getUserByUsername($username){
    global $db;

    $results=$db->prepare("Select * from Users WHERE Username=?");
    $results->bindValue(1, $username);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function getUserById($userid){
    global $db;

    $results=$db->prepare("Select * from Users WHERE Id=?");
    $results->bindValue(1, $userid);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function getWorksByMaintainer($maintainerid, $hotel){
  global $db;

  $results=$db->prepare("Select * from Works WHERE MaintainerId=? AND Hotel=?");
  $results->bindValue(1, $maintainerid);
  $results->bindValue(2, $hotel);
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}

function getHotelsByMaintainer($maintainerid){
  global $db;

  $results=$db->prepare("Select DISTINCT Hotel,Address from Works WHERE MaintainerId=?");
  $results->bindValue(1, $maintainerid);
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}

function getMaintainers(){
    global $db;

    $results=$db->prepare("Select * from Users WHERE Role=2");
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;

}

function getConfirmationById($confid){
    global $db;

    $results=$db->prepare("Select * from Confirmation WHERE Id=?");
    $results->bindValue(1, $confid);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function updateWork($workid, $hotel, $address, $maintainer, $phone1, $phone2, $report1, $report2, $room, $device, $work, $days){
    global $db;

    try {
        $results = $db->prepare("Update Works Set Hotel=?, Address=?, MaintainerId=?, Phone1=?, Phone2=?, EmailReport1=?, EmailReport2=?, Room=?, Device=?, Work=?, Days=? WHERE Id=?");


        $results->bindValue(1, $hotel);
        $results->bindValue(2, $address);
        $results->bindValue(3, $maintainer);
        $results->bindValue(4, $phone1);
        $results->bindValue(5, $phone2);
        $results->bindValue(6, $report1);
        $results->bindValue(7, $report2);
        $results->bindValue(8, $room);
        $results->bindValue(9, $device);
        $results->bindValue(10, $work);
        $results->bindValue(11, $days);
        $results->bindValue(12, $workid);



        $results->execute();
        return "Work updated";


    } catch (Exception $e) {
        return "Error updating work" . $e;
    }


}


?>
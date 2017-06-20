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


        return "Work added";


    }
    catch(Exception $e) {
        return "Error adding work".$e;
    }

}

function addPendingWork($workid, $maintainerid, $workdate){
    global $db;



    try {
        $results = $db->prepare("insert into pending (WorkId, MaintainerId, DueDate) values(?,?,?)");


        $results->bindValue(1, $workid);
        $results->bindValue(2, $maintainerid);
        $results->bindValue(3, $workdate);


        $results->execute();

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

function getWorksByMaintainerByHotel($maintainerid, $hotel){
  global $db;

  $results=$db->prepare("Select * from Works WHERE MaintainerId=? AND Hotel=? AND Confirmation=0 AND DATE(Date)=CURDATE()");
  $results->bindValue(1, $maintainerid);
  $results->bindValue(2, $hotel);
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}

function getPendingWorksByMaintainer($maintainerid){
  global $db;

  $results=$db->prepare("Select * from pending WHERE MaintainerId=?");
  $results->bindValue(1, $maintainerid);
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}


function getHotelsByMaintainer($maintainerid){
  global $db;

  $results=$db->prepare("Select DISTINCT Hotel,Address from Works WHERE MaintainerId=? AND Confirmation=0 AND DATE(Date)=CURDATE()");
  $results->bindValue(1, $maintainerid);
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}

function getRoomsByHotelByMaintainer($maintainerid, $hotel, $address){
  global $db;

  $results=$db->prepare("Select * from Works WHERE MaintainerId=? AND Confirmation=0 AND DATE(Date)=CURDATE() AND  CONCAT_WS(' ',Hotel, Address)=?");
  $results->bindValue(1, $maintainerid);
  $results->bindValue(2, $hotel.' '.$address);
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

function getMaintainerId($fullname){
    global $db;

    $results=$db->prepare("Select * from users WHERE CONCAT_WS(' ',FirstName,LastName)=?");
    $results->bindValue(1, $fullname);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function updateWork($workid, $hotel, $address, $maintainer, $phone1, $phone2, $report1, $report2, $room, $device, $work, $days, $date, $confirmation, $notes){
    global $db;

    try {
        $results = $db->prepare("Update Works Set Hotel=?, Address=?, MaintainerId=?, Phone1=?, Phone2=?, EmailReport1=?, EmailReport2=?, Room=?, Device=?, Work=?, Days=?, Date=?, Confirmation=?, Notes=? WHERE Id=?");


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
        $results->bindValue(12, $date);
        $results->bindValue(13, $confirmation);
        $results->bindValue(14, $notes);
        $results->bindValue(15, $workid);



        $results->execute();
        return "Work updated";


    } catch (Exception $e) {
        return "Error updating work" . $e;
    }


}

function resetWorkDate($workid){
    global $db;

    try {
        $results = $db->prepare("Update Works Set Date=now() WHERE Id=?");
        $results->bindValue(1, $workid);
        $results->execute();
        return "Work updated";


    } catch (Exception $e) {
        return "Error updating work" . $e;
    }


}

function updateWorkConfirmation($workid){
    global $db;

    try {
        $results = $db->prepare("Update Works Set Confirmation=0 WHERE Id=?");
        $results->bindValue(1, $workid);
        $results->execute();
        return "Work updated";


    } catch (Exception $e) {
        return "Error updating work" . $e;
    }


}

function addMaintainer($username, $password1, $password2, $firstname, $lastname){
    global $db;
    $fullname=$firstname.' '.$lastname;
    $errormessage="";
    if(checkUser($username, $fullname)==false){
        $errormessage .="There is already a maintainer with this username or full name".'<br>';
    }

    if(strlen($username)<3 || strlen($username)>12){
        $errormessage .="Username must be between 5 and 12 characters".'<br>';
    }


    if($password1!=$password2){
        $errormessage .="Passwords don't match".'<br>';

    }
    else if(strlen($password1)<3 || strlen($password1)>15) {
        $errormessage .="Password must be between 3 and 15 characters".'<br>';
    }

    if($errormessage=="")
    {


    try {
        $results = $db->prepare("insert into Users (Username, Password, FirstName, LastName, Role) values(?,?,?,?,?)");


        $results->bindValue(1, $username);
        $results->bindValue(2, $password1);
        $results->bindValue(3, $firstname);
        $results->bindValue(4, $lastname);
        $results->bindValue(5, 2);



        $results->execute();

        return "User added";



    }
    catch(Exception $e) {
        return "Error creating user".$e;
    }

    }

    else {
        return $errormessage;
    }


}

function updateMaintainer($maintainerid, $username, $password1, $password2, $firstname, $lastname){
    global $db;
    $fullname=$firstname.' '.$lastname;
    $errormessage="";
    if(checkUserOnUpdate($username, $fullname, $maintainerid)==false){
        $errormessage .="There is already a maintainer with this username or full name".'<br>';
    }

    if(strlen($username)<3 || strlen($username)>12){
        $errormessage .="Username must be between 5 and 12 characters".'<br>';
    }


    if($password1!=$password2){
        $errormessage .="Passwords don't match".'<br>';

    }
    else if(strlen($password1)<3 || strlen($password1)>15) {
        $errormessage .="Password must be between 3 and 15 characters".'<br>';
    }

    if($errormessage=="")
    {


    try {
        $results = $db->prepare("Update users Set Username=?, Password=?, FirstName=?, LastName=?, Role=? WHERE Id=? ");


        $results->bindValue(1, $username);
        $results->bindValue(2, $password1);
        $results->bindValue(3, $firstname);
        $results->bindValue(4, $lastname);
        $results->bindValue(5, 2);
        $results->bindValue(6, $maintainerid);



        $results->execute();

        return "User updated";



    }
    catch(Exception $e) {
        return "Error updating user".$e;
    }

    }

    else {
        return $errormessage;
    }


}

function checkUser($username, $fullname){
  global $db;
  $results=$db->prepare("Select * from users");
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
  foreach ($resultsArray as $row){
      if ($row["Username"]==$username){
          return false;
      }
      if ($row["FirstName"].' '.$row['LastName']==$fullname){
          return false;
      }

  }

  return true;

}

function checkPending($workid, $workdate){
  global $db;
  $results=$db->prepare("Select * from pending WHERE WorkId=? AND DueDate=?");
  $results->bindValue(1, $workid);
  $results->bindValue(2, $workdate);
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);


  return $resultsArray;

}

function checkPendingByWorkId($workid){
  global $db;
  $results=$db->prepare("Select * from pending WHERE WorkId=?");
  $results->bindValue(1, $workid);
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
  return $resultsArray;

}

function checkUserOnUpdate($username, $fullname, $maintainerid){
  global $db;
  $results=$db->prepare("Select * from users WHERE Id<>?");
  $results->bindValue(1, $maintainerid);
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
  foreach ($resultsArray as $row){
      if ($row["Username"]==$username){
          return false;
      }
      if ($row["FirstName"].' '.$row['LastName']==$fullname){
          return false;
      }

  }

  return true;

}

function deleteUser($userid){
    global $db;

    try {

        $results = $db->prepare("Delete from Users WHERE Id=? ");
        $results->bindValue(1, $userid);
        $results->execute();

        return "The user was deleted";

    }
    catch(Exception $e) {
        return "Error deleting user".$e;
    }
}

function deletePendingWork($workid){
    global $db;

    try {

        $results = $db->prepare("Delete from pending WHERE WorkId=? ");
        $results->bindValue(1, $workid);
        $results->execute();

        return "Works deleted";

    }
    catch(Exception $e) {
        return "Error deleting works".$e;
    }
}

function deleteWorksByMaintainer($maintainerid){
    global $db;

    try {

        $results = $db->prepare("Delete from Works WHERE MaintainerId=? ");
        $results->bindValue(1, $maintainerid);
        $results->execute();

        return "The works are deleted";

    }
    catch(Exception $e) {
        return "Error deleting works".$e;
    }
}

function deleteWork($workid){
    global $db;

    try {

        $results = $db->prepare("Delete from works WHERE Id=? ");
        $results->bindValue(1, $workid);
        $results->execute();

        return "The work is deleted";

    }
    catch(Exception $e) {
        return "Error deleting work".$e;
    }
}





?>

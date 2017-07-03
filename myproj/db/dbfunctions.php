<?php include "db.php";


function loginUser ($username, $password){
    global $db;
    $results=$db->prepare("SELECT * FROM hotels WHERE Username = ? AND Password = ?");
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

function addWork($hotel, $report1, $report2, $room, $device, $work, $days){
    global $db;



    try {
        $results = $db->prepare("insert into works (HotelId, EmailReport1, EmailReport2, Room, Device, Work, Days) values(?,?,?,?,?,?,?)");


        $results->bindValue(1, $hotel);
        $results->bindValue(2, $report1);
        $results->bindValue(3, $report2);
        $results->bindValue(4, $room);
        $results->bindValue(5, $device);
        $results->bindValue(6, $work);
        $results->bindValue(7, $days);


        $results->execute();


        return "Work added";


    }
    catch(Exception $e) {
        return "Error adding work".$e;
    }

}

function addHotel($hotelname, $address, $maintainer1, $maintainer2, $maintainer3, $phone1, $phone2, $username, $password1, $password2){
    global $db;
    $errormessage="";
    if(strlen($username)<3 || strlen($username)>12){
        $errormessage .="Username must be between 5 and 12 characters".'<br>';
    }


    if($password1!=$password2){
        $errormessage .="Passwords don't match".'<br>';

    }
    else if(strlen($password1)<3 || strlen($password1)>15) {
        $errormessage .="Password must be between 3 and 15 characters".'<br>';
    }


    if (checkHotel($hotelname, $address, $phone1, $phone2, $maintainer1, $maintainer2, $maintainer3)==false){
      $errormessage .="Invalid entries".'<br>';
    }

    if(checkUser($username)==false){
      $errormessage .="Username already exists".'<br>';
    }

    if ($errormessage==""){

      try {
          $results = $db->prepare("insert into hotels (HotelName, Address, Maintainer1, Maintainer2, Maintainer3, Phone1, Phone2, Username, Password) values(?,?,?,?,?,?,?,?,?)");


          $results->bindValue(1, $hotelname);
          $results->bindValue(2, $address);
          $results->bindValue(3, $maintainer1);
          $results->bindValue(4, $maintainer2);
          $results->bindValue(5, $maintainer3);
          $results->bindValue(6, $phone1);
          $results->bindValue(7, $phone2);
          $results->bindValue(8, $username);
          $results->bindValue(9, $password1);


          $results->execute();


      return "Hotel added";

      }
      catch(Exception $e) {
          return "Error adding hotel. ".$e;
      }
  }
  else {
    return $errormessage;
  }

}

function updateHotel($hotelid, $hotelname, $address, $maintainer1, $maintainer2, $maintainer3, $phone1, $phone2, $username, $password1, $password2){
    global $db;
    $errormessage="";
    if (checkHotelOnUpdate($hotelid, $hotelname, $address, $phone1, $phone2, $maintainer1, $maintainer2, $maintainer3)==false){
      $errormessage .="Invalid entries".'<br>';
    }
    if(checkUserOnUpdate($username, $hotelid)==false){
        $errormessage .="Username already exists".'<br>';
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


    if ($errormessage==""){


    try {
        $results = $db->prepare("update hotels SET HotelName=?, Address=?, Maintainer1=?, Maintainer2=?, Maintainer3=?, Phone1=?, Phone2=?, Username=?, Password=? WHERE Id=?");


        $results->bindValue(1, $hotelname);
        $results->bindValue(2, $address);
        $results->bindValue(3, $maintainer1);
        $results->bindValue(4, $maintainer2);
        $results->bindValue(5, $maintainer3);
        $results->bindValue(6, $phone1);
        $results->bindValue(7, $phone2);
        $results->bindValue(8, $username);
        $results->bindValue(9, $password1);
        $results->bindValue(10, $hotelid);


        $results->execute();

        return "Hotel updated";

    }
    catch(Exception $e) {
        return "Error updating hotel. ".$e;
    }
  }
  else {
    return $errormessage;
  }

}

function addPendingWork($workid, $hotelid, $workdate){
    global $db;



    try {
        $results = $db->prepare("insert into pending (WorkId, HotelId, DueDate) values(?,?,?)");


        $results->bindValue(1, $workid);
        $results->bindValue(2, $hotelid);
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
    $results=$db->prepare("SELECT * from works");
    $results->execute();

    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}

function getHotels(){
    global $db;
    $results=$db->prepare("Select * from hotels WHERE Role=2");
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


function getMaintainerById($maintainerid){
    global $db;

    $results=$db->prepare("Select * from maintainers WHERE Id=?");
    $results->bindValue(1, $maintainerid);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function getHotelById($hotelid){
    global $db;

    $results=$db->prepare("Select * from hotels WHERE Id=?");
    $results->bindValue(1, $hotelid);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function getUserByUsername($userid){
    global $db;

    $results=$db->prepare("Select * from hotels WHERE Username=?");
    $results->bindValue(1, $userid);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function getWorksByHotel($hotelid){
  global $db;

  $results=$db->prepare("Select * from Works WHERE HotelId=? AND Confirmation=0 AND DATE(Date)=CURDATE()");
  $results->bindValue(1, $hotelid);
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}

function getPendingWorksByHotel($hotelid){
  global $db;

  $results=$db->prepare("Select * from pending WHERE HotelId=?");
  $results->bindValue(1, $hotelid);
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

function getRoomsByHotel($hotelid){
  global $db;

  $results=$db->prepare("Select DISTINCT Room from works WHERE HotelId=? AND Confirmation=0 AND DATE(Date)=CURDATE()");
  $results->bindValue(1, $hotelid);
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}

function getMaintainers(){
    global $db;

    $results=$db->prepare("Select * from maintainers");
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;

}

function getConfirmationById($confid){
    global $db;

    $results=$db->prepare("Select * from confirmation WHERE Id=?");
    $results->bindValue(1, $confid);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function getMaintainerId($fullname){
    global $db;

    $results=$db->prepare("Select * from maintainers WHERE CONCAT_WS(' ',FirstName,LastName)=?");
    $results->bindValue(1, $fullname);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function getHotelId($hotelname){
    global $db;

    $results=$db->prepare("Select * from hotels WHERE HotelName=?");
    $results->bindValue(1, $hotelname);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function updateWork($workid, $hotel, $report1, $report2, $room, $device, $work, $days, $date, $confirmation, $notes){
    global $db;

    try {
        $results = $db->prepare("Update Works Set HotelId=?, EmailReport1=?, EmailReport2=?, Room=?, Device=?, Work=?, Days=?, Date=?, Confirmation=?, Notes=? WHERE Id=?");


        $results->bindValue(1, $hotel);
        $results->bindValue(2, $report1);
        $results->bindValue(3, $report2);
        $results->bindValue(4, $room);
        $results->bindValue(5, $device);
        $results->bindValue(6, $work);
        $results->bindValue(7, $days);
        $results->bindValue(8, $date);
        $results->bindValue(9, $confirmation);
        $results->bindValue(10, $notes);
        $results->bindValue(11, $workid);



        $results->execute();
        return "Work updated";


    } catch (Exception $e) {
        return "Error updating work" . $e;
    }


}

function resetWorkDate($workid, $date){
    global $db;

    try {
        $results = $db->prepare("Update works Set Date=? WHERE Id=?");
        $results->bindValue(1, $date);
        $results->bindValue(2, $workid);
        $results->execute();
        return "Work updated";


    } catch (Exception $e) {
        return "Error updating work" . $e;
    }


}

function updateLoginTime($userid){
    global $db;

    try {
        $results = $db->prepare("Update hotels Set LoginTime=now() WHERE Id=?");
        $results->bindValue(1, $userid);
        $results->execute();
        return "Time updated";


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

function addMaintainer($firstname, $lastname){
    global $db;
    $fullname=$firstname.' '.$lastname;
    $errormessage="";
    if(checkMaintainer($fullname)==false){
        $errormessage .="There is already a maintainer with this name".'<br>';
    }

    if($errormessage=="")
    {


    try {
        $results = $db->prepare("insert into maintainers (FirstName, LastName) values(?,?)");


        $results->bindValue(1, $firstname);
        $results->bindValue(2, $lastname);

        $results->execute();
        return "Maintainer added";



    }
    catch(Exception $e) {
        return "Error creating maintainer. ".$e;
    }

    }

    else {
        return $errormessage;
    }

}


function updateMaintainer($maintainerid, $firstname, $lastname){
    global $db;
    $fullname=$firstname.' '.$lastname;
    $errormessage="";
    if(checkMaintainerOnUpdate($fullname, $maintainerid)==false){
        $errormessage .="There is already a maintainer with this name".'<br>';
    }


    if($errormessage=="")
    {


    try {
        $results = $db->prepare("Update maintainers Set FirstName=?, LastName=? WHERE Id=? ");

        $results->bindValue(1, $firstname);
        $results->bindValue(2, $lastname);
        $results->bindValue(3, $maintainerid);



        $results->execute();

        return "Maintainer updated";



    }
    catch(Exception $e) {
        return "Error updating maintainer. ".$e;
    }

    }

    else {
        return $errormessage;
    }


}


function checkUser($username){
  global $db;
  $results=$db->prepare("Select * from hotels");
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
  foreach ($resultsArray as $row){
      if ($row["Username"]==$username){
          return false;
      }

  }

  return true;

}

function checkMaintainer($fullname){
  global $db;
  $results=$db->prepare("Select * from maintainers");
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
  foreach ($resultsArray as $row){
      if ($fullname==$row["FirstName"].' '.$row["LastName"]){
          return false;
      }

  }

  return true;

}

function checkHotel($hotelname, $address, $phone1, $phone2, $maintainer1, $maintainer2, $maintainer3){
  global $db;
  $results=$db->prepare("Select * from hotels");
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  if ($maintainer1!=null){
    if ($maintainer1==$maintainer2 || $maintainer1==$maintainer3){
      return false;
    }
  }

  if ($maintainer2!=null){
    if ($maintainer2==$maintainer1 || $maintainer2==$maintainer3){
      return false;
    }
  }

  if ($maintainer3!=null){
    if ($maintainer3==$maintainer1 || $maintainer3==$maintainer2){
      return false;
    }
  }

  foreach ($resultsArray as $row){

      if ($row["Address"]==$address){
          return false;
      }
      if ($phone1==$row["Phone1"] || $phone1==$row["Phone2"]){
          return false;
      }
      if($phone2!=null){
        if ($phone2==$row["Phone1"] || $phone2==$row["Phone2"]){
            return false;
        }
      }
    }

  return true;

  }

function checkHotelOnUpdate($hotelid, $hotelname, $address, $phone1, $phone2, $maintainer1, $maintainer2, $maintainer3){
  global $db;
  $results=$db->prepare("Select * from hotels WHERE Id<>?");
  $results->bindValue(1, $hotelid);
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  if ($maintainer1!=null){
    if ($maintainer1==$maintainer2 || $maintainer1==$maintainer3){
      return false;
    }
  }

  if ($maintainer2!=null){
    if ($maintainer2==$maintainer1 || $maintainer2==$maintainer3){
      return false;
    }
  }

  if ($maintainer3!=null){
    if ($maintainer3==$maintainer1 || $maintainer3==$maintainer2){
      return false;
    }
  }


  foreach ($resultsArray as $row){

      if ($row["Address"]==$address){
          return false;
      }
      if ($phone1==$row["Phone1"] || $phone1==$row["Phone2"]){
          return false;
      }
      if($phone2!=null){
        if ($phone2==$row["Phone1"] || $phone2==$row["Phone2"]){
            return false;
        }
      }

  }

  return true;

}

function checkPending($workid){
  global $db;
  $results=$db->prepare("Select * from pending WHERE WorkId=?");
  $results->bindValue(1, $workid);
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

function checkUserOnUpdate($username, $hotelid){
  global $db;
  $results=$db->prepare("Select * from hotels WHERE Id<>?");
  $results->bindValue(1, $hotelid);
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
  foreach ($resultsArray as $row){
      if ($row["Username"]==$username){
          return false;
      }

  }

  return true;

}

function checkMaintainerOnUpdate($fullname, $maintainerid){
  global $db;
  $results=$db->prepare("Select * from maintainers WHERE Id<>?");
  $results->bindValue(1, $maintainerid);
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
  foreach ($resultsArray as $row){
      if ($fullname==$row['FirstName'].' '.$row['LastName']){
          return false;
      }

  }

  return true;

}

function deleteHotel($hotelid){
    global $db;

    try {

        $results = $db->prepare("Delete from hotels WHERE Id=? ");
        $results->bindValue(1, $hotelid);
        $results->execute();

        return "The user was deleted";

    }
    catch(Exception $e) {
        return "Error deleting user".$e;
    }
}

function deleteMaintainer($maintainerid){
    global $db;

    try {

        $results = $db->prepare("Delete from maintainers WHERE Id=? ");
        $results->bindValue(1, $maintainerid);
        $results->execute();

        return "The maintainer was deleted";

    }
    catch(Exception $e) {
        return "Error deleting maintainer".$e;
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

        $results = $db->prepare("Delete from works WHERE MaintainerId=? ");
        $results->bindValue(1, $maintainerid);
        $results->execute();

        return "The works were deleted";

    }
    catch(Exception $e) {
        return "Error deleting works".$e;
    }
}

function deletePendingWorksByHotel($hotelid){
    global $db;

    try {

        $results = $db->prepare("Delete from pending WHERE HotelId=? ");
        $results->bindValue(1, $hotelid);
        $results->execute();

        return "The works were deleted";

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

function searchWork($key)
{
    global $db;

    $key = '%' . $key . '%';
    $results = $db->prepare("SELECT t1.* from works t1 JOIN hotels t2 ON t1.HotelId=t2.Id WHERE Work LIKE ? OR Device LIKE ? OR Room LIKE ? OR HotelName LIKE ?");
    $results->bindValue(1, $key);
    $results->bindValue(2, $key);
    $results->bindValue(3, $key);
    $results->bindValue(4, $key);

    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;

}



?>

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

function addWork($hotel, $room, $device, $work, $days, $date){
    global $db;

    try {
        $results = $db->prepare("insert into works (HotelId, Room, Device, Work, Days, Date) values(?,?,?,?,?,?)");


        $results->bindValue(1, $hotel);
        $results->bindValue(2, $room);
        $results->bindValue(3, $device);
        $results->bindValue(4, $work);
        $results->bindValue(5, $days);
        $results->bindValue(6, $date);


        $results->execute();


        return "Work added";


    }
    catch(Exception $e) {
        return "Error adding work".$e;
    }

}

function addHotel($hotelname, $address, $maintainer1, $maintainer2, $maintainer3, $phone1, $phone2, $emailreport1, $emailreport2, $date, $username, $password1, $password2){
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


    if (checkHotel($hotelname, $address, $phone1, $phone2, $emailreport1, $emailreport2, $maintainer1, $maintainer2, $maintainer3)==false){
      $errormessage .="Invalid entries".'<br>';
    }

    if(checkUser($username)==false){
      $errormessage .="Username already exists".'<br>';
    }

    if ($errormessage==""){

      try {
          $results = $db->prepare("insert into hotels (HotelName, Address, Maintainer1, Maintainer2, Maintainer3, Phone1, Phone2, EmailReport1, EmailReport2, Username, Password, StartingDate) values(?,?,?,?,?,?,?,?,?,?,?,?)");


          $results->bindValue(1, $hotelname);
          $results->bindValue(2, $address);
          $results->bindValue(3, $maintainer1);
          $results->bindValue(4, $maintainer2);
          $results->bindValue(5, $maintainer3);
          $results->bindValue(6, $phone1);
          $results->bindValue(7, $phone2);
          $results->bindValue(8, $emailreport1);
          $results->bindValue(9, $emailreport2);
          $results->bindValue(10, $username);
          $results->bindValue(11, $password1);
          $results->bindValue(12, $date);


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

function updateHotel($hotelid, $hotelname, $address, $maintainer1, $maintainer2, $maintainer3, $phone1, $phone2, $emailreport1, $emailreport2, $date, $username, $password1, $password2){
    global $db;
    $errormessage="";
    if (checkHotelOnUpdate($hotelid, $hotelname, $address, $phone1, $phone2, $emailreport1, $emailreport2, $maintainer1, $maintainer2, $maintainer3)==false){
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
        $results = $db->prepare("update hotels SET HotelName=?, Address=?, Maintainer1=?, Maintainer2=?, Maintainer3=?, Phone1=?, Phone2=?, EmailReport1=?, EmailReport2=?, StartingDate=?, Username=?, Password=? WHERE Id=?");


        $results->bindValue(1, $hotelname);
        $results->bindValue(2, $address);
        $results->bindValue(3, $maintainer1);
        $results->bindValue(4, $maintainer2);
        $results->bindValue(5, $maintainer3);
        $results->bindValue(6, $phone1);
        $results->bindValue(7, $phone2);
        $results->bindValue(8, $emailreport1);
        $results->bindValue(9, $emailreport2);
        $results->bindValue(10, $date);
        $results->bindValue(11, $username);
        $results->bindValue(12, $password1);
        $results->bindValue(13, $hotelid);


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

function getWorksByRoom($room,$hotelid){
    global $db;
    $results=$db->prepare("SELECT * from works WHERE Room=? AND HotelId=?");
    $results->bindValue(1, $room);
    $results->bindValue(2, $hotelid);
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

    $results=$db->prepare("Select * from works WHERE Id=?");
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

  $results=$db->prepare("Select * from works WHERE HotelId=? AND Confirmation=0 AND DATE(Date)=CURDATE()");
  $results->bindValue(1, $hotelid);
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}

function getUpcomingWorksByHotel($hotelid,$date){
  global $db;

  $results=$db->prepare("Select * from works WHERE HotelId=? AND Days=DATEDIFF(?, Date)");
  $results->bindValue(1, $hotelid);
  $results->bindValue(2, $date);
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


function getRoomsByHotel($hotelid){
  global $db;

  $results=$db->prepare("Select DISTINCT Room from works WHERE HotelId=? AND Confirmation=0 AND DATE(Date)=CURDATE()");
  $results->bindValue(1, $hotelid);
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}

function getAllRooms(){
  global $db;

  $results=$db->prepare("Select DISTINCT Room, HotelId from works");
  $results->execute();
  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  return $resultsArray;

}

function getUpcomingRoomsByHotel($hotelid, $date){
  global $db;

  $results=$db->prepare("Select DISTINCT Room from works WHERE HotelId=? AND Days=DATEDIFF(?, Date)");
  $results->bindValue(1, $hotelid);
  $results->bindValue(2, $date);
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

function getHotelId($hotelname){
    global $db;

    $results=$db->prepare("Select * from hotels WHERE HotelName=?");
    $results->bindValue(1, $hotelname);
    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0];

}

function updateWork($workid, $hotel, $room, $device, $work, $days, $date, $confirmation, $notes){
    global $db;

    try {
        $results = $db->prepare("Update works Set HotelId=?, Room=?, Device=?, Work=?, Days=?, Date=?, Confirmation=?, Notes=? WHERE Id=?");


        $results->bindValue(1, $hotel);
        $results->bindValue(2, $room);
        $results->bindValue(3, $device);
        $results->bindValue(4, $work);
        $results->bindValue(5, $days);
        $results->bindValue(6, $date);
        $results->bindValue(7, $confirmation);
        $results->bindValue(8, $notes);
        $results->bindValue(9, $workid);



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
        $results = $db->prepare("Update works Set Confirmation=0 WHERE Id=?");
        $results->bindValue(1, $workid);
        $results->execute();
        return "Work updated";


    } catch (Exception $e) {
        return "Error updating work" . $e;
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


function checkHotel($hotelname, $address, $phone1, $phone2, $emailreport1, $emailreport2, $maintainer1, $maintainer2, $maintainer3){
  global $db;
  $results=$db->prepare("Select * from hotels");
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  if ($maintainer1!=""){
    if ($maintainer1==$maintainer2 || $maintainer1==$maintainer3){
      return false;
    }
  }

  if ($maintainer2!=""){
    if ($maintainer2==$maintainer1 || $maintainer2==$maintainer3){
      return false;
    }
  }

  if ($maintainer3!=""){
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
      if ($emailreport1==$row["EmailReport1"] || $phone1==$row["EmailReport2"]){
          return false;
      }
      if($emailreport2!=null){
        if ($emailreport2==$row["EmailReport1"] || $phone2==$row["EmailReport2"]){
            return false;
        }
      }
    }

  return true;

  }

function checkHotelOnUpdate($hotelid, $hotelname, $address, $phone1, $phone2, $emailreport1, $emailreport2, $maintainer1, $maintainer2, $maintainer3){
  global $db;
  $results=$db->prepare("Select * from hotels WHERE Id<>?");
  $results->bindValue(1, $hotelid);
  $results->execute();

  $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

  if ($maintainer1!=""){
    if ($maintainer1==$maintainer2 || $maintainer1==$maintainer3){
      return false;
    }
  }

  if ($maintainer2!=""){
    if ($maintainer2==$maintainer1 || $maintainer2==$maintainer3){
      return false;
    }
  }

  if ($maintainer3!=""){
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
      if ($emailreport1==$row["EmailReport1"] || $phone1==$row["EmailReport2"]){
          return false;
      }
      if($emailreport2!=null){
        if ($emailreport2==$row["EmailReport1"] || $phone2==$row["EmailReport2"]){
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

function searchRoom($key)
{
    global $db;

    $key = '%' . $key . '%';
    $results = $db->prepare("SELECT t1.* from works t1 JOIN hotels t2 ON t1.HotelId=t2.Id WHERE Room LIKE ? OR HotelName LIKE ? OR CONCAT_WS(' ',Room,HotelName) LIKE ? OR CONCAT_WS(' ',HotelName, Room) LIKE ?");
    $results->bindValue(1, $key);
    $results->bindValue(2, $key);
    $results->bindValue(3, $key);
    $results->bindValue(4, $key);


    $results->execute();
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;

}



?>

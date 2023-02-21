<?php

$m_id = "";
$m_Names = "";
$m_Surname = "";
$m_Phone = "";
$m_Email = "";
$m_dateOfBirth = "";
$m_Position = "";
$m_Location = "";
$m_Gender = "";
$m_About = "";
$m_Member_Start_Date = "";
$_By = "";

$errorMessage = "";
$successMessage = "";

session_start();

if(isset($_SESSION["user_id"])){
   
   $mysqli = require __DIR__ . "/../database.php";

   $sql = "SELECT * FROM Admin
           WHERE ad_id = '{$_SESSION["user_id"]}'";

   $result = $mysqli->query($sql);

   $user = $result->fetch_assoc();

}
//if data transmitted using post method
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $m_id = $_POST["email"];
    $m_Names = $_POST["names"];
    $m_Surname = $_POST["surname"];
    $m_Phone = $_POST["phone"];
    $m_Email = $_POST["email"];
    $m_dateOfBirth = $_POST["dateBirth"];
    //$m_Position = $_POST["position"];
    $m_Location = $_POST["location"];
    //$m_Gender = $_POST["gender"];
    $m_About = $_POST["about"];
    $m_Member_Start_Date = $_POST["startDate"];
    $_By = $user["ad_Names"] . " " . $user["ad_Surname"];

    
    do{
      //check empty fields
      if(empty($_POST["names"])){
        $errorMessage = "Please enter a valid names!";
        break;
      } else if (empty($_POST["phone"])){
        $errorMessage = "Please enter a valid surname!";
        break;
      } else if (empty($_POST["phone"])){
        $errorMessage = "Please enter a valid phone!";
        break;
      }else if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || empty($_POST["email"])){
        $errorMessage = "Please enter a valid email!";
        break;
      } else if (empty($_POST["message"])){
        $errorMessage = "Please enter a valid report!";
        break;
      } 
      //add new member to db

      //avoid sql injection attack
      $sql = "INSERT INTO ch_Members (ms_message, ms_type, ms_seen, ms_sender_phone, ms_sender_email, _By)
              VALUES (?, ?, ?, ?, ?, ?)";

      $stmt = $mysqli->stmt_init();

      //prepare for execution if false
      if ( ! $stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
      };

      $stmt->bind_param("ssssss",
                  $_POST["message"],
                  $type = "Reports",
                  $m_seen = "F",
                  $_POST["phone"],
                  $_POST["email"],
                  $_By = $_POST["names"]
                  );
      
                 // $successMessage = "You have added member successfully!";
                  if ($stmt->execute()){
                    echo "
                    <script>alert('You hve successfully added $m_Names $m_Surname as a member.');</script>
                    ";
                    //header("Location: members.php");
                    exit;
                } else{
                    if ($mysqli->errno){
                        die($mysqli->error . " " . $mysqli->errno); 
                    }
                };
      
   }while (false);
  }


?>
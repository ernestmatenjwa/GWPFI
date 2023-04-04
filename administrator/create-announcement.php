<?php

$an_Announcement = "";
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

    $_By = $user["ad_Names"] . " " . $user["ad_Surname"];

    
    do{
      //check empty fields
      if(empty($_POST["announcement"]) || empty($_POST["title"])){
        echo "
              <script>alert('Please enter all fields!');</script>
              ";
        break;
      } 
      //add new member to db

      //avoid sql injection attack
      $sql = "INSERT INTO announcement (an_title, an_Announcement, _By)
              VALUES (?, ?, ?)";

      $stmt = $mysqli->stmt_init();

      //prepare for execution if false
      if ( ! $stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
      };

      $stmt->bind_param("sss",
                  $_POST["title"],
                  $_POST["announcement"],
                  $_By
                  );
      
                 // $successMessage = "You have added member successfully!";
                  if ($stmt->execute()){
                    echo "
                    <script>alert('successfully added');</script>
                    ";
                    //header("Location: dashboard.php");
                    exit;
                } else{
                    if ($mysqli->errno){
                        die($mysqli->error . " " . $mysqli->errno); 
                    }
                };
      
   }while (false);
  


?>
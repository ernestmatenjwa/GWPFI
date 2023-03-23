<?php

$errorMessage = "";
$successMessage = "";

$mysqli = require __DIR__ . "/database.php";


//if data transmitted using post method
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    do{
      //check empty fields
      if(empty($_POST["names"])){
        die("Please enter a valid names!");
        $errorMessage = "Please enter a valid names!";
        break;
      } else if (empty($_POST["phone"])){
        die("Please enter a valid phone number!");
        $errorMessage = "Please enter a valid surname!";
        break;
      }else if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || empty($_POST["email"])){
        die("Please enter a valid email!");
        $errorMessage = "Please enter a valid email!";
        break;
      } else if (empty($_POST["message"])){
        die("Please enter a valid report!");
        $errorMessage = "Please enter a valid report!";
        break;
      } 
      //add new member to db

      //avoid sql injection attack
      $sql = "INSERT INTO message (ms_message, ms_type, ms_seen, ms_sender_phone, ms_sender_email, _By)
              VALUES (?, ?, ?, ?, ?, ?)";

      $stmt = $mysqli->stmt_init();

      //prepare for execution if false
      if ( ! $stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
      };

      $m_type = "Reports";
      $m_seen = "NO";
      $_By = $_POST["names"];
      $stmt->bind_param("ssssss",
                  $_POST["message"],
                  $m_type,
                  $m_seen,
                  $_POST["phone"],
                  $_POST["email"],
                  $_By
                  );
      
                 // $successMessage = "You have added member successfully!";
                  if ($stmt->execute()){
                    echo '
                    <script>
                    alert("You have successfully added a member.");
                    console.log("working!!!!!!.");
                    </script>
                    ';
                    //header("Location: report.html");
                    exit;
                } else{
                    if ($mysqli->errno){
                        die($mysqli->error . " " . $mysqli->errno); 
                    }
                };
      
   }while (false);
  }


?>
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

if(isset($_POST["update_id"])){
        
   $user_id = $_POST['update_id'];

   $sql = "SELECT * 
         FROM announcement
         WHERE an_id ='$user_id'";

   $result = mysqli_query($mysqli, $sql);
   $response = array();
   while($row = mysqli_fetch_assoc($result)){
        $response = $row;
   } 

   echo json_encode($response);
}else{
  $response['status'] = 200;
  $response['message'] = "Invalid or data not found";   
}

//update query
if(isset($_POST["hiddendata"])){
   $unique_id = $_POST['hiddendata'];
   $update_title = $_POST['update_title'];
   $update_an = $_POST['update_an'];

   $sql = "UPDATE announcement
           SET an_title = '$update_title', an_Announcement = '$update_an'
           WHERE an_id = '$unique_id'";

   $result = mysqli_query($mysqli, $sql);
}
?>
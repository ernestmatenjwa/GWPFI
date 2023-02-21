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
//if data transmitted using post method
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_By = $user["ad_Names"] . " " . $user["ad_Surname"];

    
    do{
      //check empty fields
      if(empty($_POST["announcement"])){
        $errorMessage = "Please enter valid announcement!";
        break;
      } 
      //add new member to db

      //avoid sql injection attack
      $sql = "INSERT INTO announcement (an_Announcement, _By)
              VALUES (?, ?)";

      $stmt = $mysqli->stmt_init();

      //prepare for execution if false
      if ( ! $stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
      };

      $stmt->bind_param("ss",
                  $_POST["announcement"],
                  $_By
                  );
      
                 // $successMessage = "You have added member successfully!";
                  if ($stmt->execute()){
                    echo "
                    <script>alert('successfully added');</script>
                    ";
                    header("Location: dashboard.php");
                    exit;
                } else{
                    if ($mysqli->errno){
                        die($mysqli->error . " " . $mysqli->errno); 
                    }
                };
      
   }while (false);
  }


?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>GWPFI | Create member</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>
   <?php if(isset($user)): ?>
   <form method="post"
   style="padding-left: 10%; 
          padding-right: 10%; 
          padding-top: 1%;">
          <h1 style="text-align: center; font-weight: bolder; color: grey;">Create Announcement</h1>
          <hr style="width: 90px;"/>
          <?php
          if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='close'><button>
            </div>
            ";
          }
          ?>
      
      </div>
        <label for="about">Announcement</label>
        <textarea type="text" class="form-control" id="announcement" name="announcement" rows="10" placeholder="Enter Announcement.." style="width: 100%" value="<?php echo $m_About; ?>"></textarea>
    </div>
    <div style="height:5px"></div>
    <div class="row mb-3">
      <div class="offset-sm-3 col d-grid">
        <button type="submit" class="btn btn-primary">Add Announcement</button>
      </div>  
      <div class="col-sm-3 d-grid">
        <button class="btn btn-primary" href="members.php" role="button">Cancel</button>
      </div>
    </div>
</form>
<?php else: ?>
         <p><a href="../login.php">Login in</a> or <a href="../signup.html">Sign up</a></p>
      <?php endif; ?>

      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   </body>
</html>
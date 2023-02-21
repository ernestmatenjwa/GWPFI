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
      if(empty($m_Names)){
        $errorMessage = "Please enter a valid name!";
        break;
      } else if (empty($m_Surname)){
        $errorMessage = "Please enter a valid surname!";
        break;
      } else if (empty($m_Phone)){
        $errorMessage = "Please enter a valid phone!";
        break;
      }else if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || empty($m_Email)){
        $errorMessage = "Please enter a valid email!";
        break;
      } else if (empty($m_dateOfBirth)){
        $errorMessage = "Please select a birth date!";
        break;
      } else if (empty($_POST["gender"]) || empty($_POST["position"])){
        $errorMessage = "Please select gender and position!";
        break;
      } else if (empty($_POST["location"])){
        $errorMessage = "Please enter valid location!";
        break;
      }else if (empty($m_Member_Start_Date)){
        $errorMessage = "Please select member start date!";
        break;
      }else if(empty($m_About)){
        $errorMessage = "Please enter valid about!";
        break;
      } 
      //add new member to db

      //avoid sql injection attack
      $sql = "INSERT INTO ch_Members (m_id, m_Names, m_Surname, m_Phone, m_Email, m_dateOfBirth, m_Position, m_Location, m_Gender, m_About, m_Member_Start_Date, _By)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $stmt = $mysqli->stmt_init();

      //prepare for execution if false
      if ( ! $stmt->prepare($sql)) {
        die("SQL error: " . $mysqli->error);
      };

      $stmt->bind_param("ssssssssssss",
                  $m_id,
                  $m_Names,
                  $m_Surname,
                  $m_Phone,
                  $m_Email,
                  $m_dateOfBirth,
                  $_POST["position"],
                  $m_Location,
                  $_POST["gender"],
                  $m_About,
                  $m_Member_Start_Date,
                  $_By
                  );
      
                 // $successMessage = "You have added member successfully!";
                  if ($stmt->execute()){
                    echo "
                    <script>alert('You hve successfully added $m_Names $m_Surname as a member.');</script>
                    ";
                    header("Location: members.php");
                    exit;
                } else{
                    if ($mysqli->errno === 1062){
                        die("Email already exist");
                    } else {
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
          <h1 style="text-align: center; font-weight: bolder; color: grey;">Add Member</h1>
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
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="names">Name(s)</label>
        <input type="text" class="form-control" id="names" name="names" placeholder="Enter names..." value="<?php echo $m_Names; ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="surname">Surname</label>
        <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter Surname..." value="<?php echo $m_Surname; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="phone">Phone no</label>
      <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone..." value="<?php echo $m_Phone; ?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email"  placeholder="Enter Email..." value="<?php echo $m_Email; ?>">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="dateBirth">Date of birth</label>
        <input type="date" class="form-control" id="dateBirth" name="dateBirth" value="<?php echo $m_dateOfBirth; ?>">
      </div>
      <div class="form-group col-md-4">
        <label for="position">Work</label>
        <select id="position" name="position" class="form-control">
          <option value="" selected="true" disabled="disabled" >Select Work</option>
                <option value="Administrator">Administrator</option>
                <option value="Board Commitee">Board Commitee</option> 
                <option value="Church commitee">Church commitee</option>
                <option value="Other">Other</option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" class="form-control">
          <option value="" selected="true" disabled="disabled">Select Gender</option> 
              <option value="Male">Male</option>
              <option value="Female">Female</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location..." value="<?php echo $m_Location; ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="startDate">Start date</label>
        <input type="date" class="form-control" id="startDate"  name="startDate" placeholder="Enter start date.." value="<?php echo $m_Member_Start_Date; ?>">
      </div>
      <div>
        
      </div>
        <label for="about">About</label>
        <textarea type="text" class="form-control" id="about" name="about" rows="2" placeholder="Enter about" style="width: 100%" value="<?php echo $m_About; ?>"></textarea>
    </div>
    <div style="height:5px"></div>
    <div class="row mb-3">
      <div class="offset-sm-3 col d-grid">
        <button type="submit" class="btn btn-primary">Add Member</button>
      </div>  
      <div class="col-sm-3 d-grid">
        <a class="btn bt-outline-primary" href="members.php" role="button">Cancel</button>
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
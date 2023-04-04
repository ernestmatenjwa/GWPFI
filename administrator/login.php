<?php
$is_invalid = false;
$error_message;
//detect if form is submitted
if($_SERVER["REQUEST_METHOD"] === "POST"){
   //database connection
   $mysqli = require __DIR__ . "/database.php";

   $sql = sprintf("SELECT * FROM Admin
                    WHERE ad_Email = '%s'",
                    $mysqli->real_escape_string($_POST["username"]));

    $result = $mysqli->query($sql);

    $admin = $result->fetch_assoc();

    if ($admin) {
        if(password_verify($_POST["password"], $admin["ad_Password"])){
            session_start(); 

            session_regenerate_id();

            $_SESSION["user_id"] = $admin["ad_id"];
            
            header("Location: admin-portal.php");
            exit;
        }
    }
    $error_message = "Username or password invalid!!!";
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/Logo_n.jpg" />
      <style>
.avatar{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: absolute;
    top: -50px;
    left: calc(50% - 50px);
}

    </style>  
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left p-5">
              <img src="images/avatar.png" class="avatar">
              <h4 style="color: grey; font-weight: bolder; text-align: center; padding: 2%; color: maroon;">L o g i n</h4>
              <?php if (isset($error_message)) { ?>
                  <div id="error_msg" style="background: #fe8b8e; padding: 10px; margin-bottom: 20px; text-align: center; font-size: 14px; transition: all 0.5s ease;"><?php echo $error_message; ?></div>

                  <!-- <div style="font-size: x-large; color: #d75151c1; padding: 10px; font-weight:bold;"><?php /*echo $error_message;*/ ?></div> -->
                <?php } ?>
                <form class="pt-3" method = "post">
            
            <div class="form-group">
              <label for="username">Username</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="fa fa-user text-primary"></i>
                  </span>
                </div>
                <input type="email" class="form-control form-control-lg border-left-0" id="username" autocomplete="off" name = "username" placeholder="Enter username eg alex@gmail.com" required>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="fa fa-lock text-primary"></i>
                  </span>
                </div>
                <input type="password" class="form-control form-control-lg border-left-0" autocomplete="off" id="password" name = "password" placeholder="Enter Password" required>                        
              </div>
            </div>
            <div class="my-2 d-flex justify-content-between align-items-center">
              <div class="form-check">
                <label class="form-check-label text-muted">
                  <input type="checkbox" class="form-check-input">
                  Keep me signed in
                </label>
              </div>
              <a href="#" class="auth-link text-black">Forgot password?</a>
            </div>
            <div class="mt-3">
              <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
            </div>
            <div class="text-center mt-4 font-weight-light">
              Don't have an account? <a href="register.html" class="text-primary">Create</a>
            </div>
          </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->
</html>

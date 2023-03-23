<?php

session_start(); // Start session management

// Check if user has already logged in
// if (isset($_SESSION['user_id'])) {
//     header("Location: dashboard.php"); // Redirect to dashboard if user is already logged in
//     exit;
// }

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form data
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Connect to database
    $servername = "localhost";
    $db_username = "mandhagr_websystems_10";
    $db_password = "websystems_10";
    $dbname = "mandhagr_websystems_10";
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * 
              FROM accounts 
              WHERE email = '$email'
              AND Password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      $_SESSION['user_id'] = $id;
      header("Location: admin-portal.php");
        exit;
      };
    // }else{
    // // Invalid login, show error message
    // $error_message = "Invalid email or password";
    // exit;
    // }
    //  // Prepare SQL statement
    //  $stmt = $conn->prepare("SELECT id, email, Password FROM accounts WHERE email = ?");
    //  $stmt->bind_param("s", $email);
    //  $stmt->execute();
    //  $stmt->store_result();

    // // Check if user with given email exists
    // if ($stmt->num_rows === 1) {

    //     // Get user details
    //     // $stmt->bind_result($id, $email, $hashed_password);
    //     // $stmt->fetch();
    //     $stmt->bind_result($id, $email, $password);
    //     $stmt->fetch();
    //     // Verify password
    //     if (password_verify($password, $hashed_password)) {
    //         // Password is correct, create session and redirect to dashboard
    //         $_SESSION['user_id'] = $id;
    //         header("Location: index-2.html");
    //         exit;
    //     }
    // }

    // Invalid login, show error message
    $error_message = "Invalid email or password";
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
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="images/display.jpeg" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">login to continue.</h6>
              <form class="pt-3" method = "post">
                <?php if (isset($error_message)) { ?>
                  <div style="font-size: x-large; color: #d75151c1; padding: 10px; font-weight:bold;"><?php echo $error_message; ?></div>
                <?php } ?>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="username" autocomplete="off" name = "username" placeholder="User Name" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" autocomplete="off" id="password" name = "password" placeholder="Password" required>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
          
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
             
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Register</a>
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

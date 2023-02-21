<?php

session_start();

if(isset($_SESSION["user_id"])){
   
   $mysqli = require __DIR__ . "/../database.php";

   $sql = "SELECT * FROM Admin
           WHERE ad_id = '{$_SESSION["user_id"]}'";

   $result = $mysqli->query($sql);

   $user = $result->fetch_assoc();

}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>GWPFI | Admin Dashboard</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="icon" href="images/fevicon.png" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="dashboard dashboard_1">
      <?php if(isset($user)): ?>
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        <a href="../index.html"><img class="logo_icon img-responsive" src="../images/Logo_n.jpg" alt="#" /></a>
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="<?= htmlspecialchars($user["ad_picture"]) ?>" alt="#" /></div>
                        <div class="user_info">
                           <h6><?= htmlspecialchars($user["ad_Names"] . " " . $user["ad_Surname"]) ?></h6>
                           <p><span class="online_animation"></span> Online</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>
                  <ul class="list-unstyled components">
                     <li class="active">
                        <a href="dashboard.html" data-toggle="collapse" aria-expanded="false"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
                     </li>
                     <li>
                        <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Messages</span></a>
                        <ul class="collapse list-unstyled" id="element">
                           <li><a href="reports.html"> <span>Problem Reports</span></a></li>
                           <li><a href="songrequests.html"> <span>Songs Requests</span></a></li>
                           <li><a href="homeprayerrequests.html"> <span>Home Prayer Request</span></a></li>
                           <li><a href="questions.html"> <span>Questions</span></a></li>
                        </ul>
                     </li>
                     <li><a href="media_gallery.html"><i class="fa fa-briefcase blue1_color"></i> <span>Church Gallery</span></a></li>
                     <li><a href="announcements.html"><i class="fa fa-briefcase blue1_color"></i> <span>Announcements</span></a></li>
                     <li>
                        <a href="members.php">
                        <i class="fa fa-paper-plane red_color"></i> <span>Church Members</span></a>
                     </li>
                     <li><a href="comitee.html"><i class="fa fa-map purple_color2"></i> <span>Church Commitee</span></a></li>
                     <li><a href="info.html"><i class="fa fa-bar-chart-o green_color"></i> <span>Church information</span></a></li>
                     <li><a href="settings.html"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li>
                  </ul>
               </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        
                        <div class="right_topbar">
                           <div class="icon_info">
                              <ul>
                                 <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                                 <li><a href="#"><i class="fa fa-question-circle"></i><span class="badge">3</span></a></li>
                                 <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                              </ul>
                              <ul class="user_profile_dd">
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="../images/Alex.jpg" alt="#" /><span class="name_user"><?= $user["ad_Names"] . " " . $user["ad_Surname"] ?></span></a>
                                    <div class="dropdown-menu">
                                       <a class="dropdown-item" href="profile.html">My Profile</a>
                                       <a class="dropdown-item" href="settings.html">Settings</a>
                                       <a class="dropdown-item" href="help.html">Help</a>
                                       <a class="dropdown-item" href="../logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Hello;</h2>
                                 <p><?= htmlspecialchars($user["ad_Names"] . " " . $user["ad_Surname"]) ?></p>
                           </div>
                        </div>
                     </div>
                     <?php
                                                echo "
                                                <a type='button' href='create-pledge.php' class='btn btn-success'>Create Pledge</a>
                                                <a type='button' href='create-announcement.php' class='btn btn-success'>Add announcement</a>
                                                <a type='button' href='create-member.php' class='btn btn-success'>Add member</a>
                                                "
                                                ?>
                       
                  <!-- footer -->
                  <div class="container-fluid">
                     <div class="footer">
                        <p style="color: white;">Copyright ©<a id="year"></a> Designed by <a>Ernest Matenjwa</a>. All rights reserved.</p>
                     </div>
                  </div>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      <?php else: ?>
         <p><a href="../login.php">Login in</a> or <a href="../signup.html">Sign up</a></p>
      <?php endif; ?>
      <!-- jQuery -->
      <script>
      let currentDate = new Date();
       let cDay = currentDate.getDate()
       let cMonth = currentDate.getMonth() + 1
       let cYear = currentDate.getFullYear()
       let cMin = currentDate.getMinutes();
       let cHours = currentDate.getHours();
       
       console.log(cDay);
       console.log(cMonth);
       console.log(cYear);

       document.getElementById("year").innerHTML = cYear;
       document.getElementById("date").innerHTML = cDay + "-" + cMonth + "-" + cYear;
       document.getElementById("time").innerHTML = cHours + " : " + cMin;

      </script>
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/chart_custom_style1.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>
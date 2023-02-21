<?php

session_start();

if(isset($_SESSION["user_id"])){
   
   $mysqli = require __DIR__ . "/../database.php";

   $sql = "SELECT * FROM Admin
           WHERE ad_id = '{$_SESSION["user_id"]}'";

   $result = $mysqli->query($sql);

   $user = $result->fetch_assoc();

}

$id = $_GET["upd_id"];

$sql0 = "SELECT * 
         FROM ch_Members
         WHERE m_id='$id'";

$result0 = mysqli_query($mysqli, $sql0);

$member = $result0->fetch_assoc();

$Names = $member["m_Names"];
$Surname = $member["m_Surname"];
$Phone = $member["m_Phone"];
$Email = $member["m_Email"];
$Location = $member["m_Location"];
$About = $member["m_About"];

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
      <title>Member Profile</title>
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
      <!-- calendar file css -->
      <link rel="stylesheet" href="js/semantic.min.css" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="inner_page profile_page">
   <?php if(isset($user)): ?>
      <div class="full_container">
         <div class="inner_container">
         <!-- Sidebar  -->
         <nav id="sidebar">
            <div class="sidebar_blog_1">
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
               <li><a href="dashboard.php"><i class="fa fa-dashboard blue1_color"></i> <span>Dashboard</span></a></li>
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
                  <li><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
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
                              <h2>Member Profile</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column1">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2 style="color: maroon; align-text: center;"><strong><?= htmlspecialchars($member["m_Names"] . " " . $member["m_Surname"]) ?></strong></h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <div class="col-lg-12">
                                       <div class="full dis_flex center_text">
                                          
                                          <div class="profile_contant">
                                             <div class="contact_inner">
                                                <ul class="list-unstyled">
                                                   <li style="font-size: 16px;"><i class="fa fa-envelope-o"></i> : <?= htmlspecialchars($member["m_Email"]) ?></li>
                                                   <li style="font-size: 16px;"><i class="fa fa-phone"></i> : <?= htmlspecialchars($member["m_Phone"]) ?></li>
                                                   <li style="font-size: 16px;"><i class="fa fa-home"></i> : <?= htmlspecialchars($member["m_Location"]) ?></li>
                                                   <p style="font-size: 16px;"><strong>Date of birth: </strong><?= htmlspecialchars($member["m_dateOfBirth"]) ?></p>
                                                   <p style="font-size: 16px;"><strong>Gender: </strong><?= htmlspecialchars($member["m_Gender"]) ?></p>
                                                   <p style="font-size: 16px;"><strong>Start date: </strong><?= htmlspecialchars($member["m_dateOfBirth"]) ?></p>
                                                   <p style="font-size: 16px;"><strong>Work: </strong><?= htmlspecialchars($member["m_Position"]) ?></p>
                                                   <p style="font-size: 16px;"><strong>Status: </strong><?= htmlspecialchars($member["m_Status"]) ?></p>
                                                </ul>
                                                <p style="font-size: 16px;"><strong>About: </strong><?= htmlspecialchars($member["m_About"]) ?></p>
                                                <?php
                                                echo "
                                                <a type='button' href='update-member.php?upd_id=$id' class='btn btn-success'>Update Member</a>
                                                <a type='button' href='add-pledge.php?add_id=$id' class='btn btn-warning'>Add Pledge</a>
                                                "
                                                ?>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- profile contant section -->
                                       <div class="full inner_elements margin_top_30">
                                          <div class="tab_style2">
                                             <div class="tabbar">
                                                <nav>
                                                   <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#recent_activity" role="tab" aria-selected="true">Pledges</a>
                                                      <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#project_worked" role="tab" aria-selected="false">Projects Worked on</a>
                                                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#profile_section" role="tab" aria-selected="false">Profile</a> -->
                                                   </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                   <div class="tab-pane fade show active" id="recent_activity" role="tabpanel" aria-labelledby="nav-home-tab">
                                                      <div class="msg_list_main">
                                                         <ul class="msg_list">
                                                            <li>
                                                               <span>
                                                               <span class="name_user">Sakhiwo</span>
                                                               <span class="msg_user">Contibuted R 1 000</span>
                                                               <span class="time_ago">12-02-2023</span>
                                                               </span>
                                                            </li>
                                                            <li>
                                                               <span>
                                                               <span class="name_user">Sakhiwo</span>
                                                               <span class="msg_user">Contibuted R 1 000</span>
                                                               <span class="time_ago">12-02-2023</span>
                                                               </span>
                                                            </li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                   <!-- <div class="tab-pane fade" id="project_worked" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et 
                                                         quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos 
                                                         qui ratione voluptatem sequi nesciunt.
                                                      </p>
                                                   </div>
                                                   <div class="tab-pane fade" id="profile_section" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                      <p></strong>
                                                      </p>
                                                   </div> -->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- end user profile section -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-2"></div>
                        </div>
                        <!-- end row -->
                     </div>
                     <!-- footer -->
                     <div class="container-fluid">
                        <div class="row">
                           <div class="footer">
                              <p>Copyright © 2018 Designed by html.design. All rights reserved.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end dashboard inner -->
               </div>
            </div>
         </div>
      </div>
      <?php else: ?>
         <p><a href="../login.php">Login in</a> or <a href="../signup.html">Sign up</a></p>
      <?php endif; ?>
      <!-- jQuery -->
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
      <script src="js/custom.js"></script>
      <!-- calendar file css -->    
      <script src="js/semantic.min.js"></script>
   </body>
</html>
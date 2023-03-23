<?php
$is_invalid = false;

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

            header("Location: administrator");
            exit;
        }
    }
    $is_invalid = true;
}

?>
<html>
<head>
    <title> GWPFI | Login </title>
    <style>
      body{
    margin: 0;
    padding: 0;
    /* background: url(images/Logo_n.jpg);  */
    background-image: linear-gradient(rgba(0,0,0,0.877), rgba(0, 0, 0, 0.877)), url(images/Logo_n.jpg);
    /* background-size: cover; */
    background-repeat: repeat;
    /* background-position: center; */
    font-family: sans-serif;
}
.login-box{
    width: 50%;
    /* height: 420px; */
    margin: 8% auto;
    position: relative;

    background: rgba(73, 22, 35, 0.856);
    color: #fff;
    box-sizing: border-box;
    padding: 70px 30px;
}
.avatar{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: absolute;
    top: -50px;
    left: calc(50% - 50px);
}
h1{
    margin: 0;
    padding: 0 0 20px;
    text-align: center;
    font-size: 22px;
}
.login-box p{
    margin: 0;
    padding: 0;
    font-weight: bold;
}
.login-box input{
    width: 100%;
    margin-bottom: 20px;
}
.login-box input[type="text"], input[type="password"]
{
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
}
.login-box input[type="submit"]
{
    border: none;
    outline: none;
    height: 40px;
    background: #2691d9;
    color: #fff;
    font-size: 18px;
    border-radius: 20px;
}
.login-box input[type="submit"]:hover
{
    cursor: pointer;
    background: maroon;
    color: #000;
}

.login-box a{
    text-decoration: none;
    font-size: 14px;
    color: #fff;
}
.login-box a:hover
{
    color: #2691d9;
}
.signup_link{
  margin: 30px 0;
  text-align: center;
  font-size: 16px;
  color: #666666;
}
.signup_link a{
  color: #2691d9;
  text-decoration: none;
}
.signup_link a:hover{
  text-decoration: underline;
}


    </style>     
</head>
    <body>
    <div class="login-box">
    <img src="images/avatar.png" class="avatar">
        <h1>Login</h1>
        <?php if ($is_invalid): ?>
            <em>Invalid login<em>
        <?php endif; ?>
            <form method="post">
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Enter Username"
            value="<?= $_POST["username"] ?? "" ?>">
            <p>Password</p>
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <div style="padding-bottom: 2%;">
              <a href="#">Forgot Password?</a> 
            </div>
            
            <input type="submit" name="submit" value="Login">
              
            <div class="signup_link">
              Not a member? <a href="signup.html">Signup</a> /<a style="color: red;" href="index.html">Home</a>
            </div> 
            </form> 
    </div>
    
    </body>
</html>
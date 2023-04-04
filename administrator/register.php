<?php 
//validate input fields in serverside
  
if (empty($_POST["names"]) || empty($_POST["surname"]) || empty($_POST["phone"]) || empty($_POST["key"]) || empty($_POST["position"]) || empty($_POST["gender"]) ){
    die('<div style="background: #fe8b8e; padding: 10px; margin-bottom: 20px; text-align: center; font-size: 14px; transition: all 0.5s ease; color: white;">All fields are required!</div>');
}
if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die('<div style="background: #fe8b8e; padding: 10px; margin-bottom: 20px; text-align: center; font-size: 14px; transition: all 0.5s ease; color: white;">Valid email is required! eg alex@gmail.com</div>');
}
if (strlen($_POST["password"]) < 8 || ! preg_match("/[0-9]/", $_POST["password"]) || ! preg_match("/[a-z]/i", $_POST["password"]) ){
    die('<div style="background: #fe8b8e; padding: 10px; margin-bottom: 20px; text-align: center; font-size: 14px; transition: all 0.5s ease; color: white;">Password must at least have 8 characters, 1 digit, and 1 letter</div>');
}
if ($_POST["password"] != $_POST["password2"]){
    die('<div style="background: #fe8b8e; padding: 10px; margin-bottom: 20px; text-align: center; font-size: 14px; transition: all 0.5s ease; color: white;">Passwords do not match</div>');
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = sprintf("SELECT * 
                FROM ch_key
                WHERE c_key = '%s'",             
                $mysqli->real_escape_string($_POST["key"]));

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    
//avoid sql injection attack
$sql = "INSERT INTO Admin (ad_id, ad_Names, ad_Surname, ad_Phone, ad_Email, ad_Church_Key, ad_Position, ad_Gender, ad_Password, _By)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

//prepare for execution if false
if ( ! $stmt->prepare($sql)) {
die("SQL error: " . $mysqli->error);
};

$stmt->bind_param("ssssssssss",
           $_POST["email"],
           $_POST["names"],
           $_POST["surname"],
           $_POST["phone"],
           $_POST["email"],
           $_POST["key"],
           $_POST["position"],
           $_POST["gender"],
           $password_hash,
           $_POST["names"]
           );

if ($stmt->execute()){
    echo '<script>
    alert("You have successfully login");
    window.location.href = "login.php";
    </script>';
    //echo"<p style='color:white'>You have successfully registered</p>"; 
    //header("Location: login.php", true, 301);
    exit();
    //die('<div style="background: green; padding: 10px; margin-bottom: 20px; text-align: center; font-size: 14px; transition: all 0.5s ease; color: white;">Congratulations you have successfully registered</div>');
} else{
if ($mysqli->errno === 1062){
    die('<div style="background: #fe8b8e; padding: 10px; margin-bottom: 20px; text-align: center; font-size: 14px; transition: all 0.5s ease; color: white;">Email already exist</div>');
} else {
die($mysqli->error . " " . $mysqli->errno); 
}
};
}else{
    die('<div style="background: #fe8b8e; padding: 10px; margin-bottom: 20px; text-align: center; font-size: 14px; transition: all 0.5s ease; color: white;">Sorry something went wrong when registering contact technical support for help!</div>');
}



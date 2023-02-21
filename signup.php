<?php 
//validate input fields in serverside
  
if (empty($_POST["names"])){
    die("Name is required!");
}
if (empty($_POST["surname"])){
    die("Surname is required!");
}
if (empty($_POST["phone"])){
    die("Phone is required!");
}
if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Valid email is required!");
}
if (empty($_POST["key"])){
    die("Key is required!");
}
if (empty($_POST["position"])){
    die("Position is required!");
}
if (empty($_POST["gender"])){
    die("Gender is required!");
}
if (strlen($_POST["password"]) < 8){
    die("Password must be at least 8 characters");
}
if (! preg_match("/[0-9]/", $_POST["password"])){
    die("Password must be at least one number");
}
if (! preg_match("/[a-z]/i", $_POST["password"])){
    die("Password must be at least one letter");
}
if ($_POST["password"] !== $_POST["password2"]){
    die("Passwords must match");
}
if ($_POST["key"] !== $_POST["GWpfiMinistries2023"]){
    die("Something went wrong when registering please contact our administrator for help!");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

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
    //must send email here

    //succcess message
    header("Location: signupsuccess.html");
    exit;
} else{
    if ($mysqli->errno === 1062){
        die("Email already exist");
    } else {
        die($mysqli->error . " " . $mysqli->errno); 
    }
};


<?php
// Retrieve form data
//business - user
$BusName = $_POST['BusName'];
$slogan = $_POST['slogan'];
$contactno = $_POST['contactno'];

//personal - user pri
$p_names = $_POST['p_names'];
$p_email = $_POST['p_email'];
$p_phone = $_POST['p_phone'];
$p_password = $_POST['p_password'];
$p_passconf = $_POST['p_passconf'];
$hint = $_POST['hint'];
$accesslevel = $_POST['accesslevel'];
$campanykey = $_POST['campanykey'];

$errorMsg = "";
$successMsg ="";

// Validate input data 
if (empty($p_names)){
echo "Please fill in names.";
  exit;
} else if (empty($p_email)){
    echo "Please fill in email address.";
    exit;
}  else if (empty($p_password)){
    echo "Please fill in password.";
    exit;
} else if (empty($p_passconf)){
    echo "Please fill in password confirmation.";
    exit;
} else if (empty($hint)){
    echo "Please fill hint.";
    exit;
}else if (empty($accesslevel)){
    echo "Please select access level.";
    exit;
} else if (empty($campanykey)){
    echo "Please fill in campany key.";
    exit;
}else if (empty($BusName)){
    echo "Please fill in business name.";
    exit;
}else if (empty($slogan)){
    echo "Please fill in slogan.";
    exit;
}else if (empty($p_phone)){
    echo "Please fill in personal number.";
    exit;
}else if (empty($contactno)){
    echo "Please fill in business number.";
    exit;
}else if ($p_password != $p_passconf){
    echo "Passwords do not match";
    exit;
}

// Connect to the database
$db = new mysqli('localhost', 'mandhagr_websystems_10', 'websystems_10', 'mandhagr_websystems_10');

// Check if username already exists
$query = "SELECT * FROM accounts WHERE email = '$p_email'";
$result = $db->query($query);

if ($result->num_rows > 0) {
  echo "Username already exists. Please choose another one.";
  exit;
}

$query = "SELECT * FROM company_keys WHERE c_key = '$campanykey'";
$result2 = $db->query($query);

if ($result2->num_rows > 0) {
 // Insert user data into database
$query = "INSERT INTO userprofile (Business_Name, Slogan, Contact_Number) VALUES ('$BusName', '$slogan', '$contactno')";
mysqli_query($db, $query);

$query2 = "INSERT INTO accounts (Username, names, Contact_Number, email, Password, Hint, AccessType) VALUES ('$p_email', '$p_names', '$p_phone', '$p_email', '$p_password', '$hint', '$accesslevel')";
mysqli_query($db, $query2);

//$result = $db->query($query);
if (!mysqli_error($db)) {
    mysqli_query($db, "COMMIT");
    echo "Sign up successful! please check your email for confirmation";
/*
    //send an email confirmation
$to = $p_email;
$subject = 'Account Confirmation';
$message = 'Hello'.' '.$p_names.' '. "\r\n". 
'Congratulations your account was created successfully. You can now login to your account, Your username to login in is. '.' '.$p_email.' '. "\r\n". 
'Thank and have a wonderful day..';

$headers = 'From: notifications@eKhonnector.co.za' . "\r\n" .
    'Reply-To: notifications@eKhonnector.co.za' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
  echo 'Email sent successfully';
} else

{
  echo 'There was an error sending the email.';
  
   // Get the error message
  $errorMessage = error_get_last()['message'];
  // Log the error message to a file or database
  error_log($errorMessage);
  exit;
}*/
    header("Location: login.html");
    exit;

} else {
    mysqli_query($db, "ROLLBACK");
    echo "Error: " . $db->error;
}

// if ($result) {
//   echo "Sign up successful!";
// } else {
//   echo "Error: " . $db->error;
// }

// Close database connection
$db->close();
} else {
    echo "The was a problem registering, please provide correct campany key";
    exit;
}
?>

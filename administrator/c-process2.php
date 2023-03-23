<?php
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
$p_no = rand(100,999);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$idno= mysqli_real_escape_string($conn, $_POST['idno']);
$sname = mysqli_real_escape_string($conn, $_POST['sname']);
$contact= mysqli_real_escape_string($conn, $_POST['contact']);
$dep_type = mysqli_real_escape_string($conn, $_POST['dep_type']);
$nationality= mysqli_real_escape_string($conn, $_POST['nationality']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$Status = "Active";
//$insert = "insert into additional_members(ad_name, ad_id, birthday, ad_quote_id) values('$ad_name', '$ad_id', '$ad_date','$ad_quote_id')";
$insert = "insert into additional_members(Name, _ID, Surname, ContactNo, dep_type, Nationality, Gender, Status, Policy_Number) 
           values('$fname', '$idno', '$sname', '$contact', '$dep_type', '$nationality', '$gender', '$Status', '$p_no')";
           
$query = mysqli_query($conn, $insert);

if($query === FALSE){  
    throw new exception(mysqli_error($conn));
}
if($query){ 
    echo '<script>alert($fname.=" Successfully added")</script>';
    // echo'<script>alert("Member Successfully added!");</script>'; 
    echo"<p style='color:green; font-size: 30px; font-weight: bolder'>'$fname' Successfully added!</p>"; 
}
else{
    //alert("Error accured member not added!")
    echo"<p style='color:red'>Could not save member, please try again later</p>";
}
?>
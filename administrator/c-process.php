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

$period = mysqli_real_escape_string($conn, $_POST['period']);
$group= mysqli_real_escape_string($conn, $_POST['group']);
$names = mysqli_real_escape_string($conn, $_POST['names']);
$product= mysqli_real_escape_string($conn, $_POST['product']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$add_benefits= mysqli_real_escape_string($conn, $_POST['add_benefits']);
$idno = mysqli_real_escape_string($conn, $_POST['idno']);
$email= mysqli_real_escape_string($conn, $_POST['email']);
$product_add_ben = mysqli_real_escape_string($conn, $_POST['product_add_ben']);
$policy_opt= mysqli_real_escape_string($conn, $_POST['policy_opt']);
$Dep_covered = mysqli_real_escape_string($conn, $_POST['Dep_covered']);
$policy_no= mysqli_real_escape_string($conn, $_POST['policy_no']);
$ext_members = mysqli_real_escape_string($conn, $_POST['ext_members']);
$inc_date= mysqli_real_escape_string($conn, $_POST['inc_date']);
$m_status = mysqli_real_escape_string($conn, $_POST['m_status']);
$res_address= mysqli_real_escape_string($conn, $_POST['res_address']);
$en_sms= mysqli_real_escape_string($conn, $_POST['en_sms']);
$gender= mysqli_real_escape_string($conn, $_POST['gender']);

//$insert = "insert into additional_members(ad_name, ad_id, birthday, ad_quote_id) values('$ad_name', '$ad_id', '$ad_date','$ad_quote_id')";
$insert = "insert into new_clients(Customer_names, ID_no, phone, Gender, Product, Policy, Marital_Status, Dep_Covered, Group_Name, email, Address, Product_Added_Benefit, sms_status, Inception_date, Period, policy_no, extended_members, Product_add_ben) 
           values('$names', '$idno', '$phone', '$gender', '$product', '$policy_opt', '$m_status', '$Dep_covered', '$group', '$email', '$res_address', '$add_benefits', '$en_sms', '$inc_date', '$period', '$policy_no', '$ext_members', '$Product_add_ben')";
           
$query = mysqli_query($conn, $insert);

if($query === FALSE){  
    throw new exception(mysqli_error($conn));
}
if($query){ 
    //alert("Member Successfully added!"); 
    //echo"<p style='color:white'>You have successfully added client</p>"; 
    echo '<script>alert("Client Successfully added")</script>';
    //header("Location: dependents.html");
}
else{
    //alert("Error accured member not added!")
    die("Could not save member, please try again later ");
    echo"<p style='color:red'>Could not save member, please try again later</p>";
    
}
?>
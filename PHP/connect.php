<?php
 

  $error = "";
  $successmsg = "";
  if($_POST){
  if(!$_POST["Name"]){
    $error .= "An email address is requeired. <br>";
  }

  if(!$_POST["age"]){
    $error .= "Age is requeired. <br>";
  }

  if(!$_POST["gender"]){
    $error .= "Gender is requeired. <br>";
  }
  if(!$_POST["aadhaar_card_number"]){
    $error .= "Aadhaar card number is requeired. <br>";
  }

  if ($_POST["Name"] && filter_var($_POST["Name"], FILTER_VALIDATE_EMAIL)) {
    $error .= "Invalid email format";
  }

  if($error != ""){
    $error = '<div class="alert alert-danger" role="alert"><strong>There is error(s) in your form</strong>'.$error.'</div>';
  }
  else{

    $benificary_name = $_POST['Name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $aadhaar_card = $_POST['aadhaar_card_number'];

    //DB connection
  $conn = new mysqli('localhost','root','','benificary_details');
  if($conn -> connect_error){
    die('connection Failed :'.$conn->connect_error);
  }else{
    $stmt = $conn->prepare("insert into benificary_details_1(Aadhaar_card_number, Benificary_name, Age, Gender) values(?,?,?,?)");
    $stmt->bind_param("isss",$aadhaar_card,$benificary_name,$age,$gender);
    $stmt->execute();
    $successmsg = '<div class="alert alert-success" role="alert"><strong>Successfull Registration</strong></div>';
    $stmt->close();
    $conn->close();
  }
  }
}
?>
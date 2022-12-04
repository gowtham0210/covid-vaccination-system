<?php 
 session_start();
 $error = "";
 $successmsg = "";
 $hospitalname = "";
 $cphid = $_SESSION['Hid'];
 $conn =  mysqli_connect('localhost','root','root','u817029086_Covac');
 //Retrieving Hospital Name
 $hosname = mysqli_query($conn,"SELECT * FROM hospital where Hid = '$cphid'");
 $datarows = $hosname->fetch_assoc();
 $hospitalname = $datarows['Hname'];

 if(isset($_POST['aadhaar_card_num']) && isset($_POST['choose_sts']) &&  isset($_POST['choose_dose']) &&  isset($_POST['choose_vaccine'])){
      $aadhaar_card_num = $_POST['aadhaar_card_num'];
      $choose_sts = $_POST['choose_sts'];
      $choose_dose = $_POST['choose_dose'];
      $choose_vaccine = $_POST['choose_vaccine'];
      

      $Hospital_id = $_SESSION['hospital_id'];
     

     
      

      if($aadhaar_card_num == ""){
        $error .= "Enter Aadhaar card Number. <br>";

      }
      if($choose_sts == ""){
        $error .= "Choose Status. <br>";

      }
      if($choose_dose == ""){
        $error .= "Choose Dose. <br>";
      }
      if($choose_vaccine == ""){
        $error .= "Choose Vaccine. <br>";
      }

      if($error != ""){
        $error = '<div class="alert alert-danger" role="alert"><strong>Missing Details <br></strong>'.$error.'</div>';

      }else{
        $conn =  mysqli_connect('localhost','u817029086_covac','Covac@2022','u817029086_Covac');
        
          if($conn->connect_error){
            die("Failed to connect :".$conn->connect_error);
          }else{
            
            $res = mysqli_query($conn,"SELECT * FROM benificary_details_1 WHERE Aadhaar_card_number = '$aadhaar_card_num'");
            $count = mysqli_num_rows($res);
            if($count > 0){
               $data = $res->fetch_assoc();
               $res_hosiptal_id = $data['Hid'];
               
               // checking wheather the patient is getting vaccinated at a registered hospital
                if($res_hosiptal_id == $cphid){

                  //Checking wheater the record is already exist or not 
                  $res1 = mysqli_query($conn, "SELECT * FROM vaccine_status WHERE Aadhaar_card_number  = '$aadhaar_card_num'");
                  $count = mysqli_num_rows($res1);
                  $data1 = $res1 ->fetch_assoc();
                  $dosenumber = $data1['Dose'];
                  if($count >0 && $dosenumber == 1){

                    // update Dose count if already vaccinated dose 1
                    mysqli_query($conn, "UPDATE vaccine_status SET Dose = 2 WHERE Aadhaar_card_number = '$aadhaar_card_num'");

                  }else{
                    $stmt = $conn->prepare("insert into vaccine_status(Aadhaar_card_number, status, vaccine_name, Dose, Hid) values(?,?,?,?,?)");
                    $stmt->bind_param("isssi",$aadhaar_card_num,$choose_sts ,$choose_vaccine,$choose_dose,$Hospital_id);
                    $stmt->execute();
                    $successmsg = '<div class="alert alert-success" role="alert"><strong>Successfull Registration</strong></div>';
                    $stmt->close();
                    $conn->close();
                  }
                    
               }else{
                $error = 'The Aadhaar card number does not registered under our hosiptal';
               }
            }
          }
 }
 }
 if($error != ""){
  $error = '<div class="alert alert-danger" role="alert"><strong>Missing Details <br></strong>'.$error.'</div>';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/vaccine_status.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
<div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light  nb">
            <a class="navbar-brand text-white" href="#">COVAC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link text-white" href="../Html/index.html">Home </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="registration.php">Register <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/contact-us.php">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/covac_portal.php">COVAC Portal</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/download_certificate.php">Download Certificate</a>
                </li>
              </ul>
            </div>
          </nav>
</div>
<div class="container">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6" style="padding-top:25px;"><?php echo "<h1>".$hospitalname."</h1>" ?></div>
      <div class="col-md-3" style="padding-top:25px;"><button type="button" class="btn btn-danger"><a class = "nav-link" href="covac_portal.php" style="color:white;">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a></button></div>
    </div>
  </div>
</div>
<div class="container cont">
  <div class="row">
    <div class="col">
    <form method = "POST" action="#">
        <div id="error"><?php echo $error.$successmsg; ?></div>
        <label for="exampleInputEmail1">Aadhaar Card Number: </label>
        <input class="form-control" type="text" name="aadhaar_card_num" placeholder="Aadhaar Card Number">
        <br>
        <label for="exampleInputEmail1">Status</label>
        <select name="choose_sts" class="form-control">
            <option>Choose Status</option>
            <option value="vaccinated">Vaccinated</option>
            <option value="Not Vaccinated">Not Vaccinated</option>
        </select>
        <br>
        <label for="exampleInputEmail1">Dose</label>
        <select name="choose_dose" class="form-control">
            <option>Choose Dose</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <br>
        <label for="exampleInputEmail1">Vaccine</label>
        <select name="choose_vaccine" class="form-control">
            <option>Choose Vaccine</option>
            <option value="covishield">Covishield</option>
            <option value="covaxin">covaxin</option>
        </select><br>

        <button type="submit" class="btn btn-primary">Update</button>
   </form>
  </div>
    <div class="col">
      
    </div>
  </div>
</div>

  <?php include("footer.php") ?>
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
          
    
</body>
</html>


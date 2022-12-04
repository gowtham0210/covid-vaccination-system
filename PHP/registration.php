<?php

  session_start();
  $error = "";
  $successmsg = "";
  if($_POST){
  if(!$_POST["Name"]){
    $error .= "Name is required. <br>";
  }

  if(!$_POST["age"]){
    $error .= "Age is required. <br>";
  }

  if(!isset($_POST["gender"])){
    $error .= "Gender is required. <br>";
  }
  if(!$_POST["aadhaar_card_number"]){
    $error .= "Aadhaar card number is required. <br>";
  }
  if((strlen($_POST["aadhaar_card_number"]) != 12 )&&( $_POST["aadhaar_card_number"] != "")){
    $error .= "Aadhaar card number should be 12 digit. <br>";
  }

  if($error != ""){
    $error = '<div class="alert alert-danger" role="alert"><strong>Missing Details <br></strong>'.$error.'</div>';
  }
  else{

    $benificary_name = $_POST['Name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $aadhaar_card = $_POST['aadhaar_card_number'];
    $email = $_POST['email'];

    //DB connection
  $conn = new mysqli('localhost','root','root','u817029086_Covac');
  if($conn -> connect_error){
    die('connection Failed :'.$conn->connect_error);
  }else{
    $hid = rand(2500,2502);
    $result = mysqli_query($conn,"SELECT * FROM hospital where Hid ='$hid'");
    $stmt = $conn->prepare("insert into benificary_details_1(Aadhaar_card_number, Benificary_name, Age, Gender,email_id,Hid) values(?,?,?,?,?,?)");
    $stmt->bind_param("issssi",$aadhaar_card,$benificary_name,$age,$gender,$email,$hid);
    $stmt->execute();
    
    //Transfering assigned hospital id to vaccine_status.php
    $_SESSION['hospital_id'] = $hid;
    if(mysqli_num_rows($result)>0){
      $row = $result->fetch_assoc();
      $hospitalname = $row['Hname'];
      $hloc = $row['Hlocation'];
    }

        $subject = "COVAC Vaccine Registration";
        $Message = "Dear ".$benificary_name ." your vaccine Registration is successfull. please vaccinated at ".$hospitalname. ", ".$hloc;
        $headers = "From: covac@csgowtham.tech";
        if(mail($email,$subject,$Message, $headers)){
         // echo "<script>alert('Sent successfully')</script>";
        }else{
          //echo "<script>alert('Not successfully')</script>";
        }
       

    $successmsg = '<div class="alert alert-success" role="alert"><strong>Successfull Registration</strong></div>';
    $stmt->close();
    $conn->close();
  }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/registration.css">
    

</head>
<body>

    <!--Menu Bar-->
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
                  <a class="nav-link text-white" href="../PHP/registration.php">Register <span class="sr-only">(current)</span></a>
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


         
           <!--form-->
           <div class="formcont">
            <!-- action="connect.php" -->
        <form  method="post">
            <h1 id = "title">COVAC VACCINE REGISTRATION</h1>
          <div id="error"><?php echo $error.$successmsg; ?></div>
          <div class="form-group row">
            
            <label for="inputEmail3" class="col-sm-2 col-form-label">Benificary Name</label>
            <div class="col-xs-4">
              <input type="text" class="form-control" id="inputEmail3" placeholder="Name" name="Name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Age</label>
            <div class="col-xs-4">
              <input type="text" class="form-control" id="inputPassword3" placeholder="Age" name="age" required>
            </div>
          </div>
          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="genderchk1" value="m" name="gender">
                  <label class="form-check-label" for="gridRadios1">
                    Male
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="genderchk" value="f" name="gender">
                  <label class="form-check-label" for="gridRadios2">
                    Female
                  </label>
                </div>
              </div>
            </div>
          </fieldset>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Email id</label>
            <div class="col-xs-4">
              <input type="text" class="form-control" id="uemail" placeholder="Enter Email id" name="email" required>
              <span id="error"></span>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Aadhaar Card number</label>
            <div class="col-xs-4">
              <input type="text" class="form-control" id="Aadhaar_card_num" placeholder="aadhaar card number" name="aadhaar_card_number" required>
              <span id="error"></span>
            </div>
</div>

            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Dose</label>
            <div class="col-xs-4">
            <select name="choose_dose" class="form-control">
                  <option>Choose Dose</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
            </select>
</div>
            </div>
           
           
          <div class="form-group">
            <div class="col-sm-10">
              <button type="submit" id="submit" class="btn btn-primary" name = "send">Register</button>
            </div>
          </div>
        </form>
      </div>

        </div>

        <!--Footer-->
      <div class="container-fluid footer">
        <div class="row f1">
          <div class="col">
            <table>
              <tr>
                <td> <h4>SUPPORT</h4></td>
              </tr>
              <tr>
                <td><p>Frequently asked Questions</p></td>
              </tr>
              <tr>
                <td><p>Certificate Correction</p></td>
              </tr>
            </table>
          </div>
            <div class="col">
              <table>
                <tr>
                  <td><h4>Contact US</h4></td>
                </tr>
                <tr>
                  <td><p>Helpline: +91-11-23978046(Toll Free-1075)</p></td>
                </tr>
                <tr>
                  <td><p>Technical Helpline:0120-4783222</p></td>
                </tr>
              </table>
            </div>
            </div>

        <div class="row f2">
              <div class="col">
                <table>
                  <tr>
                    <td> <h4>Child</h4></td>
                  </tr>
                  <tr>
                    <td><p>1098</p></td>
                  </tr>
                </table>
              </div>
              <div class="col">
                <table>
                  <tr>
                    <td><h4>Mental Health</h4></td>
                  </tr>
                  <tr>
                    <td><p>08046110007</p></td>
                  </tr>
                </table>
              </div>
              <div class="col">
                <table>
                  <tr>
                    <td><h4>Senior Citizens</h4></td>
                  </tr>
                  <tr>
                    <td><p>14567</p></td>
                  </tr>
                </table>
              </div>
              <div class="col">
                <table>
                  <tr>
                    <td><h4>NCW</h4></td>
                  </tr>
                  <tr>
                    <td><p>7827170170</p></td>
                  </tr>
                </table>
               </div>
              </div>
        <div class="row f3">
          <div class="col">
            <p>Copyright  &copy; 2022 COVAC. All Rights Reserved</p>
          </div>
        </div>    
        </div>
      </div>    


       
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
    .footer{
        background-color: #007C7C;
        color: white;
        text-align: center;
        padding-top: 25px;
        margin-top:30px;
        
        }
        #title{
            color: #007C7C;
        }
        .f1{
            padding-left: 200px;

        }

        .f2{
            margin-top: 25px;
            padding-left: 200px;
        }

        .f3{
            background-color: #015158;
        }
        .getbtn{
          margin-left:25px;
          margin-top:30px;
        }
    </style>
</body>
</html>


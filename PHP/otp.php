<?php 
session_start();
$er = "";
$error = "";
if(isset($_POST["otp"])){
  $toemail = $_SESSION["toemail"];
  $otpu = $_POST["otp"];

  if($_POST["otp"] == ""){
    $er .= "Enter OTP";
  }else{
    $conn =  mysqli_connect('localhost','root','root','u817029086_Covac');
   if(!$conn){
        echo "Error " . mysqli_connect_error();
    }else{
      $res = mysqli_query($conn, "SELECT * FROM otp_verification WHERE Email = '$toemail' AND otp = '$otpu'");
      $count  = mysqli_num_rows($res);
      if($count >0){
        header("Location : https://csgowtham.tech/New%20Project/PHP/covac_vaccine_certificate.php");
      }else{
        $er .= "Not a valid otp";
      } 

    }

  }
}
  

if($er != ""){
  $error = '<div class="alert alert-danger" role="alert">'.$er.'</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/otp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>

<div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light  nb">
            <a class="navbar-brand text-white" href="../Html/index.html">COVAC</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link text-white" href="../Html/index.html">Home </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/registration.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/contact-us.php">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/covac_portal.php">COVAC Portal</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/download_certificate.php">Download Certificate <span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
          </nav>
</div>
     <div class="card c1">
        <center>
          <div class="otp-container">
          <form method = "post" class="otp-form">
            <div class="form-group">
              <label for="exampleInputEmail1"><strong>Enter OTP Sent to your Email address</strong></label>
              <br>
              <br>
              <div class="col-xs-4">
                <input type="number" class="form-control" id="otp" name ="otp" aria-describedby="emailHelp" placeholder="Enter OTP">
              </div>
              
            </div>
            <?php echo $error; ?>
              <button type="submit" class="btn btn-primary email-submit">Submit OTP</button>
          </form>
      </div>
        </center>
        </div>

        <?php include("footer.php") ?>
        <script href="../Javascript/otp_verification.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</body>
</html>
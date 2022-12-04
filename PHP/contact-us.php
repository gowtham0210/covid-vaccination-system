<?php
session_start();
$show = "";
 if(isset($_POST['send_msg'])){
  $name = $_POST['Name'];
  $email_id = $_POST['email'];
  $uquery  = $_POST['uquery'];
  $to = "admin@csgowtham.tech";
  $subject = "user Query";
  $headers = "From: covac@csgowtham.tech";
  if(mail($to,$subject,$uquery,$headers)){
    $show = "<div class='alert alert-success' role='alert'>
    Your message is sent Succefully
  </div>";
  }else{
    $show = "<div class='alert alert-danger' role='alert'>
    Your message is not sent 
  </div>";
  }
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
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
</div>

        <div class="container-fluid">
          <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
                <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly.</p>
                <form method="post">
                   <div class = "form-group">
                    <?php echo $show; ?>
                   </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="Name" class="form-control" autocomplete="off" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label>Email id</label>
                            <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Enter Email id">
                        </div>
                        <div class="form-group">
                            <label>Tell your Query</label>
                            <textarea type="text" name="uquery" class="form-control"></textarea>
                        </div>
                        <input type="submit" name="send_msg" class="btn btn-success" value="Send Message"> 
              
              </div>
                <div class="col-md-3"></div>
            </div>
          </div>
        </div>   
      
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
<style>
    .nb{
    background-color: #007C7C;   
}
</style>
</body>
</html>
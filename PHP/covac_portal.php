<?php 
$servername = 'localhost';
$database = 'u817029086_Covac';
$username = 'root';
$password = 'root';
session_start();
 $error = "";
 $successmsg = "";
   if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($error != ""){
        $error = '<div class="alert alert-danger" role="alert"><strong>Missing Details <br></strong>'.$error.'</div>';

    }else{
        //$conn = mysqli_connect($servername,$username,$password,$database);
        $conn =  mysqli_connect('localhost','root','root','u817029086_Covac');

    if(!$conn){
        die("Failed to connect :".mysqli_connect_error());
    }else{
        $stmt = $conn->prepare("select * from covac_portal_login where email_id= ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            $hid = $data['Hid'];
           
            if($data['password'] === $password){
                $successmsg = '<div class="alert alert-success" role="alert"><strong>Successfull Login</strong></div>';  
                //Transferring login hospital id to vaccine_status.php
                $_SESSION['Hid'] = $hid;
                header("Location: ./vaccine_status.php");
            }else{
                $error .= "Invalid Email or password. <br>";   
            }
        }else{
            $error .= "Invalid Email or password. <br>";      
        }
    }
    }
   }// else{
  //   $error .= "Invalid Email or password. <br>";
  //  }

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/covac_portal.css">
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
                  <a class="nav-link text-white" href="../PHP/registration.php">Register </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/contact-us.php">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/covac_portal.php">COVAC Portal <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="../PHP/download_certificate.php">Download Certificate</a>
                </li>
              </ul>
            </div>
        </nav>
    </div>


          <div class="container">
            <div class="row">
                <div class="col">
                <img src = "../images/covac_portal_main_page_img.jpg" width="500" height="500">
                </div>
                <div class="col">
                <form method = "POST" action="#">
                    <div class="header_portal">
                    <h1>COVAC PORTAL LOGIN</h1>
                    </div>
                    <div class="sec2">
                    <div id="error"><?php echo $error.$successmsg; ?></div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email id</label>
                        <input type="email" class="form-control" name = "email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email id">
        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name = "password" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>

                </div>
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
   

</body>
</html>
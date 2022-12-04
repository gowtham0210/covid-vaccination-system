<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
     session_start();
     $toemail = $_SESSION["toemail"];
     $aadhaar_substr = "";
     $Hid = "";
    ob_start();
   
    require("../Fpdf/fpdf.php");
    $pdf = new FPDF('p','mm','A4');
    $pdf->AddPage();
    //               image-path & name      X  Y  W  H
    $pdf->Image('../images/india_logo.png',90,10,20,20,'PNG',0,1);
    $pdf->SetFont('Arial','B',13);
    
    $conn =  mysqli_connect('localhost','u817029086_covac','Covac@2022','u817029086_Covac');
    $res = mysqli_query($conn, "SELECT * FROM benificary_details_1  WHERE email_id = '$toemail'");
    if(!$conn){
       echo "Error " . mysqli_connect_error();
    }
    $count = mysqli_num_rows($res);
    if($count>0){
        $row = $res->fetch_assoc();
        //Retrieve Name
        $pdf->SetXY(100,85);
        $pdf->Write(0,$row["Benificary_name"]);
        //Retrieve Age
        $pdf->SetXY(100,95);
        $pdf->Write(0,$row["Age"]);

        $aadhaar_substr = $row["Aadhaar_card_number"];
        $pdf->SetXY(100,105);
        $pdf->Write(0,substr($aadhaar_substr,0,4)." xxxx xxxx");

        $pdf->SetXY(100,115);
        $pdf->Write(0,strtoupper($row["Gender"]));
        
     }else{
        echo "No Rows";

     }

     $vaccine_retrieve = mysqli_query($conn,"SELECT * FROM vaccine_status where Aadhaar_card_number = '$aadhaar_substr'");
     $count1 = mysqli_num_rows($vaccine_retrieve);
     if($count1 >0){
        $row2 = $vaccine_retrieve->fetch_assoc();

        $pdf->SetXY(100,145);
        $pdf->Write(0,$row2["vaccine_name"]);

        if($row2["Dose"] == 1)
        {
            $pdf->SetXY(100,175);
            $pdf->Write(0,"Partial Vaccination (1/2)");

        }else{
            $pdf->SetXY(100,175);
            $pdf->Write(0,"Full Vaccination (2/2)");
        }

        $pdf->SetXY(100,185);
        $pdf->Write(0,$row2["Time"]);

        $Hid = $row2["Hid"];
     }

     $Location_Retrieve = mysqli_query($conn, "SELECT * FROM hospital WHERE Hid = '$Hid'");
     $count2 = mysqli_num_rows($Location_Retrieve);
     if($count2 >0){
        $row3 = $Location_Retrieve->fetch_assoc();
        $pdf->SetXY(100,195);
        $pdf->Write(0,$row3["Hname"]. $row3["Hlocation"]);
     }


    $pdf->SetXY(62,33);
    $pdf->Write(0,"Ministry of Health & Family Welfare");
    $pdf->SetXY(75,40);
    $pdf->Write(0,"Government of India");

    $pdf->SetFont('Arial','',22);
    $pdf->SetTextColor(17,85,204);
    $pdf->SetXY(45,50);
    $pdf->Write(0,"Certificate for COVID-19 Vaccination");

    $pdf->SetFont('Arial','',12);
    $pdf->SetTextColor(17,85,204);
    $pdf->SetXY(45,60);
    $pdf->Write(0,"issued in india by Ministry of Health & Family Welfare, Govt of India");

    $pdf->SetFont('Arial','U',16);
    $pdf->SetTextColor(17,85,204);
    $pdf->SetXY(20,75);
    $pdf->Write(0,"Beneficiary Details");

    $pdf->SetFont('Arial','',14);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(20,85);
    $pdf->Write(0,"Beneficiary Name:");
    

    $pdf->SetXY(20,95);
    $pdf->Write(0,"Beneficiary Age:");

    $pdf->SetXY(20,105);
    $pdf->Write(0,"Aadhaar Card Number:");
   

    $pdf->SetXY(20,115);
    $pdf->Write(0,"Gender:");
    

    $pdf->SetFont('Arial','U',16);
    $pdf->SetTextColor(17,85,204);
    $pdf->SetXY(20,135);
    $pdf->Write(0,"Vaccine Details");

    $pdf->SetFont('Arial','',12);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(20,145);
    $pdf->Write(0,"Vaccine Name:");
    

    $pdf->SetFont('Arial','',12);
    $pdf->SetXY(20,155);
    $pdf->Write(0,"Vaccine Type:");
    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(100,155);
    $pdf->Write(0,"COVID-19 Vaccine, non replicating viral vector");

    $pdf->SetFont('Arial','',12);
    $pdf->SetXY(20,165);
    $pdf->Write(0,"Manufacture:");
    $pdf->SetFont('Arial','B',12);
    $pdf->SetXY(100,165);
    $pdf->Write(0,"Serum Institute of India Pvt, Ltd");

    $pdf->SetXY(20,175);
    $pdf->Write(0,"Dose Number:");
   

    $pdf->SetXY(20,185);
    $pdf->Write(0,"Date :");
    

    $pdf->SetXY(20,195);
    $pdf->Write(0,"Vaccinted At:");
   









    $pdf->Output();
    ob_end_flush();
    
    
    ?>
    <script>
        var session = eval('(<?php echo json_encode($_SESSION) ?>)');
        console.log(session);
        
     </script>
</body>
</html>
<? php
ini_set('display_erros',1);
error_reporting(E_ALL);

$from = "covac@csgowtham.tech";
$to = "gowtham@csgowtham.tech";

$subject = "PHP mail sending ";
$Message = "MAil sending ";
$headers = "From:" . $from;

mail($to,$subject,$Message, $headers)
    echo "mail sent succeffully";
?>

<h1>Hello world</h1>
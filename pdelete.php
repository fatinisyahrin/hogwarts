<?php

if (isset($_GET['id'])) {
$assid = $_GET['id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


$sql = "DELETE FROM assessment WHERE id = $assid";

if ($conn->query($sql) === TRUE) {
    header('location: pmanage.php') ;
} 
$conn->close();

  
}

?>


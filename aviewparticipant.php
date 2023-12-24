<?php 

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
}

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

?>
<html>
<head>
  <html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <meta http-equiv="X-UA-Compayible" content="IE-edge">
  <title>Admin | Hogwarts</title>
</head>
<style>
   /* width */
::-webkit-scrollbar {
    width: 20px;
  }
  
  /* Track */
  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey; 
    border-radius: 10px;
  }
   
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background:  #366447; 
    border-radius: 10px;
  }
  
  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #a6332e; 
  }
  
  
 /* Navigation */
  #mySidenav a {
  position: absolute;
  left: -5px;
  transition: 0.2s;
  padding: 15px;
  width: 160px;
  text-decoration: none;
  font-size: 13px;
  color: white;
  border-radius: 0 5px 5px 0;
}

#mySidenav a:hover {
  left: 0;
}

#home {
  top: 135px;
  background-color: #d4a82e;
}

#aviewparticipant {
  top: 195px;
  background-color: #366447;
}

#aviewjudge {
  top: 255px;
  background-color: #3c4e91;
}

#manage {
  top: 315px;
  background-color: #a6332e;
}

#logout {
  top: 375px;
  background-color: #d4a82e;
}


body{   
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13;
    background: linear-gradient(white, lightgrey, #366447);
    } 

#frm{  
    border: solid #366447 4px;
    width:30%;  
    border-radius: 25px;  
    margin: 23px auto;  
    padding-left: 30px;
    padding-right: 13px;
    position: relative;
}  

.center {
display: block;
margin-left: auto;
margin-right: auto;
width: 80%;
padding-right: 27px;
}

#image {
      color:#e4d19b;
      margin-top: 16px;
      margin-right: 6px;
      text-align: center;
  }

  #title {
      color: #e4dde4;
      margin-right: 50px;
  }


/* Center website */
.main {
  max-width: 1000px;
  margin: auto;
}

h1 {
  font-size: 50px;
  word-break: break-all;
}

#myBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: #555;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 4px;
}

.roundsg {
        background-color: #366447; 
        border: 2px solid;
        border-radius: 12px; 
        color: white;
        padding: 15px 22px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        outline: none;
        box-shadow: 4px 4px #efbc2f;
    }
    
    .roundsg:active {
      background-color: #3c4e91;
      box-shadow: 4px 4px #a6332e;
      transform: translateY(4px);
    }

    tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="image/hogwartslogo.png" alt="hogwartslogo" style="width:100px" height="60px" class="rounded-pill" position="fixed">
      </a>
      <div id ="title">
      <h5><b>e-Marking System</b></h5>
      </div>
        <div id ="image">
          <img src="image/admin.png" alt="adminimage" style="width:50px;" class="rounded-pill">
          <p>Admin</p>
      </div> 
    </div>
  </nav>

<div id="mySidenav" class="sidenav">
  <a href="admin.php" id="home" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Home</a>
  <a href="aviewparticipant.php" id="aviewparticipant" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Participants</a>
  <a href="aviewjudge.php" id="aviewjudge" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Judges</a>
  <a href="aviewass.php" id="manage" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Manage</a>
  <a href="login.php" id="logout" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Logout</a>
</div>


<!-- MAIN (Center website) -->
<div class="main">
<div id="grad1"></div>
  <br>
  <style>
  table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 10px;
      text-align: center;
    }
</style>
<center><h2>List of Participants</h2></center><br>
<table style="width:100%">
  <tr>
    <th>ID</th>
    <th>Email</th>
    <th>Username</th>
    <th>Role</th>
  </tr>
  
<?php
$sql = "SELECT id, email, username, role FROM user where role='participant'";
$result = mysqli_query($conn,  $sql);

if (mysqli_num_rows($result) > 0) {
    while ($user = mysqli_fetch_assoc($result)) {  
        ?>
        <tr>
            <td><p><?=$user['id']?></p></td>
            <td><p><?=$user['email']?></p></td>
            <td><p><?=$user['username']?></p></td>
            <td><p><?=$user['role']?></p></td>
        </tr>
    <?php 
    } 
} else { 
    ?>
    <p class="text">0 result</p>
    <?php 
}
$conn->close();
?>
</table>



</div>
</body>
</html>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include "footer.php"; ?>

  <!-- Scroll Up -->
  <button onclick="topFunction()" id="myBtn" title="Go to top">^</button>
    <script>
  
  //Get the button
  var mybutton = document.getElementById("myBtn");
  
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};
  
  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }
  
  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }

  </script>
  



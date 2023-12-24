<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['judge_name'])) {
    header('location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $assid = $_GET['id'];

    // Retrieve the product data from the database
    $query = "SELECT * FROM assessment WHERE id = '$assid'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header('location: aviewass.php');
        exit();
    }
} else {
    header('location: aviewass.php');
    exit();
}

if (isset($_POST['submit'])) {
    $a1 = isset($_POST['innovativeness']) ? intval($_POST['innovativeness']) : 0;
    $a2 = isset($_POST['theme']) ? intval($_POST['theme']) : 0;
    $a3 = isset($_POST['practicality']) ? intval($_POST['practicality']) : 0;
    $a4 = isset($_POST['designeasthetics']) ? intval($_POST['designeasthetics']) : 0;
    $a5 = isset($_POST['creativity']) ? intval($_POST['creativity']) : 0;
    $a6 = isset($_POST['scalability']) ? intval($_POST['scalability']) : 0;
    $a7 = isset($_POST['feasibility']) ? intval($_POST['feasibility']) : 0;
    $a8 = isset($_POST['socialimpact']) ? intval($_POST['socialimpact']) : 0;
    $a9 = isset($_POST['sustainability']) ? intval($_POST['sustainability']) : 0;
    $a10 = isset($_POST['originality']) ? intval($_POST['originality']) : 0;

    // Calculate total marks
    $total_marks = $a1 + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10;

    $query = "UPDATE assessment SET marks = '$total_marks' WHERE id = '$assid'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('location: jviewass.php');
        exit();
    } else {
        echo "Error updating marks: " . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html>
<head>
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
  <title>Marking | Hogwarts</title>
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

#assessment {
  top: 195px;
  background-color: #366447;
}

#logout {
  top: 255px;
  background-color: #3c4e91;
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

 /* label for role*/
 label {
      display: inline-block;
      width: 160px;
      text-align: left;
      }
    
label[for=faculty], [for=gryffindor], label[for=hufflepuff], label[for=ravenclaw], label[for=slytherin]
      {
      text-align: left;
      width: 60px;
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
              <img src="image/judge.png" alt="participantimage" style="width:50px;" class="rounded-pill">
              <p>Judge</p>
          </div> 
        </div>
      </nav>

<div id="mySidenav" class="sidenav">
  <a href="judge.php" id="home" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Home</a>
  <a href="jviewass.php" id="assessment" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Assessment</a>
  <a href="login.php" id="logout" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Logout</a>
</div>


      <!-- MAIN (Center website) -->
<div class="main">
<div id="grad1"></div>
  <br>
<body>
  <center><h2>Marking: Innovation Design Competition</h2></center>
  <br>
  <form action="" method="post">
<style>
  table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 10px;
      margin-left: 25%;
      text-align: center;
    }
</style>
    <table>
      <tr>
        <th>Criteria</th>
        <th>1 (Strongly disagree)</th>
        <th>2 (Disagree)</th>
        <th>3 (Neutral)</th>
        <th>4 (Agree)</th>
        <th>5 (Strongly agree)</th>
      </tr>
      <tr>
        <td>Innovativeness</td>
        <td><input type="radio" name="innovativeness" id="a1" value="1"></td>
        <td><input type="radio" name="innovativeness" id="a1" value="2"></td>
        <td><input type="radio" name="innovativeness" id="a1" value="3"></td>
        <td><input type="radio" name="innovativeness" id="a1" value="4"></td>
        <td><input type="radio" name="innovativeness" id="a1" value="5"></td>
      </tr>
      <tr>
        <td>Align with Theme</td>
        <td><input type="radio" name="theme" id="a2" value="1"></td>
        <td><input type="radio" name="theme" id="a2" value="2"></td>
        <td><input type="radio" name="theme" id="a2" value="3"></td>
        <td><input type="radio" name="theme" id="a2" value="4"></td>
        <td><input type="radio" name="theme" id="a2" value="5"></td>
      </tr>
      <tr>
        <td>Practicality</td>
        <td><input type="radio" name="practicality" id="a3" value="1"></td>
        <td><input type="radio" name="practicality" id="a3" value="2"></td>
        <td><input type="radio" name="practicality" id="a3" value="3"></td>
        <td><input type="radio" name="practicality" id="a3" value="4"></td>
        <td><input type="radio" name="practicality" id="a3" value="5"></td>
      </tr>
      <tr>
        <td>Design Aesthetics</td>
        <td><input type="radio" name="designeasthetics" id="a4" value="1"></td>
        <td><input type="radio" name="designeasthetics" id="a4" value="2"></td>
        <td><input type="radio" name="designeasthetics" id="a4" value="3"></td>
        <td><input type="radio" name="designeasthetics" id="a4" value="4"></td>
        <td><input type="radio" name="designeasthetics" id="a4" value="5"></td>
      </tr>
      <tr>
        <td>Creativity</td>
        <td><input type="radio" name="creativity" id="a5" value="1"></td>
        <td><input type="radio" name="creativity" id="a5" value="2"></td>
        <td><input type="radio" name="creativity" id="a5" value="3"></td>
        <td><input type="radio" name="creativity" id="a5" value="4"></td>
        <td><input type="radio" name="creativity" id="a5" value="5"></td>
      </tr>
      <tr>
        <td>Scalability</td>
        <td><input type="radio" name="scalability" id="a6" value="1"></td>
        <td><input type="radio" name="scalability" id="a6" value="2"></td>
        <td><input type="radio" name="scalability" id="a6" value="3"></td>
        <td><input type="radio" name="scalability" id="a6" value="4"></td>
        <td><input type="radio" name="scalability" id="a6" value="5"></td>
      </tr>
      <tr>
        <td>Feasibility</td>
        <td><input type="radio" name="feasibility" id="a7" value="1"></td>
        <td><input type="radio" name="feasibility" id="a7" value="2"></td>
        <td><input type="radio" name="feasibility" id="a7" value="3"></td>
        <td><input type="radio" name="feasibility" id="a7" value="4"></td>
        <td><input type="radio" name="feasibility" id="a7" value="5"></td>
      </tr>
      <tr>
        <td>Social Impact</td>
        <td><input type="radio" name="socialimpact" id="a8" value="1"></td>
        <td><input type="radio" name="socialimpact" id="a8" value="2"></td>
        <td><input type="radio" name="socialimpact" id="a8" value="3"></td>
        <td><input type="radio" name="socialimpact" id="a8" value="4"></td>
        <td><input type="radio" name="socialimpact" id="a8" value="5"></td>
      </tr>
      <tr>
        <td>Sustainability</td>
        <td><input type="radio" name="sustainability" id="a9" value="1"></td>
        <td><input type="radio" name="sustainability" id="a9" value="2"></td>
        <td><input type="radio" name="sustainability" id="a9" value="3"></td>
        <td><input type="radio" name="sustainability" id="a9" value="4"></td>
        <td><input type="radio" name="sustainability" id="a9" value="5"></td>
      </tr>
      <tr>
        <td>Originality</td>
        <td><input type="radio" name="originality" id="a10" value="1"></td>
        <td><input type="radio" name="originality" id="a10" value="2"></td>
        <td><input type="radio" name="originality" id="a10" value="3"></td>
        <td><input type="radio" name="originality" id="a10" value="4"></td>
        <td><input type="radio" name="originality" id="a10" value="5"></td>
      </tr>

    </table>
    <br>
    <center><input type="submit" value="Submit" name="submit"></center>
    <br>
  </form>
  </div>
</body>
</html>


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
  
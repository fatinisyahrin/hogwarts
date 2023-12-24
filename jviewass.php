<?php
session_start();
include 'config.php';

if (!isset($_SESSION['judge_name'])) {
    header('location: login.php');
    exit();
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
  <title>Judge | Hogwarts</title>
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


/* Center website */
.main {
  max-width: 1000px;
  margin: auto;
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
          <img src="image/judge.png" alt="judgeimage" style="width:50px;" class="rounded-pill">
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
  <form action="" method="post">
<style>
  table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 10px;
      margin-left: 3%;
      text-align: center;
    }
</style>
<table class="table">
<thead>
<tr>
  <th>ID</th>
  <th>Full Name</th>
  <th>Faculty</th>
  <th>File</th>
  <th>Action</th>
</tr>
</thead>
<tbody>
<?php
@include 'config.php';
$judgeid = $_SESSION['judge_name'];
$query = "SELECT * FROM assessment WHERE judge = '$judgeid'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $assid = $row['id'];
        $fullname = $row['fullname'];
        $faculty = $row['faculty'];
        ?>
        <tr>
            <td><?php echo $assid; ?></td>
            <td><?php echo $fullname; ?></td>
            <td><?php echo $faculty; ?></td>
            <td><a href="file/<?= $row['file'] ?>" download>Download</a></td>
            <td>
                <a href="jmarks.php?id=<?= $row['id'] ?>">Mark Project</a>
            </td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='6'>No projects assigned to you.</td></tr>";
}
?>
</tbody>
</table>
</div>
</body>
</html>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
  
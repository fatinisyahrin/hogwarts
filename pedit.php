<?php
// Start the session before any output or session-related operations
session_start();

// Include the connection file here, as it's required for database operations
@include 'config.php';

if (isset($_POST['submit'])) {
    if (!isset($_SESSION['participant_name'])) {
        header('location: login.php');
        exit();
    }

    $participantid = $_SESSION['participant_name'];

    // Check if the assessment ID is provided in the URL
    if (isset($_GET['id'])) {
        $assid = $_GET['id'];

        // Retrieve the assessment data from the database
        $query = "SELECT * FROM assessment WHERE id = '$assid'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $assessment = mysqli_fetch_assoc($result);
        } else {
            header('location: pmanage.php');
            exit();
        }

        // Update the "fullname" field in the assessment
        $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
        $query = "UPDATE assessment SET fullname = '$fullname' WHERE id = '$assid'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "Database update failed for fullname: " . mysqli_error($conn);
        }

        // Handle file upload if a new file is provided
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = "uploads/";
            $file_name = $_FILES['file']['name'];
            $file_tmp = $_FILES['file']['tmp_name'];

            // Remove the old file if it exists
            if (!empty($assessment['file_path']) && file_exists($assessment['file_path'])) {
                unlink($assessment['file_path']);
            }

            // Move the uploaded file to the specified directory
            $new_file_name = uniqid('file_', true) . '_' . $file_name;
            $upload_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Update the database with the new file path
                $query = "UPDATE assessment SET file_path = '$upload_path' WHERE id = '$assid'";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    echo "Database update failed for file path: " . mysqli_error($conn);
                }
            } else {
                echo "Error uploading file.";
            }
        }

        header('location: pmanage.php'); // Redirect only once after all updates
        exit();
    } else {
        header('location: pmanage.php');
        exit();
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
  <title>Edit Assessment | Hogwarts</title>
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

#faculties {
  top: 195px;
  background-color: #366447;
}

#assessment {
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
    
    </style>
</style>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="image/hogwartslogo.png" alt="hogwartslogo" style="width:100px" height="60px" class="rounded-pill" position="fixed">
          </a>
          <div id ="title">
          <h5><b>Welcome to Hogwarts</b></h5>
          </div>
            <div id ="image">
              <img src="image/participant.jpg" alt="participantimage" style="width:50px;" class="rounded-pill">
              <p>Participant</p>
          </div> 
        </div>
      </nav>
<div id="mySidenav" class="sidenav">
  <a href="participant.php" id="home" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Home</a>
  <a href="faculties.php" id="faculties" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Faculties</a>
  <a href="passm.php" id="assessment" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Assessment</a>
  <a href="pmanage.php" id="manage" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Manage</a>
  <a href="login.php" id="logout" style="font-family: 'Montserrat', Arial, sans-serif; font-size: 13px;">Logout</a>
</div>

      <div id="frm"> 
      <div id="grad1"></div>
        <img src="image/4.png" alt="hogwartslogo" width="200" height="200" class="center">
        <br>
        <center><b>Edit: Innovation Design Competition</b></center>
        <form method="post" enctype="multipart/form-data">
        <?php 
        @include 'config.php';
        if (isset($_GET['id'])) {
          $assid = $_GET['id'];
          $query = "SELECT * FROM assessment WHERE id = '$assid'";
          $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
              $assessment = mysqli_fetch_assoc($result);
              } else {
              header('location: pmanage.php');
              exit();
            } } 
            ?>
              <br>
              <label for="fullname" class="label">Full Name:</label>
              <input type="text" name="fullname" id="fullname" value="<?=$assessment['fullname']?>">
              <br><br>
              <label for="file">Upload File:</label>
            <br>
            <br>
            <input type="file" name="file" id="file">
            <br>
            <br>
              <input class="button" type="submit" name="submit" value="Submit"><br><br>
            </form>          
      </div>     
</body>

</html>
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
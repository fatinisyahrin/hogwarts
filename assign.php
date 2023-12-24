<?php
session_start();
@include 'config.php';
if (isset($_GET['id'])) {
    $assid = $_GET['id'];
    $query = "SELECT * FROM assessment WHERE id = '$assid'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $assessment = mysqli_fetch_assoc($result);
        // Form processing logic here
        if (isset($_POST['submit'])) {
            $judge = $_POST['judge'];
            $query = "UPDATE assessment SET judge = '$judge' WHERE id = '$assid'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                header('location: aviewass.php');
                exit();
            } else {
                echo "Error updating judge.";
            }
        }
    } else {
        header('location: aviewass.php');
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
  <title>Assign Judge | Hogwarts</title>
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

      <br><br><br><br>
      <div id="frm"> 
      <div id="grad1"></div>
        <form method="post" enctype="multipart/form-data">
        <?php
        @include 'config.php';
          if (isset($_GET['id'])) {
            $assid = $_GET['id'];
            $query = "SELECT * FROM assessment WHERE id = '$assid'";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
              $assessment = mysqli_fetch_assoc($result);
              // Form processing logic here
              if (isset($_POST['submit'])) {
                  $judge = $_POST['judge'];
                  $query = "UPDATE assessment SET judge = '$judge' WHERE id = '$assid'";
                  $result = mysqli_query($conn, $query);

                  if ($result) {
                    header('location: aviewass.php');
                      exit();
                    } else {
                      echo "Error updating judge.";
                    }
                      }
                    } else {
                      header('location: aviewass.php');
                        exit();
                      }
                    }
                    ?>
                        <form method="post" action="" enctype="multipart/form-data"><br>
                        <center><h2>Assign Judge</h2></center>
                            <br>
                            <label for="judge" class="label">Enter Judge Name</label>
                            <input type="text" name="judge" id="judge">
                            <br><br>
                            <input class="button" type="submit" name="submit" value="Submit"><br><br>
                        </form>
                  </div>                      
</body>
</html>
<br><br><br><br><br><br><br>
<?php include "footer.php"; ?>

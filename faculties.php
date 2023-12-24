<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['participant_name'])){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <meta http-equiv="X-UA-Compayible" content="IE-edge">
  <title>Faculties | Hogwarts</title>
  </head>
  <body style="background: linear-gradient(white, lightgrey, #366447);">

  <nav class="navbar navbar-expand-sm bg-dark navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="image/hogwartslogo.png" alt="hogwartslogo" style="width:100px" height="60px" class="rounded-pill" position="fixed"></a>
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


  <br>
  <br>
 
  <!-- The Gryffindor Section -->
  <div class="container" style="background-color:#a6332e">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>Gryffindor Faculty</b></h1>
        <h1 class="small-font" style="color:rgb(210, 199, 199)"><i>by Godric Gryffindor</i></h1>
        <p><span style="font-size:24px">Symbol: Lion</span><br>
        The Faculty of Gryffindor adopts a courageous crimson, symbolizing their dedication<br> 
        to nurturing bravery, daring feats, and unwavering chivalry among their students.</p>
      </div>
      <div class="column-33">
        <img src="image/image1.jpg" alt="Gryffindor Logo" width="335" height="471">
      </div>
    </div>
  </div>

  <!-- The Hufflepuff Section -->
  <div class="container" style="background-color:#efbc2f">
    <div class="row">
      <div class="column-33">
        <img src="image/image2.jpg" alt="Hufflepuff Logo" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>Hufflepuff Faculty</b></h1>
        <h1 class="small-font" style="color:rgb(150, 144, 144)"><i>by Helga Hufflepuff</i></h1>
        <p><span style="font-size:24px">Symbol: Eagle</span><br>
        The Faculty of Hufflepuff is characterized by the warm and golden yellow, emphasizing 
        the importance of hard work, loyalty, and fostering a supportive and inclusive community.</p>
      </div>
    </div>
  </div>

  <!-- The Ravenclaw Section -->
  <div class="container" style="background-color:#3c4e91f1">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>Ravenclaw Faculty</b></h1>
        <h1 class="small-font" style="color:rgb(210, 199, 199)"><i>by Rowena Ravenclaw</i></h1>
        <p><span style="font-size:24px">Symbol: Badger</span><br>
        The Faculty of Ravenclaw serene sapphire blue embodies a commitment to 
        cultivating intellect, wisdom, and creativity, encouraging a quest for knowledge and understanding. </p>
      </div>
      <div class="column-33">
        <img src="image/image3.jpg" alt="Ravenclaw Logo" width="335" height="471">
      </div>
    </div>
  </div>

  <!-- The Slytherin Section -->
  <div class="container" style="background-color:#366447">
    <div class="row">
      <div class="column-33">
        <img src="image/image4.jpg" alt="Slytherin Logo" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>Slytherin Faculty</b></h1>
        <h1 class="small-font" style="color:rgb(210, 199, 199)"><i>by Salazar Slytherin</i></h1>
        <p><span style="font-size:24px">Symbol: Serpent</span><br>
        The Faculty of Slytherin takes on the enigmatic emerald green, signifying their 
        dedication to ambition, resourcefulness, and honing the talents of future leaders. </p>
      </div>
    </div>
  </div>
</body>
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

  
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}


</script>


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


.body {
  background: linear-gradient(white, lightgrey, #366447);
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
  
.container {
  padding: 64px;
  max-width: 75%;
}

.row:after {
  content: "";
  display: table;
  clear: both
}

.column-66 {
  float: left;
  width: 66.66666%;
  padding: 20px;
}

.column-33 {
  float: left;
  width: 33.33333%;
  padding: 20px;
}

.large-font {
  font-size: 48px;
}

.xlarge-font {
  font-size: 64px
}

img {
  height: auto;
  max-width: 100%;
}

@media screen and (max-width: 1000px) {
  .column-66,
  .column-33 {
    width: 100%;
    text-align: center;
  }
  img {
    margin: auto;
  }
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

</body>
</html>
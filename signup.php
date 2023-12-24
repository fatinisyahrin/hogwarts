<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rpassword']) && isset($_POST['role'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        $role = $_POST['role'];

        if ($password == $rpassword) {
            // Hash password only after ensuring it matches with repeated password
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $password_hashed, $role);

            if (mysqli_stmt_execute($stmt)) {
                echo "User registered successfully!";
                echo "<script type=\"text/javascript\">
                window.setTimeout(function() {
                    window.location.href=\"login.php\";
                }, 1000);
              </script>";
            } else {
                echo "Error registering user.";  // Remove system error display
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo "Passwords do not match. Please try again.";
        }
    } else {
        echo "Please fill in all the required fields.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <meta http-equiv="X-UA-Compayible" content="IE-edge">
    <link rel="stylesheet" href="style.css">
    <title>Hogwarts</title>
</head>

<body>
    <section class="showcase">
        <video src="hero.mp4"muted loop autoplay></video>
    <div id = "frm"> 
    <br>
    <br>
        <form action="signup.php" method="post">
        <img src="image/hogwartslogo.png" alt="hogwartslogo" width="200" height="200" class="center">
    <br>
    <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <br>
        <label for="username">Username:</label>
        <input type="username" name="username" required> 
        <br>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required> 
        <br>
        <br>
        <label for="rpassword">Repeat Password:</label>
        <input type="password" name="rpassword" required>
        <br>
        <br>
<!-- ... -->
<label for="role">Role:</label>
        <input type="radio" id="judge" name="role" value="Judge" required>
        <label for="judge">Judge</label>
        <input type="radio" id="admin" name="role" value="Admin" required>
        <label for="admin">Admin</label>
        <input type="radio" id="participant" name="role" value="Participant" required>
        <label for="participant">Participant</label>
<!-- ... -->

        <br>
        <br>
        <input type="submit" name="submit" value="Sign Up" p class="roundsg">
        <br>
        <br>
        <p> Already a member? <a href="login.php" div id="login">Log in</a></p></div>
      </form>
</section>
</body>
</html>




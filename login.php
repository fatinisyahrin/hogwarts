<?php
session_start();
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT username, password, role FROM user WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $username);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $username = $row['username'];
            $hashed_password = $row['password'];
            $role = $row['role'];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                if ($role === 'Participant') {
                    $_SESSION['participant_name'] = $username;
                    header("Location: participant.php");
                } elseif ($role === 'Judge') {
                    $_SESSION['judge_name'] = $username;
                    header("Location: judge.php");
                } elseif ($role === 'Admin') {
                    $_SESSION['admin_name'] = $username;
                    header("Location: admin.php");
                }
                exit();
            } else {
                echo "Invalid Password";
            }
        } else {
            echo "Invalid Username";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
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
    <form action="login.php" method="post">
        <img src="image/hogwartslogo.png" alt="hogwartslogo" width="200" height="200" class="center">
        <br>
        <br>
<!-- ... -->
<label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required> 
        <br>
        <br>
<!-- ... -->
        <input type="submit" name="submit" value="Log In" p class="roundsg">
        <br>
        <br>
        <p> First time user? <a href="signup.php" div id="signup">Sign up</a></p></div>
      </form>
</section>
</body>
</html>


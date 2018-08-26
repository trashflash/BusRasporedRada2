<?php
include_once ('db_config.php'); ?>



<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="w3css.css">
</head>
<body>
<?php

@session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con,$username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con,$password);
    //Checking is user existing in the database or not
    $query = "SELECT username, password FROM `admins` WHERE username='$username'
and password='".md5($password)."'";
    $result = mysqli_query($connection,$query) or die(mysqli_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        @session_start();
        $_SESSION['username'] = $username;
        while($row = $result->fetch_assoc()) {
            $userid = $row[`admins` . ID_Admin];
            $_SESSION['UserID'] = $row['ID_Admin'];
            $_SESSION['ISAdmin'] = 111;

        }
        // Redirect user to index.php
        header("Location: index.php");
    }else{
        echo "<div class='form'>
<h3>Neispravno korisničko ime ili lozinka.</h3>
<br/>Kliknite ovde za povratak na <a href='login.php'>Prijavljivanje za korisnike</a> ili <a href='admlogin.php'>administratore</a></div>";
    }
}else{
    ?>
    <div class="form" style="padding-left:300px; padding-right:300px">
        <h1>Prijava</h1>
        <form action="" method="post" name="login">
            <div class="w3-twothird">
            <input  class="w3-input w3-border w3-hover-light-gray" type="text" name="username" placeholder="Korisničko ime" required />
            <input  class="w3-input w3-border w3-hover-light-gray" type="password" name="password" placeholder="Lozinka" required />
        </div><div class="w3-third">
            <input name="submit" type="submit" class="w3-button w3-light-blue" style="width:fit-content" value="Prijava" /></div>
        </form>
        <br/>Povratak na <a href='login.php'>Prijavljivanje za korisnike</a></div>

    </div>
<?php }  ?>



</body>
</html>

<?php
include_once ('db_config.php'); ?>



<!DOCTYPE html>
<html>
<head>

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
    $query = "SELECT ID_Driver, Password FROM `drivers` WHERE ID_Driver='$username'
and password='".md5($password)."'";
    $result = mysqli_query($con,$query) or die(mysqli_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        @session_start();
        $_SESSION['username'] = $username;
        while($row = $result->fetch_assoc()) {
            $userid = $row[`drivers` . ID_Driver];
            $_SESSION['UserID'] = $row['ID_Driver'];

        }
        // Redirect user to index.php
        header("Location: index.php");
    }else{
        echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
    }
}else{
    ?>
    <div class="form">
        <h1>Prijava</h1>
        <form action="" method="post" name="login">
            <input type="text" name="username" placeholder="Korisničko ime" required />
            <input type="password" name="password" placeholder="Lozinka" required />
            <input name="submit" type="submit" value="Prijava" />
        </form>
        <p>Niste registrovani? <a href='registration.php'>Registrujte se ovde!</a></p>
    </div>
<?php }  ?>





</body>
</html>

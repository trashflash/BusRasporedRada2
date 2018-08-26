
<?php

// Checks if the user is logged in, used for the menu.

if(!isset($_SESSION))
{
    @session_start();
}
if(!isset($_SESSION["username"]))
{
// Redirecting To Home Page
    header("Location: login.php");
}
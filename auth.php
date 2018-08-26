
<?php

// Checks if the user is logged in, used for the menu.

if(!isset($_SESSION))
{
    @session_start();
}
?>
<?php if(!isset($_SESSION["username"])){?>
    <a href="login.php" class="w3-bar-item w3-button w3-blue-gray">Log in</a>
    <?php ;} else { ?>
    <a href="logout.php" class="w3-bar-item w3-button w3-blue-gray">Log out</a>
    <?php ;} ?>

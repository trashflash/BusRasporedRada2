
<?php

// Checks if the user is logged in, used for the menu.

if(!isset($_SESSION))
{
    @session_start();
}
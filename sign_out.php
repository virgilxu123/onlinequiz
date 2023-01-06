<?php
    include("class/users.php");
    $logout=new users;
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
    $logout->url("index.php?=logout")
?>
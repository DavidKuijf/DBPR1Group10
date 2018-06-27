<?php
require 'database.php';
session_start();

//if the session 'id' is set
if (isset($_SESSION['id']))
{
    //destroy the session and redirect to the index
    session_unset();
    session_destroy();
    header("Location: index.php");
        
}
else
{
    //redirect to index
    header("Location: index.php");
}
?>
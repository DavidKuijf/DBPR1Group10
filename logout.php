<?php
session_start();

if (isset($_SESSION['id']))
{
    var_dump($_SESSION['id']);
    session_unset();
    session_destroy();
    header("Location: index.php");
        
}
else
{
    header("Location: index.php");
}
?>
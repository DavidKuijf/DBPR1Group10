<?php
//check if the user is logged in
session_start();
if (isset($_SESSION['id'])) 
{
    echo "success";
}
?>
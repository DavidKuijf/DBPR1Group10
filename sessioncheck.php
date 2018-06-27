<?php
//check if the user is logged in
session_start();
if (isset($_SESSION['id'])) 
{
    echo '<input type="hidden" value="test"/>';
}
else{
    header("Location: index.php");
}
?>
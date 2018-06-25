<?php
//check if the user is logged in
session_start();
if (isset($_SESSION['id'])) 
{
    echo "<script>
    var loginsuccess = 'success';
    </script>";
}
else{
    header("Location: index.php");
}
?>
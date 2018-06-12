<?php




if (isset($_SESSION['id']))
    {
        var_dump($_SESSION['id']);
        session_unset();
        session_destroy();
        
    }
?>
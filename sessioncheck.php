<?php
session_start();
if (isset($_SESSION['username'])) {
    echo 'success';
}
echo 'success';
?>
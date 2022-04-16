<?php 
    session_start();
    echo isset($_SESSION['email']) ? 'true' : 'false';
?>
<?php
   
    session_start();
    session_unset();
    session_destroy();
    $_SESSION['redirect_to']='login.php';

?>
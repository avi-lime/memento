<?php 
        require_once "clearcache.php";
        session_destroy();         
        header("location:login.php");    
?>
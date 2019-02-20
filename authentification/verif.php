<?php
    session_start();
    //si la var auth n'existe pas on n'ira pas sur la page index
    if(!isset($_SESSION['auth'])){
        header('location:index.php');
    }
?>
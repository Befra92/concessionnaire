<?php
//Ouvrir la session
session_start();

//Nettoyer la session
session_unset();
session_destroy();
header('location:../index.php');



?>
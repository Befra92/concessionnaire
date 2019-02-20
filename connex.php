<?php
//Connexion à la Bdd
$connect = mysqli_connect("127.0.0.1","admin","admin","concessionnaire");
mysqli_set_charset($connect,"utf-8");
if($connect){
    echo "<b>Connexion</b> réussie....<br>";
}
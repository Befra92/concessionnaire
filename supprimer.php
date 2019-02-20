<?php

require_once('authentification/verif.php');
require_once('connex.php');
//Si suppression de la ligne du tableau Liste.php
if(isset($_GET['code'])){
    //Valeur $code = valeur à supprimer donc l'id
    $code = trim(htmlspecialchars($_GET['code']));
    //Requête préparée
    $sql = "DELETE FROM voiture WHERE id = ?";

    $res = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($res, "i", $code);
    $ok = mysqli_stmt_execute($res);

        if ($ok){          
            header('location:listes.php');
        }else{
            echo 'Erreur lors de la suppression';
        }
    }

?>


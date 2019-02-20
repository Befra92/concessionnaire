<?php
//Démarrage de la session
    require_once('authentification/verif.php');
    require_once('connex.php');
    $title = "liste voitures";  
    
    // var_dump($_SESSION);
 
?>
<?php require_once('partials/header.php'); ?>
<div class="container">
<a href="ajout.php" class="btn btn-primary text-white right"><i class="fa fa-plus-circle"></i> Ajouter</a>

<h2 class="text-center">Liste des voitures</h2>
    <table class="table table-striped rounded">
        <thead class="thead-dark">
            <tr>
            <th>ID</th>
            <th>MARQUE</th>
            <th>MODELE</th>
            <th>PAYS</th>
            <th>PRIX</th>
            <th>PHOTO</th>
            <th>DESCRIPTION</th>
            <th>DATE D'ARRIVEE</th>
            <th>ACTIONS</th>            
            </tr>           
        </thead>
        <tbody>
        <?php 
        //Connexion à bdd
           $sql = "SELECT * FROM voiture";
           $res = mysqli_prepare($connect, $sql);
       
           mysqli_stmt_execute($res);
           //Var pour injection des variables
           mysqli_stmt_bind_result($res, $id,$marque,$modele,$pays,$prix,$photo,$desc,$da);
           while(mysqli_stmt_fetch($res)){
        ?>
        <tr>
        <td><?php echo $id; ?></td>
        <td><?php echo $marque; ?></td>
        <td><?php echo $modele; ?></td>
        <td><?php echo $pays; ?></td>
        <td><?php echo $prix; ?></td>
        <td><img src="images/<?php echo $photo; ?>" width="80px" height="80px"></td>
        <td><?php echo substr($desc,0,40); ?></td>
        <td><?php echo $da; ?></td>
        <td>
        <a href="editer.php?code=<?php echo $id; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
        <a onclick="return confirm('Etes-vous sûr de vouloir supprimer ? <?php echo $marque. ' ' .$modele ?>')" href="supprimer.php?code=<?php echo $id; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once('partials/footer.php'); ?>

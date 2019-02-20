<?php
require_once('authentification/verif.php');
require_once('connex.php');
$title = "Modification voiture";  

// Au click du bouton
if(isset($_POST['soumis'])){
    // Test si tout Est tout est bien renvoyé!
    // var_dump($_POST);

    //Super global $_Files pour fonctionner l'affichage img
    // var_dump($_FILES);
    if(isset($_POST) && isset($_FILES['photo']) && !empty ($_POST['marque'])){
        //Traiter les infos relatives aux fichiers puis au renvoie de $_POST
        $file_name = $_FILES['photo']['name'];
        //non de l'emplacement ou est stocké le fichier
        $file_tmp_name = $_FILES['photo']['tmp_name'];
        //stockage de l'image et déplacement ds le fichier image
        $destination = "images/".$file_name;
        move_uploaded_file($file_tmp_name, $destination);

        //Données
        $marque = trim(htmlspecialchars(addslashes($_POST['marque'])));
        $modele = trim(htmlspecialchars(addslashes($_POST['modele'])));
        $pays = trim(htmlspecialchars(addslashes($_POST['pays'])));
        //Caster le prix pour les données en double
        $prix = (double)trim(htmlspecialchars(addslashes($_POST['prix'])));
        $descri = trim(addslashes($_POST['desc']));
        
        $sql = "INSERT INTO voiture(marque, modele, pays, prix, photo, description)
        VALUES(?,?,?,?,?,?)";
        $res = mysqli_prepare($connect, $sql);
        //Liaison des données donc les paramètres avec bind_param
        mysqli_stmt_bind_param($res, 'sssdss', $marque, $modele, $pays, $prix, $file_name, $descri);
        
        //Executer requête finale
        $ok = mysqli_stmt_execute($res);
        if($ok){
            header("location:listes.php");
            // echo 'Insertion réussie !';
        }else{
            echo '<b>Problème</b> lors de votre insertion';
        }
    }
}

require_once('partials/header.php');

?>
<div class="container">
    <h2>Ajout d'une voiture</h2>
        <!-- multipart/form-data aide pour le downloader la photo -->
        <!-- echo $_SERVER['PHP_SELF'] = Appel le même fichier -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="marque">Marque*</label>
                    <input type="text" class="form-control" require name="marque" id="marque" placeholder="Entrez votre marque">
                    </div>

                    <div class="form-group col-md-6">
                    <label for="modele">Modèle*</label>
                    <input type="text" class="form-control" require name="modele" id="modele" placeholder="Entrez votre modèle">
                    </div>

                    <div class="form-group col-md-6">
                    <label for="pays">Pays</label>
                    <input type="text" class="form-control" require name="pays" id="pays" placeholder="Entrez votre pays">
                    </div>

                    <div class="form-group col-md-6">
                    <label for="prix">Prix*</label>
                    <input type="text" class="form-control" require name="prix" id="prix" placeholder="Entrez votre prix">
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group">
                        <label for="photo">Photo*</label>
                        <input type="file" class="form-control-file" require id="photo" name="photo">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="desc">Votre description*</label>
                        <textarea class="form-control" id="description" require rows="3" name="desc" placeholder="Entrez votre description"></textarea>
                    </div>
                    <button type="submit" name="soumis" class="btn btn-success btn-lg btn-block">Soumettre</button>
        </form>   
</div>
<?php require_once('partials/footer.php'); ?>
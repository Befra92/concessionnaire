<?php
require_once('authentification/verif.php');
require_once('connex.php');
$title = "Ajout voiture";  


///Condition de restriction
if(isset($_GET['code'])){
    $code = $_GET['code'];

//Requête preparée
    $sql = "SELECT * FROM voiture WHERE id = ?";
    $res = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($res, 'i',$code);
    $ok = mysqli_stmt_execute($res);

    mysqli_stmt_bind_result($res,$id,$marque,$modele,$pays,$prix,$photo,$descri,$da);
    mysqli_stmt_fetch($res);
}

//Champs caché et aller à la soumission pour modifier
// Au click du bouton******************************************
//var_dump($_POST);
if(isset($_POST['soumis'])){
    
    // die();
    // Test si tout est bien renvoyé!
    // var_dump($_POST);

    //Super global $_Files pour fonctionner l'affichage img
    //  var_dump($_FILES);
    if(isset($_POST) || isset($_FILES['photo'])){
        // var_dump($_POST);
        //Traiter les infos relatives aux fichiers puis au renvoie de $_POST
        $file_name = $_FILES['photo']['name'];
        //non de l'emplacement ou est stocké le fichier
        $file_tmp_name = $_FILES['photo']['tmp_name'];
        //stockage de l'image et déplacement ds le fichier image
        $destination = "images/".$file_name;
        move_uploaded_file($file_tmp_name, $destination);

        //Données
        //Valeur de l'id est code      
        $marque = trim(htmlspecialchars(addslashes($_POST['marque'])));
        $id = (int)trim(htmlspecialchars(addslashes($_POST['code'])));
        $modele = trim(htmlspecialchars(addslashes($_POST['modele'])));
        $pays = trim(htmlspecialchars(addslashes($_POST['pays'])));
        //Caster le prix pour les données en double
        $prix = (double)trim(htmlspecialchars(addslashes($_POST['prix'])));
        $descri = trim(addslashes($_POST['desc']));
        
        //lorsque je soumets je garde l'ancienne img car $file est null
        $oldphoto = trim(htmlspecialchars(addslashes($_POST['oldphoto'])));
        $photo = "";
        if($_file_name){
            $photo = $file_name;
        }else{
            $photo = $oldphoto;
        }
    }
       
        $sql = "UPDATE voiture SET marque=?, modele=?, pays=?, prix=?, photo=?, description=? WHERE id=?";
        $res = mysqli_prepare($connect, $sql);
        //Liaison des données donc les paramètres avec bind_param
        mysqli_stmt_bind_param($res, 'sssdssi', $marque, $modele, $pays, $prix, $photo, $descri, $id);
        
        //Executer requête finale
        $ok = mysqli_stmt_execute($res);
        if($ok){
            header("location:listes.php");
            // echo 'Insertion réussie !';
        }else{
            echo '<b>Problème</b> lors de votre insertion';
        }
    }

require_once('partials/header.php');

?>
<div class="container">
    <h2>Modification d'une voiture</h2>
        <!-- multipart/form-data aide pour le downloader la photo -->
        <!-- echo $_SERVER['PHP_SELF'] = Appel le même fichier -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-row">
            
            <div class="form-group col-md-12">
                    <label for="marque">Id</label>
                    <input type="text" class="form-control" name="code" id="id" value="<?php echo $id; ?>" readonly>
            </div>
                    
                    <div class="form-group col-md-6">
                    <label for="marque">Marque*</label>
                    <input type="text" class="form-control" require name="marque" id="marque" value="<?php echo $marque; ?>" placeholder="Entrez votre marque">
                    </div>

                    <div class="form-group col-md-6">
                    <label for="modele">Modèle*</label>
                    <input type="text" class="form-control" require value="<?php echo $modele; ?>" name="modele" id="modele" placeholder="Entrez votre modèle">
                    </div>

                    <div class="form-group col-md-6">
                    <label for="pays">Pays</label>
                    <input type="text" class="form-control" require name="pays" value="<?php echo $pays; ?>" id="pays" placeholder="Entrez votre pays">
                    </div>

                    <div class="form-group col-md-6">
                    <label for="prix">Prix*</label>
                    <input type="text" class="form-control" require name="prix" value="<?php echo $prix; ?>" id="prix" placeholder="Entrez votre prix">
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group">
                        <label for="photo">Photo*</label>
                        <img src="images/<?php echo $photo; ?>" width=100 height=100>
                        <input type="file" class="form-control-file" require id="photo" name="photo">
                        <!-- Affiche l'image quand on ne change pas l'img dans modifier -->
                        <input type="hidden" value="<?php echo $photo; ?>" name="oldphoto">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="desc">Votre description*</label>
                        <textarea class="form-control" id="description" require rows="3" name="desc" placeholder="Entrez votre description" <?php echo $descri; ?>"></textarea>
                    </div>
                    <button type="submit" name="soumis" class="btn btn-warning btn-lg btn-block">Modifier</button>
        </form>   
</div>
<?php require_once('partials/footer.php'); 
?>

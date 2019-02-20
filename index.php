<?php
require_once('connex.php');
if (isset($_POST['soumis'])){
    //Validation côté serveur
    if(isset($_POST) && !empty($_POST['pseudo'])&& !empty($_POST['pwd'])){
        $pseudo = trim(htmlspecialchars(addslashes($_POST['pseudo'])));
        $pass = md5(trim(htmlspecialchars(addslashes($_POST['pwd']))));

        $sql = "SELECT * FROM admin WHERE pseudo = ? AND pass = ?";
        //requete preparee
        $res = mysqli_prepare($connect, $sql);
        //liaison
        mysqli_stmt_bind_param($res, 'ss', $pseudo, $pass);
        mysqli_stmt_execute($res);

        mysqli_stmt_bind_result($res, $id, $pseudo, $email, $pass);
        //Donner à charger avec fetch
        if(mysqli_stmt_fetch($res)){
            //si tout est vérifier avec champs pseudo et mdp on stocke ds une var SESSIONS
            //Si la personne est dans la bdd on va la diriger vers listes.php
            session_start();
            $_SESSION['auth']['pseudo'] = $pseudo;
            $_SESSION['auth']['pass'] = $pass;

            header('location:listes.php');
        }else{
            echo 'Pseudo ou le mot de passe ne correspondent pas';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>connexion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>

<body>


<div class="container">
<div class="row col-md-6 offset-md-3 col-centered">
  <h2 class="text-center">Formulaire de connexion</h2>
  <!-- <div class="alert alert-danger">
  <strong><?php ?></strong> -->
  <form action="" method="post" autocomplete="off" required>
    <div class="form-group">
      <label for="pseudo">Pseudo*</label>
      <input type="text" class="form-control" id="pseudo" name="pseudo" require placeholder="Entrer votre pseudo" name="pseudo">
    </div>
    <div class="form-group">
      <label for="pwd">Password*</label>
      <input type="password" class="form-control" id="pwd" required placeholder="Entrer votre password" name="pwd">
    </div>
    <!-- donnees à récupérer grâce aux cookies
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>-->
    <button type="submit" class="btn btn-primary btn-block" name="soumis">Connecter</button>
  </form>
  </div>
</div>

</body>
</html>

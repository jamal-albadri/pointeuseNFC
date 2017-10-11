<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './script/flashmessage.php';
require_once './script/users.php';

$erreurs = array();

$prenom = "";
$nom = "";
$email = "";
$heureDebut = "";
$modifier = false;

if (filter_has_var(INPUT_POST, "submit")) {
    $prenom = trim(filter_input(INPUT_POST, "Prenom", FILTER_SANITIZE_STRING));
    $nom = trim(filter_input(INPUT_POST, "Nom", FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, "Email", FILTER_SANITIZE_STRING));
    $pwd = trim(filter_input(INPUT_POST, "Pwd", FILTER_SANITIZE_STRING));
    $pwdConfirm = trim(filter_input(INPUT_POST, "PwdConfirm", FILTER_SANITIZE_STRING));
    $heureDebut = filter_input(INPUT_POST, "Heure", FILTER_SANITIZE_STRING);
    
    if (strcmp($pwd, $pwdConfirm) !== 0) {
        $erreurs['password'] = "Les mots de passe ne correspondent pas !";
        SetFlashMessage($erreurs['password']);
    }
    if(empty($nom)){
        $erreurs['nom'] = "Le champ ne peut pas être vide !";
        SetFlashMessage($erreurs['nom']);
    }
    else if(empty($prenom)){
        $erreurs['prenom'] = "Le champ ne peut pas être vide !";
        SetFlashMessage($erreurs['prenom']);
    }
    else if(empty($pseudo)){
        $erreurs['email'] = "Le champ ne peut pas être vide !";
        SetFlashMessage($erreurs['email']);
    }
    else if(empty($pwd)){
        $erreurs['password'] = "Le champ ne peut pas être vide !";
        SetFlashMessage($erreurs['password']);
    }
    if (empty($erreurs)) {
        addUser($nom, $prenom, $email, $pwd, $heureDebut);
        SetFlashMessage("L'utlisateur a été ajouté dans la table");
        //header("location:affichageUtilisateur.php");
        //exit;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">NomEntreprise</a>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#">Déconnexion</a></li>
                </ul>
              </div>
            </div>
        </nav>
        <div class="container">
            <?php if($modifier == false){?>
            <h2 style="padding-top: 50px;">Ajouter un collaborateur</h2>
            <?php
            }
            else{
            ?>
            <h2 style="padding-top: 50px;">Modifier une personne</h2>
            <?php 
            }
            ?>
            <form method="POST" action="">
                <div class="form-group row">
                    <label class="col-2 col-form-label">Nom :</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="<?php echo $nom ?>" name="Nom">
                    </div>
                </div>
                <?php
                if (!empty($erreurs['nom'])) {
                    ?>
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <h4 class="alert-heading">Erreur</h4>
                        <p><?php echo GetFlashMessage();?></p>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Prénom :</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="<?php echo $prenom ?>" name="Prenom">
                    </div>
                </div>
                <?php
                if (!empty($erreurs['prenom'])) {
                    ?>
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <h4 class="alert-heading">Erreur</h4>
                        <p><?php echo GetFlashMessage();?></p>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Email :</label>
                    <div class="col-10">
                        <input class="form-control" type="email" value="<?php echo $email ?>" name="Email">
                    </div>
                </div>
                <?php
                if (!empty($erreurs['Email'])) {
                    ?>
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <h4 class="alert-heading">Erreur</h4>
                        <p><?php echo GetFlashMessage(); ?></p>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Heure de début :</label>
                    <div class="col-10">
                        <input class="form-control" type="time" value="" name="Heure">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Mot de passe :</label>
                    <div class="col-10">
                        <input class="form-control" type="password" value="" name="Pwd">
                    </div>
                </div>
                <?php
                if (!empty($erreurs['password'])) {
                    ?>
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <h4 class="alert-heading">Erreur</h4>
                        <p><?php echo GetFlashMessage(); ?></p>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Confirmation<br>Mot de passe :</label>
                    <div class="col-10">
                        <input class="form-control" type="password" value="" name="PwdConfirm">
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
        <script src="../bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    </body>
</html>
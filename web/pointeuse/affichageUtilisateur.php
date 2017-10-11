<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require './script/users.php';
$users = getUsers();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/dashboard.css" rel="stylesheet">
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
        <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Vue d'ensemble <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Affichage utilisateur</a></li>
            <li><a href="#">Affichage administrateurs</a></li>
            <li><a href="#">Modification administrateurs</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="container">
            <h2 style="padding-top: 50px;">Table des utilisateurs</h2>
            <?php
            if (!empty($_SESSION['message'])) {
                ?>
                <div class="alert alert-success alert-dismissable" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h4 class="alert-heading">Succès</h4>
                    <p><?php echo GetFlashMessage(); ?></p>
                </div>
                <?php
            }
            ?>
            <a href="ajouterCollaborateur.php">
                <button type="button" class="btn btn-primary btn-lg btn-block">
                    Ajouter un utilisateur
                </button>
            </a>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Heure de début</th>
                        <th>Voir profil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($users as $infos){
                    $idCollaborateur = $infos['idCollaborateur'];
                    $nom = $infos['nom'];
                    $prenom = $infos['prenom'];
                    $email = $infos['email'];
                    $heure = $infos['heureDebut'];
                    ?>
                    <tr>
                        <th><?php echo $idCollaborateur; ?></th>
                        <td><?php echo $nom; ?></td>
                        <td><?php echo $prenom; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $heure ?></td>
                        <td>    
                            <a href="edituser.php?id=<?php echo $donnees['idCollaborateur']; ?>" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true">
                                    </span>
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
      </div>
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="../bootstrap-3.3.7-dist/js/bootstrap.js"></script>
    </body>
</html>
<?php 
    session_start();
    include( 'BDD.php' );
    require ( 'fonctions.php' );
?>
<?php 

if ( isset( $_POST['inscription'] ) == TRUE ){

    inscription( $_POST['email'], $_POST['password'], $_POST['ipassword'], $_POST['prenom'],
                 $_POST['nom'], $db, $_FILES['profilepicture']['name'], $_FILES['profilepicture']['tmp_name'] );
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>walltech - Accueil</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="accueil.css">
    </head>
        <body>
            <form method ="POST">
                <header> <!-- En-tête + Conenxion -->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="logo">walltech</div>
                            </div>
                            <div class="col-sm-6 hidden-xs">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input type="mail" class="form-control" name ="coemail" placeholder="Adresse e-mail" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input type="password" class="form-control" name ="copassword" placeholder="Mot de passe" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-light btn-header-login" name ="connexion" value="connexion">
                                        </div>
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </form>
    <?php 
    
        if ( isset( $_POST['connexion'] ) == TRUE ){

                    connexion( $_POST['coemail'], $_POST['copassword'], $db );

                }

            ?>
            <form method ="POST">
                <article class="container"> <!-- Inscription -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="inscription">
                                <p><h3><i class="fa fa-shield"></i> Créer un compte</h3></p>
                                <div class="container">
                                    <ul class="step d-flex flex-nowrap">
                                        <li class="step-item active">
                                            <a href="#!" class="">Étape 1</a>
                                        </li>
                                        <li class="step-item">
                                            <a href="#!" class="">Étape 2</a>
                                        </li>
                                        <li class="step-item">
                                            <a href="#!" class="">Étape 3</a>
                                        </li>
                                    </ul> 
                                </div>

    <form method ="POST" enctype="multipart/form-data">
        <article class="container"> <!-- Inscription -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="inscription">
                        <p><h3><i class="fa fa-shield"></i> Créer un compte</h3></p>
                        <hr>
                        <div class="form-group">
                            <label class="control-label" for="">Adresse e-mail</label>
                            <input type="email" class="form-control bg-dark text-white" name ="email" placeholder="Adresse e-mail" required>
                        </div>

                                <hr class="border border-secondary">
                                <div class="form-group">
                                    <label class="control-label" for="">Adresse e-mail</label>
                                    <input type="email" class="form-control bg-dark text-white" name ="email" placeholder="Adresse e-mail" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="">Nom</label>
                                    <input type="text" class="form-control bg-dark text-white" name ="nom" placeholder="Nom" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="">Prénom</label>
                                    <input type="text" class="form-control bg-dark text-white" name ="prenom"placeholder="Prénom" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="">Mot de passe</label>
                                    <input type="password" class="form-control bg-dark text-white" name ="password" placeholder="Mot de passe" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="">Confirmer le mot de passe</label>
                                    <input type="password" class="form-control bg-dark text-white" name ="ipassword" placeholder="Mot de passe" required>
                                </div>
                            </div>               
                        <div style="height:10px;"></div>
                            <div class="form-group">
                                <label class="control-label" for=""></label>
                                <input type="submit" class="btn btn-light" name="inscription" value="Inscription">
                            </div>
                        </div> 
                        <div class="col-sm-8">
                            <!--<div class="login-main">
                                <h4><i class="fa fa-dashboard"></i>Exemple</h4>
                                <span>Description</span>
            
                                <h4> <i class="fa fa-money"></i>Exemple</h4>
                                <span>Description</span>
            
                                <h4><i class="fa fa-mobile-phone"></i>Exemple</h4>
                                <span>Description</span>
            
                                <h4> <i class="fa fa-trophy"></i>Exemple</h4>
                                <span>Description</span>
                            </div>-->
                        </div>
<<<<<<< HEAD
=======

                        <div class="form-group">
                            <label class="control-label" for="">Photo de profil</label>
                            <input type="file" class="form-control bg-dark text-white" name ="profilepicture" required>
                        </div>
                    </div>               
                <div style="height:10px;"></div>
                    <div class="form-group">
                        <label class="control-label" for=""></label>
                        <input type="submit" class="btn btn-light" name="inscription" value="Inscription">
>>>>>>> 25aa9385d72ff6a8406cd145f3ee160cb101b42c
                    </div>
                </article>
            </form>

            <footer class="container">
                <hr class="border border-secondary">
                <div class="footer-options">
                    <ul >
                        <li>
                            <a href="https://www.intechinfo.fr/">
                                <img src="intech.png" alt="" width="150"/>
                            </a>
                        </li>
                    </ul>
                </div>
                <div style="clear:both"></div>
                <!-- <small class="copyrights"> © Copyrights reserved 2020</small> -->
            </footer>
        </body>
    </html>
<?php
    session_start();
    include('BDD.php');
    require ('fonctions.php');

    if ( empty($_POST['prof']) AND isset($_POST['role']) AND $_POST['role'] == 'prof' 
        OR empty( $_FILES['photo']['name'] ) AND !isset( $_GET['fail'] ) AND !isset( $_GET['good'] )) {

        header( "Location:inscription.php?fail=on" );
        exit;

    } else if ( isset($_POST['role']) AND $_POST['role'] != 'prof' AND isset($_POST['prof']) AND count($_POST['prof'])
         > 0 OR empty( $_FILES['photo']['name'] ) AND !isset( $_GET['fail'] ) AND !isset( $_GET['good'] )) {

        header( "Location:inscription.php?fail=on" );
        exit;

    } else if ( isset( $_POST['perfect'] ) ) {

        final_inscription ( $db, $_FILES['photo']['name'], $_FILES['photo']['tmp_name'], $_SESSION['email'], 
        $_POST['role'], $_POST['prof'] );
    
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>walltech - Inscription</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="inscription.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark" style="background: #102946;">
            <form method="POST">    
                <a class="navbar-brand" onclick="return false" href="filactualites.php">walltech</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </form>
        </nav>

        <div class="container">
                <div class="mt-5 mb-5 text-center text-white">
                    <h2>Étapes de l'inscription</h2>
                </div>
                <ul class="step d-flex flex-nowrap">
                    <li class="step-item">
                        <a href="#!" class="">Étape 1</a>
                    </li>
                    <li class="step-item active">
                        <a href="#!" class="">Étape 2</a>
                    </li>
                    <li class="step-item">
                        <a href="#!" class="">Étape 3</a>
                    </li>
                </ul>
            <?php

                if ( isset( $_GET['fail'] ) ) {

                    echo '<div class="mt-5 mb-5 text-center text-danger">
                            <h5>Veuillez choisir un rôle et une photo de profil</h5>
                          </div>';

                }

            ?>
            <form method="POST" action="inscription.php" enctype="multipart/form-data">
                <div class="mt-5 mb-5 text-center text-white">
                    <h5>Sélectionnez votre photo de profil :</h5>
                </div>

                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <input type="file" class="form-control" name="photo" id="username">
                    </div>
                </div>

                </br>

                <div class="mt-5 mb-5 text-center text-white">
                    <h5>Sélectionnez votre classe :</h5>
                </div>
                
                    <select class="form-control d-flex flex-nowrap" name="role">
                        <option value="prof">Je suis un professeur</option>
                        <optgroup label="Élève">
                            <option value="sem1">Semestre 1</option>
                            <option value="sem2">Semestre 2</option>
                            <option value="sem3">Semestre 3</option>
                            <option value="sem4">Semestre 4</option>
                            <option value="sem5">Semestre 5</option>
                            <option value="sem6">Semestre 6</option>
                            <option value="sem7">Semestre 7</option>
                            <option value="sem8">Semestre 8</option>
                            <option value="sem9">Semestre 9</option>
                            <option value="sem10">Semestre 10</option>
                        </optgroup>
                    </select>

                </br>

                <div class="mt-5 mb-5 text-center text-white">
                    <h5>Etes-vous professeur ?</h5>
                </div>

                    <div class="custom-control custom-checkbox my-2 mr-sm-3 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs1" name="prof[]" value="profs1">
                        <label class="custom-control-label text-white" for="profs1">Professeur S1</label>
                    </div>
                    <div class="custom-control custom-checkbox my-2 mr-sm-3 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs2" name="prof[]" value="profs2">
                        <label class="custom-control-label text-white" for="profs2">Professeur S2</label>
                    </div>
                    <div class="custom-control custom-checkbox my-2 mr-sm-3 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs3" name="prof[]" value="profs3">
                        <label class="custom-control-label text-white" for="profs3">Professeur S3</label>
                    </div>
                    <div class="custom-control custom-checkbox my-2 mr-sm-3 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs4" name="prof[]" value="profs4">
                        <label class="custom-control-label text-white" for="profs4">Professeur S4</label>
                    </div>
                    <div class="custom-control custom-checkbox my-2 mr-sm-3 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs5" name="prof[]" value="profs5">
                        <label class="custom-control-label text-white" for="profs5">Professeur S5</label>
                    </div>
                    <div class="custom-control custom-checkbox my-2 mr-sm-3 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs6" name="prof[]" value="profs6">
                        <label class="custom-control-label text-white" for="profs6">Professeur S6</label>
                    </div>
                    <div class="custom-control custom-checkbox my-2 mr-sm-3 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs7" name="prof[]" value="profs7">
                        <label class="custom-control-label text-white" for="profs7">Professeur S7</label>
                    </div>
                    <div class="custom-control custom-checkbox my-2 mr-sm-3 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs8" name="prof[]" value="profs8">
                        <label class="custom-control-label text-white" for="profs8">Professeur S8</label>
                    </div>
                    <div class="custom-control custom-checkbox my-2 mr-sm-3 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs9" name="prof[]" value="profs9">
                        <label class="custom-control-label text-white" for="profs9">Professeur S9</label>
                    </div>
                    <div class="custom-control custom-checkbox my-2 mr-sm-1 text-center">
                        <input class="custom-control-input" type="checkbox" id="profs10" name="prof[]" value="profs10">
                        <label class="custom-control-label text-white" for="profs10">Professeur S10</label>
                    </div>

                    </br>
                    </br>

                    <button type="submit" name="perfect" class="btn btn-secondary col-md-2 offset-md-5">Confirmer</button>
                </form>

                </br>
                </br>
                </br>
                </br>
            </div>
        </div>
    </body>
</html>
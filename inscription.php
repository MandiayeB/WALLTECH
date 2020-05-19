<?php
    session_start();
    include('BDD.php');
    require ('fonctions.php');
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
                <a class="navbar-brand" href="filactualites.php">walltech</a>
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
        
                <div class="mt-5 mb-5 text-center text-white">
                    <h5>Sélectionnez votre classe :</h5>
                </div>
                <form method="POST">
                    <select class="form-control d-flex flex-nowrap">
                        <optgroup label="Élève">
                            <option value="sem1">Semestre 1</option>
                            <option value="sem2">Semestre 2</option>
                            <option value="sem3">Semestre 3</option>
                        </optgroup>
                        <optgroup label="Professeur">
                            <option value="profs1">Professeur S1</option>
                            <option value="profs2">Professeur S2</option>
                            <option value="profs3">Professeur S3</option>
                        </optgroup>
                    </select>
                    </br>
                    <input type="file" class="custom-file-input " name ="profilepicture" required>
                    </br>
                    <button type="button" class="btn btn-secondary">Confirmer</button>
                </form>
            </div>
        </div>
    </body>
</html>
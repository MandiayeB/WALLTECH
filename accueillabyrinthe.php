<?php

    session_start();
    include( 'BDD.php' );
    require ( 'fonctions.php' );

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>walltech - Maze</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="filactualites.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
    
    <!-- En-tête -->
    
        <?php include('header.php'); ?>

    <!-- Profil -->

        <div class="container-fluid gedf-wrapper">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body bg-dark text-white">

                            <?php
                            echo '<img class="rounded-circle" width="45" height="45" 
                            src="'.photodeprofil( $db, $_SESSION['idut']).'" alt="">';
                            ?>

                            <div>&nbsp</div>
                            <div class="h5"><?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?></div>
                            
                            <?php 
                                afficherrole ( verifrole ( $db, $_SESSION['idut'] ) ); 
                            ?>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-6 gedf-main">
                    <div class="container">
                        <div class="row">
                            <div class="col-2"></div>
                            <img src="labyrinthe.png" height="400" width="400"/>
                        </div>

                        <div class="h5 text-white">Dans MAZE vous incarnerez Nomad le dromadaire :
                            &nbsp&nbsp<img height="65" width="65" src="desert.png" alt="">
                        </div>
                        <div class="h5 text-white">Votre objectif est de récupérer tous les artefacts pour pouvoir sortir du labyrinthe</div>
                        <div>&nbsp</div>
                        
                        <form action="labyrinthe.php" method="POST">
                            <div class="h5 text-white">Prêt à relever le défi ?&nbsp&nbsp
                                <button type="submit" style = "background-color: transparent; border: none;"
                                name="start"><img src="commencer.png" height="50" width="70"/></button>
                            </div>
                        </form>

                    </div>
                </div>

                
                    
                </div>

            </div>
        </div>
    </body>
</html>
<?php
    session_start();
    include( 'BDD.php' );
    require ( 'fonctions.php' );

    if ( isset( $_POST['start'] ) ) {

        createmaze( $db, $_SESSION['idut'] );

    }

    if ( isset( $_GET['move'] ) ) {

        movemaze( $db, $_GET['move'], $_SESSION['idut'] );

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>walltech - Maze</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="labyrinthe.css">
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
                    <?php
                        echo '<div>&nbsp</div>';
                        inventairemaze( $db, $_SESSION['idut'] );
                    ?>
                </div>

                <div class="col-md-6 gedf-main">

                        <?php
                            cardmaze( $db, $_SESSION['idut'] );
                            affichermaze( $db, $_SESSION['idut'] );

                        ?>
            
                            
                    </div>
                </div>

                <div class="col-md-3">
                    
                        <div class="container" style="background-image: url(keyboard.png); 
                        background-size:48%; background-repeat: no-repeat; display:flex; flex-direction:column;">
                        <span style="display:inline-block; height: 45px; width: 65px;" ></span>
                        
                        

                        <?php
                        
                            for ( $i = 0; $i < 2; $i++ ) {

                                echo '<div class="row" style="flex-direction:row;">
                                <span style="display:inline-block; height: 64px; width: 12px;" href=""></span>';

                                for ( $y = 0; $y < 3; $y++ ) {

                                    if ( $i == 0 AND $y == 1 ) {

                                        echo '<a style="display:inline-block; height: 64px; width: 64px;" href="labyrinthe.php?move=up"></a>';

                                    } else if ( $i == 1 AND $y == 0 ) {

                                        echo '<a style="display:inline-block; height: 64px; width: 64px;" href="labyrinthe.php?move=left"></a>';

                                    } else if ( $i == 1 AND $y == 1 ) {

                                        echo '<a style="display:inline-block; height: 64px; width: 64px;" href="labyrinthe.php?move=down"></a>';

                                    } else if ( $i == 1 AND $y == 2 ) {

                                        echo '<a style="display:inline-block; height: 64px; width: 64px;" href="labyrinthe.php?move=right"></a>';

                                    } else {

                                        echo '<span style="display:inline-block; height: 64px; width: 64px;" href=""></span>';

                                    }
                                    
                                }

                                echo '</div>';
                                

                            }
                            echo '<span style="display:inline-block; height: 82px; width: 82px;"></span>
                                  <div class="row">
                                    <img height="65" width="65" src="palm-tree.png" alt="">
                                    <img height="65" width="65" src="temple.png" alt="">
                                    <img height="65" width="65" src="palm-tree.png" alt="">
                                  </div>
                                  <div>&nbsp</div>
                                  <div class="row">
                                    <img height="65" width="65" src="pyramid.png" alt="">
                                    <img height="65" width="65" src="sphinx.png" alt="">
                                    <img height="65" width="65" src="pyramid.png" alt="">
                                  </div>';

                        ?>
                        </div>
                    
                </div>

            </div>
        </div>
    </body>
</html>
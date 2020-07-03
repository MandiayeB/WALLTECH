<?php
    session_start();
    include( 'BDD.php' );
    require ( 'fonctions.php' );

    if( isset( $_POST['sup'] ) ) {

        supprimercours( $_POST['sup'], $db );
        
    }

    if( isset( $_POST['modification'] ) ) {

        modifcours( $_POST['modification'], $_POST['change'], $db );
        
    }

    if (isset($_SESSION['email'])==FALSE){

        header('Location:accueil.php');
        
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>walltech - Cours</title>
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

                    <?php 
                    if ( isset( $_GET['success'] ) ) {

                        echo '<div class="mt-5 mb-5 text-success">
                                <h5> Votre cours a été modifié avec succès ! </h5>
                              </div>';

                    } else if( isset( $_POST['modif'] ) ) {

                        $req = $db -> prepare( 'SELECT * FROM cours WHERE idCours = :id' );
                        $req -> execute(array(
                            'id' => $_POST['modif']
                        ));
                        $donnees = $req->fetch();

                        echo'<div class="card gedf-card bg-dark text-white">
                                <div class="card-body">
                                    <form method = "POST" enctype="multipart/form-data">
                                            <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                                <div class="form-group">
                                                    <div>&nbsp</div>
                                                    <label class="sr-only" for="message">post</label>
                                                    <textarea class="form-control" name="change" id="message" rows="3">'.$donnees['cours'].'</textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="btn-toolbar justify-content-between">
                                            <div class="btn-group">
                                                <input type="hidden" name="modification" value="'.$donnees['idCours'].'">
                                                <input type="submit" name="send" class="btn btn-light" value="Modifier">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>';
                        
                    } else {

                        affichercours( $db, $_SESSION['idut'], $_GET['classe'] );

                    }
                        
                    ?>
                    
                </div>
                
            </div>
        </div>
    </body>
</html>
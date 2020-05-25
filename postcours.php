<?php
    session_start();
    include( 'BDD.php' );
    require ( 'fonctions.php' );

    if ( isset( $_POST['leçon'] ) ) {
                        
        if ( !empty( $_FILES['img']['name'] ) ) {
            
            publiercours( $_POST['post'], $_SESSION['idut'], $_POST['classe'], $db, $_FILES['img']['name'], $_FILES['img']['tmp_name'], true);

        } else {

            publiercours( $_POST['post'], $_SESSION['idut'], $_POST['classe'], $db, false, false, false);
        
        }
    
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>walltech - Fil d'actualités</title>
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
                            
                            <div class="h5"><?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?></div>

                            <?php 
                                afficherrole ( verifrole ( $db, $_SESSION['idut'] ) ); 
                            ?>
                            
                            <div class="h7">Description du profil</div>
                        </div>
                        <!--<ul class="list-group list-group-flush">
                            <li class="list-group-item bg-dark text-white">
                                <div class="h6 text-muted">Followers</div>
                                <div class="h5">0</div>
                            </li>
                            <li class="list-group-item bg-dark text-white">
                                <div class="h6 text-muted">Following</div>
                                <div class="h5">0</div>
                            </li>
                        </ul>-->
                    </div>
                </div>

                <!-- Modèle publication -->
                
                <div class="col-md-6 gedf-main">
                    <div class="card gedf-card bg-dark text-white">
                        <div class="card-header bg-dark text-white">
                            <ul class="nav nav-tabs card-header-tabs bg-dark text-white" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active bg-dark text-white" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Publier</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link bg-dark text-white" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                                </li>
                            </ul>
                        </div>
                    <form method = 'POST' enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group">
                                            
                                        <?php choixclasse( $db, $_SESSION['idut'] ); ?>

                                        <div>&nbsp</div>

                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control" name='post' id="message" rows="3" placeholder="Choisissez une classe, puis ajoutez votre cours."></textarea>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name= "img" id="customFile">
                                            <label class="custom-file-label" for="customFile">Upload image</label>
                                        </div>
                                    </div>
                                    <div class="py-4"></div>
                                </div>
                            </div>

                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <input type="submit" name='leçon' class="btn btn-light" value='Publier'>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <?php 

                        if ( isset( $_GET['success'] ) ) {
                            echo '<div class="mt-5 mb-5 text-success">
                                    <h5> Votre cours a été publié avec succès ! </h5>
                                  </div>';
                        }
                    
                    ?>
    </body>
</html>

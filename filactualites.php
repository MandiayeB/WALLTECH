<?php
    
    session_start();
    include('BDD.php');
    require ('fonctions.php');
    
    if ( isset($_POST['publier']) ) {
                        
        postfile($_POST['post'], $_SESSION['idut'], $db);
    
    }

    if(isset($_POST['pubcom'])) {
            
        commenter($_POST['comment'], $_SESSION['idut'], $db, $_POST['idFil']);
    
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
        <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark" style="background: #102946;">
            <form method="POST">    
                <a class="navbar-brand" href="filactualites.php">walltech</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </form>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <!--<i class="fa fa-envelope-o">
                                    <span class="badge badge-danger">11</span>  NOTIFICATION
                                </i>-->
                            Profil
                            </a>
                        </li>
                        
                        <form method="POST">
                            <li class="nav-item">
                                <a class="nav-link" href="chat.php">
                                <!--<i class="fa fa-envelope-o">
                                    <span class="badge badge-danger">11</span>  NOTIFICATION
                                </i>-->
                                Messages
                                </a>
                            </li>
                        </form>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!--<i class="fa fa-envelope-o">
                                <span class="badge badge-danger">11</span>  NOTIFICATION
                            </i>-->
                            Menu déroulant
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">exemple 1</a>
                                <a class="dropdown-item" href="#">exemple 2</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">exemple 3</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <!--<i class="fa fa-bell">
                                <span class="badge badge-info">11</span>  NOTIFICATION
                            </i>-->
                            Cours
                            </a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Recherche" aria-label="Search">
                        <button class="btn btn-light my-2 my-sm-0" type="submit">Rechercher</button>
                    </form>
                </div>
            </nav>
    
    <!-- Profil -->

        <div class="container-fluid gedf-wrapper">
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-dark">
                        <div class="card-body bg-dark text-white">
                            <div class="h5"><?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?></div>
                            <div class="h7 text-muted">Nom complet</div>
                            <div class="h7">Description du profil</div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <span class="border border-secondary"></span>
                            <li class="list-group-item bg-dark text-white">
                                <div class="h6 text-muted">Followers</div>
                                <div class="h5">0</div>
                            </li>
                            <span class="border border-secondary"></span>
                            <li class="list-group-item bg-dark text-white">
                                <div class="h6 text-muted">Following</div>
                                <div class="h5">0</div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Modèle publication -->
                
                <div class="col-md-6 gedf-main">
                    <div class="card gedf-card bg-dark text-white">
                        <div class="card-header bg-dark text-white">
                            <ul class="nav nav-tabs card-header-tabs bg-dark text-white" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active bg-dark text-white border border-secondary" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Publier</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link bg-dark text-white border border-secondary" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                                </li>
                            </ul>
                        </div>
                        <form method = 'POST'>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control bg-dark border border-secondary" name='post' id="message" rows="3" placeholder="Quoi de neuf ?"></textarea>
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
                                    <input type="submit" name='publier' class="btn btn-light" value='Publier'>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php 
                        
                    afficherfile($db);
                        
                    ?>
                    
                    <!-- Post -->

                    <!--<div class="card gedf-card bg-dark text-white">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0">@Nom de l'utilisateur</div>
                                        <div class="h7 text-muted">Nom complet</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>10 min ago</div>
                            <a class="card-link" href="#">
                                <h5 class="card-title">Titre de la publication</h5>
                            </a>
    
                            <p class="card-text">
                                Description de la publication
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Commenter</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Partager</a>
                        </div>
                    </div>-->

                <!-- Exemple de carte -->

                </div>
                <div class="col-md-3">
                    <div class="card gedf-card bg-dark">
                        <div class="card-body bg-dark text-white">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                card's content.</p>
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
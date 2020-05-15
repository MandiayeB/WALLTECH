<?php
    session_start();
    include('BDD.php');
    require ('fonctions.php');

    if ( isset($_POST['message']) ) {
                        
        postmessages($db,$_POST['message'],$_SESSION['idut'],$_GET['idUt']);
    
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>walltech - Fil d'actualités</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <link rel="stylesheet" href="chat.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
  </head>
    <body>

    <!-- En-tête -->

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
                                <a class="nav-link" href="chat.php?idUt=1">
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

        <!-- Messagerie -->

        <div class="container">
            <h3 class=" text-center text-white">Messagerie privée</h3>
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading">
                                <h4>Récent</h4>
                            </div>
                        </div>

                        <!-- Contacts messagerie -->

                        <div class="inbox_chat">

                            <?php affichercontacts($db,$_SESSION['idut']); ?>

                        </div>
                    </div>

                <!-- Messages -->

                <div class="mesgs card-body bg-dark text-white">
                    <div class="msg_history">

                                <?php 
                                    affichermessages($db,$_SESSION['idut'],$_GET['idUt']);
                                ?>

                                    <div class="type_msg">
                                        <div class="input_msg_write">
                                            <?php echo 
                                            '<form method="POST" action="chat.php?idUt='.$_GET['idUt'].'">'; ?>
                                                <input type="text" class="write_msg text-white" name="message" placeholder="Type a message" />
                                                <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="false"></i>&#x27A4;</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!--</div>
                    </div>-->
                </div>
            </div>
        </div>
    </body>
</html>
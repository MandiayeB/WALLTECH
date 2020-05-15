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
                            <a class="nav-link" href="modifier.php">
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
                        <li class="nav-item">
                            <a class="nav-link" href="accueil.php">
                            <!--<i class="fa fa-bell">
                                <span class="badge badge-info">11</span>  NOTIFICATION
                            </i>-->
                            Déconnexion
                            </a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Recherche" aria-label="Search">
                        <button class="btn btn-light my-2 my-sm-0" type="submit">Rechercher</button>
                    </form>
                </div>
        </nav>
<?php 

    /////////////////////////////////////////////////////
    /////////// Creation d'un compte ////////////////////
    ////////////////////////////////////////////////////

    function inscription ( $email, $password, $ipassword, $prenom, $nom, $db ){

        $q = $db -> prepare ("SELECT * FROM utilisateur WHERE email = :email");
        $q -> execute (['email'=>$email]);
        $result = $q -> fetch();

        if ( $result['email'] == $email ){

            echo "<strong> email deja existant </strong>";
        }

        else {
            if ( $ipassword == $password ){
                
                $i = $db->prepare ("INSERT INTO utilisateur (email,motdepasse,prenom,nom) VALUES (:email,:motdepasse,:prenom,:nom)" );
                $i -> execute ([

                'email' => $email,
                'motdepasse'=>$password,
                'prenom'=>$prenom,
                'nom'=>$nom
                
                ]);

                $t = $db->prepare ("INSERT INTO utilisateur2 (email,motdepasse,prenom,nom) VALUES (:email,:motdepasse,:prenom,:nom)" );
                $t -> execute ([

                'email' => $email,
                'motdepasse'=>$password,
                'prenom'=>$prenom,
                'nom'=>$nom
                
                ]);

                header("Location:accueil.php");
            }
            else {
                echo " Les mots de passe sont incorrect ";
            }
        }

    }
    
    /////////////////////////////////////////////////////////////////
    /////////////// Connexion d'un compte ///////////////////////////
    /////////////////////////////////////////////////////////////////

    function connexion ( $email, $password, $db ){
        
        $q = $db->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $q -> execute(['email'=>$email]);

        while ($user = $q->fetch()) {

            if($user['motdepasse'] == $password){
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['idut'] = $user['idUtilisateur'];
                $_SESSION['email'] = $email;
                header("Location:filactualites.php");
            }
            else {

                echo " <br> identifiant incorrect <br> ";
            
            }
        }

    }

    //////////////////////////////////////////////////////
    //////////////Fil d'actualité (PUBLIER) //////////////
    /////////////////////////////////////////////////////
    function postfile($texte, $user, $db) {

        $req = $db->prepare('INSERT INTO filactu (post, Utilisateur) VALUES (:post, :utilisateur)');
        $req->execute(array(
            'post' => $texte,
            'utilisateur' => $user
        ));
        $req->closeCursor();
        header("Location: publication.php");

    }

    //////////////////////////////////////////////////////
    //////////////Fil d'actualité (COMMENTER) ////////////
    /////////////////////////////////////////////////////

    function commenter($com, $user, $db, $idFil) {

        $req = $db->prepare('INSERT INTO commentaires (Utilisateur, filactu, com) VALUES (:utilisateur, :filactu, :com)');
        $req->execute(array(
            'utilisateur' => $user,
            'filactu' => $idFil,
            'com' => $com
        ));
        $req->closeCursor();
        header("Location: publication.php");

    }

    //////////////////////////////////////////////////////
    //////////////Fil d'actualité (AFFICHER) /////////////
    /////////////////////////////////////////////////////
    

    function afficherfile($db) {
        
        //$req = $db->query('SELECT * FROM filactu ORDER BY heurepost DESC');
        $req = $db->query('SELECT * FROM filactu INNER JOIN utilisateur ON filactu.Utilisateur = utilisateur.idUtilisateur ORDER BY heurepost DESC');

        while ($donnees = $req->fetch()) {                                         /////////////////////Fil d'actualité (AFFICHER PUBLICATION)///////////////////////
            
            $reponse=$db->prepare('SELECT * FROM commentaires INNER JOIN utilisateur ON commentaires.Utilisateur = utilisateur.idUtilisateur WHERE filactu = :filactu');
            $reponse->execute(array(
                'filactu' => $donnees['idFil']
            ));
            
            echo '<div class="card gedf-card bg-dark text-white">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0">'.$donnees['prenom'].' '.$donnees['nom'].'</div>
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
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>'.$donnees['heurepost'].'</div>

                        <p class="card-text">
                            '.$donnees['post'].'
                        </p>
                    </div>
                    <form method = "POST">
                        <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip" name="like"></i> Like</a>
                            <input type="text" class="form-control" name="comment" id="message" rows="3" placeholder="Abdellah">
                            <input type="hidden" name="idFil" value="'.$donnees['idFil'].'">
                            <input type="submit" name="pubcom" class="btn btn-light" value="Commenter">
                            ',/*<a href="#" class="card-link"><i class="fa fa-mail-forward" name="share"></i> Partager</a>*/'
                        </div>
                    </form>';

            while($donnees2 = $reponse->fetch()) {                                ////////////////Fil d'actualité (AFFICHER COMMENTAIRES)////////////////

                echo '<div class="mr-2">
                        <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                    </div>
                    <div class="ml-2">
                        <div class="h5 m-0">'.$donnees2['prenom'].' '.$donnees2['nom'].'</div>
                            <div class="h7 text-muted">Nom complet</div>
                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>'.$donnees2['heureCom'].'</div>
                                <p class="card-text">
                                '.$donnees2['com'].'
                                </p>
                            </div>';

            }
            echo '</div>';
        }
    }
    
?>
<?php 

    ///////////////////////////////////////////////////////
    //////////////// Creation d'un compte ////////////////
    /////////////////////////////////////////////////////

    function inscription ( $email, $password, $ipassword, $prenom, $nom, $db, $filename, $tmpname ){

        $q = $db -> prepare ( "SELECT * FROM utilisateur WHERE email = :email" );
        $q -> execute ( ['email'=>$email] );
        $result = $q -> fetch();

        if ( $result['email'] == $email ){

            echo "<strong> email déjà existant </strong>";
        }

        else {
            if ( $ipassword == $password ){

                $hasher = password_hash($password,PASSWORD_BCRYPT);
                $name_file = $filename;
                $tmp_name = $tmpname;
                $local_image = "C:/wamp64/www/Walltech/images/";
                $chemin = "images/".$name_file;
                move_uploaded_file ( $tmp_name , $local_image.$name_file);
                
                $i = $db->prepare ( "INSERT INTO utilisateur ( email, motdepasse, prenom, nom, photodeprofil ) 
                                        VALUES ( :email, :motdepasse, :prenom, :nom, :photo )" );

                $i -> execute ([

                'email' => $email,
                'motdepasse' => $hasher,
                'prenom' => $prenom,
                'nom' => $nom,
                'photo' => $chemin
                
                ]);

                $t = $db->prepare ( "INSERT INTO utilisateur2 ( email, motdepasse, prenom, nom, photodeprofil) 
                                        VALUES ( :email, :motdepasse, :prenom, :nom, :photo )" );

                $t -> execute ([

                'email' => $email,
                'motdepasse' => $hasher,
                'prenom' => $prenom,
                'nom' => $nom,
                'photo' => $chemin
                
                ]);

                header( "Location:accueil.php" );
            }
            else {
                echo " Les mots de passes sont incorrects ";
            }
        }

    }
    
    ///////////////////////////////////////////////////////
    /////////////// Connexion d'un compte ////////////////
    /////////////////////////////////////////////////////

    function connexion ( $email, $password, $db ){
        
        $q = $db->prepare( "SELECT * FROM utilisateur WHERE email = :email" );
        $q -> execute( ['email'=>$email] );

        $user = $q->fetch();
        
        //if($password == $user['motdepasse']){

        if (password_verify($password, $user["motdepasse"])){

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

    ///////////////////////////////////////////////////////
    ///////////// Fil d'actualité (PUBLIER) //////////////
    /////////////////////////////////////////////////////
    
    function postfile ( $texte, $user, $db, $filename, $tmpname, $test) {

        if ( $test ) {

            $name_file = $filename;
            $tmp_name = $tmpname;
            $local_image = "C:/wamp64/www/Walltech/images/";
            $chemin = "images/".$name_file;
            move_uploaded_file ( $tmp_name , $local_image.$name_file);

        } else {

            $chemin = 'non';

        }

        $req = $db->prepare( 'INSERT INTO filactu ( post, Utilisateur, img ) VALUES ( :post, :utilisateur, :img )' );
        $req->execute(array(
            'post' => $texte,
            'utilisateur' => $user,
            'img' => $chemin
        ));
        $req->closeCursor();
        header( "Location: publication.php" );

    }

    ///////////////////////////////////////////////////////
    ///////////// Fil d'actualité (PUBLIER SONDAGE) /////////////
    /////////////////////////////////////////////////////

    function postSondage ($poll1, $poll2, $db, $texte, $user) {

        $req = $db->prepare( 'INSERT INTO filactu ( post, Utilisateur, sondage ) VALUES ( :post, :utilisateur, :sondage )' );
        $req->execute(array(
            'post' => $texte,
            'utilisateur' => $user,
            'sondage' => 1
        ));
        $req->closeCursor();

        $req0=$db->prepare( 'SELECT * FROM filactu WHERE post = :texte AND Utilisateur = :user' );
        $req0->execute(array(
            'texte'=>$texte,
            'user'=>$user
        ));

        $data=$req0->fetch();

        $req1 = $db->prepare( 'INSERT INTO sondage ( idFil, choix, pollcontent ) VALUES ( :idFil, :choix, :pollcontent)');
        $req1->execute(array(
            'idFil' => $data['idFil'],
            'choix' => 1,
            'pollcontent' => $poll1
        ));
        $req1->closeCursor();

        $req2 = $db->prepare( 'INSERT INTO sondage ( idFil, choix, pollcontent ) VALUES ( :idFil, :choix, :pollcontent)');
        $req2 ->execute(array(
            'idFil' => $data['idFil'],
            'choix' => 2,
            'pollcontent' => $poll2
        ));
        $req2 ->closeCursor();

        header( "Location: publication.php" );    
    }

    ///////////////////////////////////////////////////////
    ///////////// Fil d'actualité (COMMENTER) ////////////
    /////////////////////////////////////////////////////

    function commenter ( $com, $user, $db, $idFil ) {

        $req = $db->prepare( 'INSERT INTO commentaires ( Utilisateur, filactu, com ) VALUES ( :utilisateur, :filactu, :com )');
        $req->execute(array(
            'utilisateur' => $user,
            'filactu' => $idFil,
            'com' => $com
        ));
        $req->closeCursor();
        header( "Location: publication.php" );

    }

    ///////////////////////////////////////////////////////
    ///////////// Fil d'actualité (AFFICHER) /////////////
    /////////////////////////////////////////////////////
    

    function afficherfile ( $db, $user ) {
        
        //$req = $db->query('SELECT * FROM filactu ORDER BY heurepost DESC');
        $req = $db->query( 'SELECT * FROM filactu INNER JOIN utilisateur ON 
                filactu.Utilisateur = utilisateur.idUtilisateur ORDER BY heurepost DESC' );
        
        while ( $donnees = $req->fetch() ) {                                         /////////////////////Fil d'actualité (AFFICHER PUBLICATION)///////////////////////
            
            $reponse=$db->prepare( 'SELECT * FROM commentaires INNER JOIN utilisateur ON 
                    commentaires.Utilisateur = utilisateur.idUtilisateur WHERE filactu = :filactu ORDER BY heureCom' );
            $reponse->execute(array(
                'filactu' => $donnees['idFil']
            ));

            $req2 = $db->prepare( 'SELECT COUNT(*) FROM commentaires WHERE filactu = :filactu' );
            $req2->execute(array(
                'filactu' => $donnees['idFil']
            ));
            $data = $req2->fetch();

            $req3 = $db->prepare( 'SELECT COUNT(*) FROM likefil WHERE idFil = :fil' );
            $req3->execute(array(
                'fil' => $donnees['idFil']
            ));
            $data2 = $req3->fetch();

            $req4 = $db->prepare( 'SELECT COUNT(*) FROM likefil WHERE idFil = :fil AND Utilisateur = :user' );
            $req4->execute(array(
                'fil' => $donnees['idFil'],
                'user' => $user
            ));
            $data3 = $req4->fetch();
            
            echo '<div id="id'.$donnees['idFil'].'" class="card gedf-card bg-dark text-white">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" height="45" src="'.photodeprofil( $db, $donnees['idUtilisateur']).'" 
                                        alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h4 m-0">'.$donnees['prenom'].' '.$donnees['nom'].'</div>
                                    <div class="h7 text-muted">Nom complet</div>
                                    <div class="t text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>'.$donnees['heurepost'].'</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">';

            if( $donnees['img'] != 'non' ) {

                echo '<img width="200" height="175" src="'.$donnees['img'].'" alt="">';

            }
                    echo     '<p class="card-text">'.$donnees['post'].'</p>
                    </div>
                    <form method = "POST">
                        <div class="card-footer d-flex flex-row-reverse">
                            
                            <button type="submit" name="pubcom" class="btn btn-light" style="background-color: transparent; border: none;">
                                <img src="arrow.png" width="25px" height="25px" />
                            </button>
                            <input type="text" class="w-75 form-control" name="comment" id="message" rows="3" placeholder="Répondre">
                            <input type="hidden" name="idFil" value="'.$donnees['idFil'].'">';

                            if ( $data2['COUNT(*)'] > 0 ) {

                                echo '<div class="h6 m-0 col">'.$data2['COUNT(*)'].'</div>';

                            } else {

                                echo '<div class="h6 m-0 col"></div>';

                            }
                            
                            if ( $data3['COUNT(*)'] > 0 ) {

                                echo '<button type="submit" name="like" class="btn btn-light" style="background-color: transparent; border: none;">
                                        <img src="heart.png" width="25px" height="25px" />
                                      </button>';

                            } else {
                                
                                echo '<button type="submit" name="like" class="btn btn-light" style="background-color: transparent; border: none;">
                                        <img src="noheart.png" width="25px" height="25px" />
                                      </button>';

                            }
                      echo /*<a href="#" class="card-link"><i class="fa fa-mail-forward" name="share"></i> Partager</a>*/
                        '</div>
                    </form>';
                
                if ( $data['COUNT(*)'] > 0 ) {
                    echo '<div class="list-group">
                            <a href="#id'.$donnees['idFil'].'" onclick="return false" class="list-group-item bg-dark">Commentaires</a>
                                <div class="list-group">';
                }

            
            while ( $donnees2 = $reponse->fetch() ) {      ////////////////Fil d'actualité (AFFICHER COMMENTAIRES)////////////////

                echo '<div class="geser gedf-card bg-dark text-white">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="30" height="30" src="'.photodeprofil( $db, $donnees2['idUtilisateur']).'" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h6 m-0">'.$donnees2['prenom'].' '.$donnees2['nom'].'</div>
                                        <div class="h7 text-muted">Nom complet</div>
                                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>'.$donnees2['heureCom'].'</div>
                                    </div>
                                </div>
                            </div>
                                    
                            <div class="card-body">
                                <p class="komen">'.$donnees2['com'].'</p>
                            </div>
                        </div>
                    </div>';
            }
            if ( $data['COUNT(*)'] > 0 ) {
                echo '      </div>
                        </div>';
            }
            echo '</div>';

        }
    }

    ///////////////////////////////////////////////////////
    ////////// Fil d'actualité (PHOTO DE PROFIL) /////////
    /////////////////////////////////////////////////////

    function photodeprofil ( $db, $user ) {
        $req = $db->prepare( 'SELECT * FROM utilisateur WHERE idUtilisateur = :idut' );
        $req->execute(array(

            'idut' => $user

        ));
        $donnees = $req->fetch();

        return $donnees['photodeprofil'];
    }

    ///////////////////////////////////////////////////////
    ///////////// Fil d'actualité (LIKE) /////////////////
    /////////////////////////////////////////////////////

    function likepost ( $db, $idFil, $user ) {

        $req = $db->prepare('SELECT COUNT(*) FROM likefil WHERE idFil = :idFil AND Utilisateur = :idUt');
        $req->execute(array(
            'idFil' => $idFil,
            'idUt' => $user
        ));
        $data = $req->fetch();
        
        if( $data['COUNT(*)'] == 0 ) {
            $req2 = $db->prepare('INSERT INTO likefil (idFil, Utilisateur) VALUES (:idFil, :Utilisateur)');
            $req2->execute(array(
                'idFil' => $idFil,
                'Utilisateur' => $user
                
            ));
            $req2->closeCursor();

        } else if ( $data['COUNT(*)'] > 0 ) {
            $req3 = $db->prepare('DELETE FROM likefil WHERE idFil = :idFil AND Utilisateur = :user');
            $req3->execute(array(
                'idFil' => $idFil,
                'user' => $user
                
            ));
            $req3->closeCursor();
        }

        header("Location: publication.php");
    }

    ///////////////////////////////////////////////////////
    /////////// Messagerie (AFFICHER CONTACTS) ///////////
    /////////////////////////////////////////////////////

    function affichercontacts ( $db, $idut ) {

        $req = $db->prepare('SELECT * FROM utilisateur2 WHERE idUtilisateur2 != :idUt');
        $req->execute(array(
            'idUt' => $idut
        ));

        while ($donnees = $req->fetch()) {
            
            echo '<a href="chat.php?idUt='.$donnees['idUtilisateur2'].'">';

            if(isset($_GET['idUt']) AND $_GET['idUt'] == $donnees['idUtilisateur2']) {
                echo '<div class="chat_list active_chat">';
            } else {
                echo '<div class="chat_list">';
            }
            echo        '<div class="chat_people">
                            <div class="chat_img"> 
                                <img class="rounded-circle" width="45" height="45" 
                                    src="'.photodeprofil( $db, $donnees['idUtilisateur2']).'" alt="sunil"> 
                            </div>
                            <div class="chat_ib">
                                <h5>'.$donnees['prenom'].' '.$donnees['nom'].'<span class="chat_date">DATE</span></h5>
                                <p>2e exemple messages privés.</p>
                            </div>
                        </div>
                    </div>
                </a>';
        }
    }


    ///////////////////////////////////////////////////////
    ///////////// Messagerie (POSTER MESSAGES) ///////////
    /////////////////////////////////////////////////////

    function postmessages ( $db, $message, $utilisateur, $recepteur ) {
        $req = $db->prepare( 'INSERT INTO messages ( Envoyeur, Recepteur, Messagecontent ) 
                                VALUES ( :envoyeur, :recepteur, :messagecontent )' );
        $req->execute(array(
            'envoyeur' => $utilisateur,
            'recepteur' => $recepteur,
            'messagecontent' => $message
        ));
        $req->closeCursor();
        header( 'Location: message.php?idUt='.$recepteur.'' );
    }

    ///////////////////////////////////////////////////////
    /////////// Messagerie (AFFICHER MESSAGES) ///////////
    /////////////////////////////////////////////////////

    function affichermessages ( $db ,$ut1, $ut2 ) {
        $req = $db->prepare( 'SELECT * FROM messages WHERE Envoyeur = :ut1 OR Envoyeur = :ut2 
                                AND Recepteur = :ut1 OR Recepteur = :ut2' );
        $req->execute(array(
            'ut1' => $ut1,
            'ut2' => $ut2
        ));

        while ( $donnees = $req->fetch() ) {
            if ( $donnees['Envoyeur'] == $ut1 AND $donnees['Recepteur'] == $ut2 ) {
                echo '<div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>'.$donnees['Messagecontent'].'</p>
                            <span class="time_date">'.$donnees['datemessage'].'</div>
                      </div>';

            } else if ( $donnees['Envoyeur'] == $ut2 AND $donnees['Recepteur'] == $ut1 ) {
                echo'<div class="incoming_msg">
                        <div class="incoming_msg_img"><img class="rounded-circle" width="45" height="45"
                            src="'.photodeprofil( $db, $donnees['Envoyeur']).'" alt="sunil"></div>
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p>'.$donnees['Messagecontent'].'</p>
                                    <span class="time_date">'.$donnees['datemessage'].'</span>
                                </div>
                            </div>
                    </div>';
            }
        }
    }

    
    ///////////////////////////////////////////////////////////
    ////////////// Changement de mot de passe ////////////////
    /////////////////////////////////////////////////////////


    function modifier ( $email, $motdepasse, $confirme, $iconfirme, $db ){


        $q = $db -> prepare( "SELECT * FROM utilisateur WHERE email = :email" );
        $q-> execute( ['email'=>$email] );
        $result = $q -> fetch();
        
        if (password_verify($motdepasse,$result['motdepasse'])) {

            if( $confirme != "" ){    
        
                if( $confirme == $iconfirme ){

                    $f =$db -> prepare( "UPDATE utilisateur SET motdepasse = :mdp WHERE email = :email" );
                    $iconfirme = password_hash($iconfirme, PASSWORD_BCRYPT);
                    $f -> execute ([
                        'email'=>$email,
                        'mdp'=>$iconfirme
                        ]);
                    $b = $db -> prepare( "UPDATE utilisateur2 SET motdepasse = :mdp WHERE email = :email" );
                    $b -> execute ([
                        'email'=>$email,
                        'mdp'=>$iconfirme
                        ]);
                    header( 'Location:modifier.php' );

                }

                else {
                    echo "Les deux mots de passe ne sont pas identique";
                }

            }
            else {
                echo "Vous n'avez pas remplit le nouveau mot de passe";
            }

        }
        else {
            echo "Le mot de passe est incorrect";
        }
    }

?>

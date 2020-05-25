<?php 

    ///////////////////////////////////////////////////////
    ////////////// Creation d'un compte (1) //////////////
    /////////////////////////////////////////////////////

    function inscription ( $email, $password, $ipassword, $prenom, $nom, $db ){

        $q = $db -> prepare ( "SELECT * FROM utilisateur WHERE email = :email" );
        $q -> execute ( ['email'=>$email] );
        $result = $q -> fetch();

        if ( $result['email'] == $email ){

            echo "<strong> email déjà existant </strong>";
        }

        else {
            if ( $ipassword == $password ){

                $hasher = password_hash($password,PASSWORD_BCRYPT);

                $_SESSION['email'] = $email;

                $i = $db->prepare ( "INSERT INTO utilisateur ( email, motdepasse, prenom, nom ) 
                                        VALUES ( :email, :motdepasse, :prenom, :nom )" );

                $i -> execute ([

                'email' => $email,
                'motdepasse' => $hasher,
                'prenom' => $prenom,
                'nom' => $nom
                
                ]);

                $t = $db->prepare ( "INSERT INTO utilisateur2 ( email, motdepasse, prenom, nom ) 
                                        VALUES ( :email, :motdepasse, :prenom, :nom )" );

                $t -> execute ([

                'email' => $email,
                'motdepasse' => $hasher,
                'prenom' => $prenom,
                'nom' => $nom
                
                ]);

                header( "Location:inscription.php?good=on" );
            }
            else {
                echo " Les mots de passes sont incorrects ";
            }
        }

    }
    
    ///////////////////////////////////////////////////////
    ////////////// Creation d'un compte (2) //////////////
    /////////////////////////////////////////////////////

    function final_inscription ( $db, $filename, $tmpname, $email, $role, $prof ) {
        
        $name_file = $filename;
        $tmp_name = $tmpname;
        $local_image = "C:/xampp/htdocs/Walltech/images/";
        $chemin = "images/".$name_file;
        move_uploaded_file ( $tmp_name , $local_image.$name_file );

        $req = $db -> prepare( 'UPDATE utilisateur SET photodeprofil = :img WHERE email = :email' );
        $req -> execute([
            'img' => $chemin,
            'email' => $email
        ]);

        $req2 = $db -> prepare( 'UPDATE utilisateur2 SET photodeprofil = :img WHERE email = :email' );
        $req2 -> execute([
            'img' => $chemin,
            'email' => $email
        ]);
        
        $id = $db -> prepare( 'SELECT * FROM utilisateur WHERE email = :email' );
        $id -> execute([
            'email' => $email
        ]);
        $data = $id -> fetch();

        if ( $role == 'sem1' ) {
            
            $sem1 = $db -> prepare( 'INSERT INTO semestre1( Utilisateur ) VALUES ( :user )' );
            $sem1 -> execute([
                'user' => $data['idUtilisateur']
            ]);

        } else if ( $role == 'sem2' ) {
            
            $sem2 = $db -> prepare( 'INSERT INTO semestre2( Utilisateur ) VALUES ( :user )' );
            $sem2 -> execute([
                'user' => $data['idUtilisateur']
            ]);
            
        } else if ( $role == 'sem3' ) {
            
            $sem3 = $db -> prepare( 'INSERT INTO semestre3( Utilisateur ) VALUES ( :user )' );
            $sem3 -> execute([
                'user' => $data['idUtilisateur']
            ]);
            
        } else if ( $role == 'sem4' ) {
            
            $sem4 = $db -> prepare( 'INSERT INTO semestre4( Utilisateur ) VALUES ( :user )' );
            $sem4 -> execute([
                'user' => $data['idUtilisateur']
            ]);
            
        } else if ( $role == 'sem5' ) {
            
            $sem5 = $db -> prepare( 'INSERT INTO semestre5( Utilisateur ) VALUES ( :user )' );
            $sem5 -> execute([
                'user' => $data['idUtilisateur']
            ]);
            
        } else if ( $role == 'sem6' ) {
            
            $sem6 = $db -> prepare( 'INSERT INTO semestre6( Utilisateur ) VALUES ( :user )' );
            $sem6 -> execute([
                'user' => $data['idUtilisateur']
            ]);
            
        } else if ( $role == 'sem7' ) {
            
            $sem7 = $db -> prepare( 'INSERT INTO semestre7( Utilisateur ) VALUES ( :user )' );
            $sem7 -> execute([
                'user' => $data['idUtilisateur']
            ]);
            
        } else if ( $role == 'sem8' ) {
            
            $sem8 = $db -> prepare( 'INSERT INTO semestre8( Utilisateur ) VALUES ( :user )' );
            $sem8 -> execute([
                'user' => $data['idUtilisateur']
            ]);
            
        } else if ( $role == 'sem9' ) {
            
            $sem9 = $db -> prepare( 'INSERT INTO semestre9( Utilisateur ) VALUES ( :user )' );
            $sem9 -> execute([
                'user' => $data['idUtilisateur']
            ]);
            
        } else if ( $role == 'sem10' ) {
            
            $sem10 = $db -> prepare( 'INSERT INTO semestre10( Utilisateur ) VALUES ( :user )' );
            $sem10 -> execute([
                'user' => $data['idUtilisateur']
            ]);
            
        }

        foreach ( $prof as $value ) {

            if ( $value == 'profs1') {
                
                $prof1 = $db -> prepare( 'INSERT INTO semestre1( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof1 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
            
            if ( $value == 'profs2' ) {
                
                $prof2 = $db -> prepare( 'INSERT INTO semestre2( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof2 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
            
            if ( $value == 'profs3' ) {
                
                $prof3 = $db -> prepare( 'INSERT INTO semestre3( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof3 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
            
            if ( $value == 'profs4' ) {
                
                $prof4 = $db -> prepare( 'INSERT INTO semestre4( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof4 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
            
            if ( $value == 'profs5' ) {
                
                $prof5 = $db -> prepare( 'INSERT INTO semestre5( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof5 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
            
            if ( $value == 'profs6' ) {
                
                $prof6 = $db -> prepare( 'INSERT INTO semestre6( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof6 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
            
            if ( $value == 'profs7' ) {
                
                $prof7 = $db -> prepare( 'INSERT INTO semestre7( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof7 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
            
            if ( $value == 'profs8' ) {
                
                $prof8 = $db -> prepare( 'INSERT INTO semestre8( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof8 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
            
            if ( $value == 'profs9' ) {
                
                $prof9 = $db -> prepare( 'INSERT INTO semestre9( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof9 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
            
            if ( $value == 'profs10' ) {
                
                $prof10 = $db -> prepare( 'INSERT INTO semestre10( Utilisateur, prof ) VALUES ( :user, :prof )' );
                $prof10 -> execute([
                    'user' => $data['idUtilisateur'],
                    'prof' => 1
                ]);
                
            }
        }

        $_SESSION['prenom'] = $data['prenom'];
        $_SESSION['nom'] = $data['nom'];
        $_SESSION['idut'] = $data['idUtilisateur'];
        $_SESSION['email'] = $data['email'];

        header("Location:bienvenue.php");
    }

    ///////////////////////////////////////////////////////
    /////////////// Connexion d'un compte ////////////////
    /////////////////////////////////////////////////////

    function connexion ( $email, $password, $db ){
        
        $q = $db->prepare( "SELECT * FROM utilisateur WHERE email = :email" );
        $q -> execute( ['email'=>$email] );

        $user = $q->fetch();

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
    
    function postfile ( $texte, $user, $db, $filename, $tmpname, $test ) {

        if ( $test ) {

            $name_file = $filename;
            $tmp_name = $tmpname;
            $local_image = "C:/xampp/htdocs/Walltech/images/";
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
    ///////////// Fil d'actualité (PUBLIER SONDAGE) //////
    /////////////////////////////////////////////////////

    function postSondage ($poll1, $poll2, $db, $texte, $user, $filename, $tmpname, $test) {

        if ( $test ) {

            $name_file = $filename;
            $tmp_name = $tmpname;
            $local_image = "C:/wamp64/www/Walltech/images/";
            $chemin = "images/".$name_file;
            move_uploaded_file ( $tmp_name , $local_image.$name_file);

        } else {

            $chemin = 'non';

        }

        /////////////////// Création du post ///////////////////////

        $req = $db->prepare( 'INSERT INTO filactu ( post, Utilisateur, sondage, img ) VALUES ( :post, :utilisateur, :sondage, :img )' );
        $req->execute(array(
            'post' => $texte,
            'utilisateur' => $user,
            'sondage' => 1,
            'img' => $chemin
        ));
        $req->closeCursor();

        //////////////// Récupération de l'ID du post //////////////

        $req0=$db->prepare( 'SELECT * FROM filactu WHERE post = :texte AND Utilisateur = :user AND sondage = :son' );
        $req0->execute(array(
            'texte' => $texte,
            'user' => $user,
            'son' => 1
        ));
        $data=$req0->fetch();

        //////////// Création des deux choix du sondage ////////////

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
    ///////////// Fil d'actualité (VOTER SONDAGE) /////////////
    /////////////////////////////////////////////////////

    function voteSondage( $db, $idFil, $user, $choix ) {
        
        $req2 = $db->prepare('INSERT INTO checksondage (idFil, Utilisateur, choix) VALUES (:idFil, :Utilisateur, :choix)');
        $req2->execute(array(
            'idFil' => $idFil,
            'Utilisateur' => $user,
            'choix'=> $choix
        ));
        $req2->closeCursor();

        $req1 = $db->prepare( 'UPDATE sondage SET nbvotes = nbvotes+1 WHERE idFil = :idFil');
        $req1->execute(array(
            'idFil' => $idFil

        ));
        $req1->closeCursor();

        header("Location: publication.php");

    }

    ///////////////////////////////////////////////////////
    ///////////// Fil d'actualité (COMMENTER) ////////////
    /////////////////////////////////////////////////////

    function commenter ( $com, $user, $db, $idFil ) {

        if ( !empty( $com ) ) {

            $req = $db->prepare( 'INSERT INTO commentaires ( Utilisateur, filactu, com ) VALUES ( :utilisateur, :filactu, :com )');
            $req->execute(array(
                'utilisateur' => $user,
                'filactu' => $idFil,
                'com' => $com
            ));
            $req->closeCursor();
            header( "Location: publication.php" );

        }

    }

    ///////////////////////////////////////////////////////
    ///////////// Fil d'actualité (AFFICHER) /////////////
    /////////////////////////////////////////////////////
    

    function afficherfile ( $db, $user ) {
        
        $req = $db->query( 'SELECT * FROM filactu INNER JOIN utilisateur ON 
                filactu.Utilisateur = utilisateur.idUtilisateur ORDER BY heurepost DESC' );
        
        while ( $donnees = $req->fetch() ) {       /////////////////////Fil d'actualité (AFFICHER PUBLICATION)///////////////////////
            
            $reponse=$db->prepare( 'SELECT * FROM commentaires INNER JOIN utilisateur ON 
                    commentaires.Utilisateur = utilisateur.idUtilisateur WHERE filactu = :filactu ORDER BY heureCom' );
            $reponse->execute(array(
                'filactu' => $donnees['idFil']
            ));

            $req2 = $db->prepare( 'SELECT COUNT(*) FROM commentaires WHERE filactu = :filactu' ); ////// Nombre de commentaires /////
            $req2->execute(array(
                'filactu' => $donnees['idFil']
            ));
            $data = $req2->fetch();

            $req3 = $db->prepare( 'SELECT COUNT(*) FROM likefil WHERE idFil = :fil' ); ////////// Nombre de like //////////
            $req3->execute(array(
                'fil' => $donnees['idFil']
            ));
            $data2 = $req3->fetch();

            $req4 = $db->prepare( 'SELECT COUNT(*) FROM likefil WHERE idFil = :fil AND Utilisateur = :user' ); /*Vérif like de l'utilisateur*/  
            $req4->execute(array(
                'fil' => $donnees['idFil'],
                'user' => $user
            ));
            $data3 = $req4->fetch();

            //////////////REPONSE DES SONDAGES/////////////

            $req5 = $db->prepare( 'SELECT * FROM sondage WHERE idFil = :idFil AND choix = 1' ); ////// Choix 1 /////////
            $req5->execute(array(
                'idFil' => $donnees['idFil']

            ));
            $data4 = $req5->fetch();

            $req6 = $db->prepare( 'SELECT * FROM sondage WHERE idFil = :idFil AND choix = 2' ); ////// Choix 2 /////////
            $req6->execute(array(
                'idFil' => $donnees['idFil']

            ));
            $data5 = $req6->fetch();
            
            //VOTE SONDAGE//

            $req7 = $db->prepare('SELECT COUNT(*) FROM checksondage WHERE idFil = :fil AND Utilisateur = :user' );
            $req7->execute(array(
                'fil'=>$donnees['idFil'],
                'user'=> $user
            ));
            $data6=$req7->fetch();

            $req8 = $db->prepare('SELECT * FROM checksondage WHERE idFil = :fil AND Utilisateur = :user' );
            $req8->execute(array(
                'fil'=>$donnees['idFil'],
                'user'=> $user
            ));
            $data7=$req8->fetch();
            
            echo '<div id="id'.$donnees['idFil'].'" class="card gedf-card bg-dark text-white">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" height="45" src="'.photodeprofil( $db, $donnees['idUtilisateur']).'" 
                                        alt="">
                                        
                                </div>
                                <div class="ml-2">
                                    <div class="h4 m-0">'.$donnees['prenom'].' '.$donnees['nom'].'</div>';
                                    
                                    afficherrole ( verifrole ( $db, $donnees['idUtilisateur'] ) );

                            echo   '<div class="t text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>'.$donnees['heurepost'].'</div>
                                </div>
                                
                            </div>';

                                if ( $user == $donnees['idUtilisateur'] ) {
                                    
                                    echo'<form method="POST">
                                            <div class ="col col-lg-2">
                                                <button type = "submit" name = "sup" value ="'.$donnees['idFil'].'" class="btn btn-light" style = "background-color: transparent; border: none;">
                                                    <img src = "button.png"  width="25px" height="25px">
                                                </button>
                                            </div>
                                        </form>';

                                }
                            
                    echo '</div>
                    </div>
                    <div class="card-body">';

            if( $donnees['img'] != 'non' ) {

                echo '<img width="200" height="175" src="'.$donnees['img'].'" alt="">';

            }

            echo     '<p class="card-text">'.$donnees['post'].'</p>';

            if ( $donnees['sondage'] == 1 ) {

                if($data6['COUNT(*)'] > 0) {

                    echo '<div class="card-block">
                        <ul class="list-group bg-dark">
                            <li class="list-group-item bg-dark">
                                <div class="radio bg-dark">
                                    <label>
                                    <span name="ch1" class="btn btn-transparent">';

                    if ($data7['choix'] == 1) {

                                echo '<img src="btnpollactive.png" width="20px" height="20px">';

                    } else {

                                echo '<img src="btnpoll.png" width="20px" height="20px">';

                    }

                                echo'</span>
                                    </label>
                                    '.$data4['pollcontent'].'
                                </div>
                                <div>
                                
                            </li>
                            <li class="list-group-item bg-dark">
                                <div class="radio bg-dark">
                                    <label>
                                    <span name="ch2" class="btn btn-transparent">';
                    
                    if ($data7['choix'] == 2) {

                                echo '<img src="btnpollactive.png" width="20px" height="20px">';

                    } else {

                                 echo '<img src="btnpoll.png" width="20px" height="20px">';

                    }

                                echo'</span>
                                    </label>
                                    '.$data5['pollcontent'].'
                                </div>
                            </li>
                        </ul>
                    </div>';

                } else {

                    echo '<div class="card-block">
                            <ul class="list-group bg-dark">
                                <form method="POST">
                                    <li class="list-group-item bg-dark">
                                        <div class="radio bg-dark">
                                            <label>
                                            <button type="submit" name="ch1" class="btn btn-transparent">
                                                <img src="btnpoll.png" width="20px" height="20px">
                                            </button>
                                            </label>
                                            '.$data4['pollcontent'].'
                                        </div>
                                    </li>
                                    <li class="list-group-item bg-dark">
                                        <div class="radio bg-dark">
                                            <label>
                                            <button type="submit" name="ch2" class="btn btn-transparent">
                                                <img src="btnpoll.png" width="20px" height="20px">
                                            </button>
                                            </label>
                                            '.$data5['pollcontent'].'
                                        </div>
                                    </li>
                                    <input type="hidden" value ="'.$donnees['idFil'].'" name="idFil">
                                </form>
                            </ul>
                        </div>';

                }
                
            }        
                    echo '</div>
                    <form method = "POST">
                        <div class="card-footer d-flex flex-row-reverse">
                            
                            <button type="submit" name="pubcom" class="btn btn-light col" style="background-color: transparent; border: none;">
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
                                        <div class="h6 m-0">'.$donnees2['prenom'].' '.$donnees2['nom'].'</div>';

                                        afficherrole ( verifrole ( $db, $donnees2['idUtilisateur'] ) );

                                  echo '<div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>'.$donnees2['heureCom'].'</div>
                                    </div>
                                </div>';
                                
                                if ( $user == $donnees2['Utilisateur'] ) {
                                
                                    echo'<div class ="col col-lg-2"> 
                                            <img src = "1077012.png"  width="25px" height="25px class="btn btn-light" style = "background-color: transparent; border: none;">
                                        </div>';

                                }

                    echo '</div>
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
                        <div class="incoming_msg_img">
                            <img class="rounded-circle" width="45" height="45" 
                                src="'.photodeprofil( $db, $donnees['Envoyeur']).'" alt="sunil">
                        </div>
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

    
    ///////////////////////////////////////////////////////
    ////////////// Changement de mot de passe ////////////
    /////////////////////////////////////////////////////


    function modifiermdp ( $email, $motdepasse, $confirme, $iconfirme, $db ) {


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

    ///////////////////////////////////////////////////////
    //////////// Changement de photo de profil ///////////
    /////////////////////////////////////////////////////

    function modifierphoto ( $db, $filename, $tmpname, $user ) { 

        $name_file = $filename;
        $tmp_name = $tmpname;
        $local_image = "C:/xampp/htdocs/Walltech/images/";
        $chemin = "images/".$name_file;
        move_uploaded_file ( $tmp_name , $local_image.$name_file);

        $req = $db -> prepare( 'UPDATE utilisateur SET photodeprofil = :img WHERE idUtilisateur = :idUt' );
        $req -> execute([
            'img' => $chemin,
            'idUt' => $user
        ]);

        $req2 = $db -> prepare( 'UPDATE utilisateur2 SET photodeprofil = :img WHERE idUtilisateur2 = :idUt' );
        $req2 -> execute([
            'img' => $chemin,
            'idUt' => $user
        ]);

    }

    ///////////////////////////////////////////////////////
    ////////////  Suppression de publication  ////////////
    /////////////////////////////////////////////////////

    function supprimerfila ( $id, $db ){

        $m = $db -> prepare( "DELETE FROM checksondage WHERE idFil = :id" );
        $m-> execute( ['id' => $id] );

        $y = $db -> prepare( "DELETE FROM sondage WHERE idFil = :id" );
        $y-> execute( ['id' => $id] );

        $reponse = $db -> prepare( "DELETE FROM likefil WHERE idFil = :id" );
        $reponse-> execute( ['id' => $id] );

        $z = $db -> prepare( "DELETE FROM commentaires WHERE filactu = :id" );
        $z-> execute( ['id' => $id] );

        $req = $db -> prepare( "DELETE FROM sondage WHERE idFil = :id" );
        $req-> execute( ['id' => $id] );

        $q = $db -> prepare( "DELETE FROM filactu WHERE idFil = :id" );
        $q-> execute( ['id' => $id] );
        
    }

    ///////////////////////////////////////////////////////
    ///////////////  Vérification de rôle  ///////////////
    /////////////////////////////////////////////////////

    function verifrole ( $db, $user ) {

        $role = array(

            'sem1' => 0,
            'sem2' => 0,
            'sem3' => 0,
            'sem4' => 0,
            'sem5' => 0,
            'sem6' => 0,
            'sem7' => 0,
            'sem8' => 0,
            'sem9' => 0,
            'sem10' => 0

        );

        
        ///////////////////////////////////////////////////////
        //////////////////////  ELEVES  //////////////////////
        /////////////////////////////////////////////////////

        $sem1 = $db -> prepare( 'SELECT COUNT(*) FROM semestre1 WHERE Utilisateur = :user' );
        $sem1 -> execute( ['user'=>$user] );
        $result = $sem1 -> fetch();
        $role['sem1'] = $result['COUNT(*)'];

        $sem2 = $db -> prepare( 'SELECT COUNT(*) FROM semestre2 WHERE Utilisateur = :user' );
        $sem2 -> execute( ['user'=>$user] );
        $data = $sem2 -> fetch();
        $role['sem2'] = $data['COUNT(*)'];

        $sem3 = $db -> prepare( 'SELECT COUNT(*) FROM semestre3 WHERE Utilisateur = :user' );
        $sem3 -> execute( ['user'=>$user] );
        $donnees = $sem3 -> fetch();
        $role['sem3'] = $donnees['COUNT(*)'];

        $sem4 = $db -> prepare( 'SELECT COUNT(*) FROM semestre4 WHERE Utilisateur = :user' );
        $sem4 -> execute( ['user'=>$user] );
        $donnees = $sem4 -> fetch();
        $role['sem4'] = $donnees['COUNT(*)'];

        $sem5 = $db -> prepare( 'SELECT COUNT(*) FROM semestre5 WHERE Utilisateur = :user' );
        $sem5 -> execute( ['user'=>$user] );
        $donnees = $sem5 -> fetch();
        $role['sem5'] = $donnees['COUNT(*)'];

        $sem6 = $db -> prepare( 'SELECT COUNT(*) FROM semestre6 WHERE Utilisateur = :user' );
        $sem6 -> execute( ['user'=>$user] );
        $donnees = $sem6 -> fetch();
        $role['sem6'] = $donnees['COUNT(*)'];

        $sem7 = $db -> prepare( 'SELECT COUNT(*) FROM semestre7 WHERE Utilisateur = :user' );
        $sem7 -> execute( ['user'=>$user] );
        $donnees = $sem7 -> fetch();
        $role['sem7'] = $donnees['COUNT(*)'];

        $sem8 = $db -> prepare( 'SELECT COUNT(*) FROM semestre8 WHERE Utilisateur = :user' );
        $sem8 -> execute( ['user'=>$user] );
        $donnees = $sem8 -> fetch();
        $role['sem8'] = $donnees['COUNT(*)'];

        $sem9 = $db -> prepare( 'SELECT COUNT(*) FROM semestre9 WHERE Utilisateur = :user' );
        $sem9 -> execute( ['user'=>$user] );
        $donnees = $sem9 -> fetch();
        $role['sem9'] = $donnees['COUNT(*)'];

        $sem10 = $db -> prepare( 'SELECT COUNT(*) FROM semestre10 WHERE Utilisateur = :user' );
        $sem10 -> execute( ['user'=>$user] );
        $donnees = $sem10 -> fetch();
        $role['sem10'] = $donnees['COUNT(*)'];

        ///////////////////////////////////////////////////////
        ///////////////////  PROFESSEURS  ////////////////////
        /////////////////////////////////////////////////////

        $prof1 = $db -> prepare( 'SELECT COUNT(*) FROM semestre1 WHERE Utilisateur = :user AND prof = 1' );
        $prof1 -> execute( ['user'=>$user] );
        $result = $prof1 -> fetch();
        $role['sem1'] += $result['COUNT(*)'];

        $prof2 = $db -> prepare( 'SELECT COUNT(*) FROM semestre2 WHERE Utilisateur = :user AND prof = 1' );
        $prof2 -> execute( ['user'=>$user] );
        $data = $prof2 -> fetch();
        $role['sem2'] += $data['COUNT(*)'];

        $prof3 = $db -> prepare( 'SELECT COUNT(*) FROM semestre3 WHERE Utilisateur = :user AND prof = 1' );
        $prof3 -> execute( ['user'=>$user] );
        $donnees = $prof3 -> fetch();
        $role['sem3'] += $donnees['COUNT(*)'];

        $prof4 = $db -> prepare( 'SELECT COUNT(*) FROM semestre4 WHERE Utilisateur = :user AND prof = 1' );
        $prof4 -> execute( ['user'=>$user] );
        $donnees = $prof4 -> fetch();
        $role['sem4'] += $donnees['COUNT(*)'];

        $prof5 = $db -> prepare( 'SELECT COUNT(*) FROM semestre5 WHERE Utilisateur = :user AND prof = 1' );
        $prof5 -> execute( ['user'=>$user] );
        $donnees = $prof5 -> fetch();
        $role['sem5'] += $donnees['COUNT(*)'];

        $prof6 = $db -> prepare( 'SELECT COUNT(*) FROM semestre6 WHERE Utilisateur = :user AND prof = 1' );
        $prof6 -> execute( ['user'=>$user] );
        $donnees = $prof6 -> fetch();
        $role['sem6'] += $donnees['COUNT(*)'];

        $prof7 = $db -> prepare( 'SELECT COUNT(*) FROM semestre7 WHERE Utilisateur = :user AND prof = 1' );
        $prof7 -> execute( ['user'=>$user] );
        $donnees = $prof7 -> fetch();
        $role['sem7'] += $donnees['COUNT(*)'];

        $prof8 = $db -> prepare( 'SELECT COUNT(*) FROM semestre8 WHERE Utilisateur = :user AND prof = 1' );
        $prof8 -> execute( ['user'=>$user] );
        $donnees = $prof8 -> fetch();
        $role['sem8'] += $donnees['COUNT(*)'];

        $prof9 = $db -> prepare( 'SELECT COUNT(*) FROM semestre9 WHERE Utilisateur = :user AND prof = 1' );
        $prof9 -> execute( ['user'=>$user] );
        $donnees = $prof9 -> fetch();
        $role['sem9'] += $donnees['COUNT(*)'];

        $prof10 = $db -> prepare( 'SELECT COUNT(*) FROM semestre10 WHERE Utilisateur = :user AND prof = 1' );
        $prof10 -> execute( ['user'=>$user] );
        $donnees = $prof10 -> fetch();
        $role['sem10'] += $donnees['COUNT(*)'];
        
        return $role;

    }

    ///////////////////////////////////////////////////////
    ////////////////  Affichage du rôle  /////////////////
    /////////////////////////////////////////////////////

    function afficherrole ( $role ) {

        ///////////////////////////////////////////////////////
        /////////////////  Affichage Élève  //////////////////
        /////////////////////////////////////////////////////

        if ( $role['sem1'] == 1 ) {

            echo '<div class="h7 text-primary">Élève S1</div>';

        } else if ( $role['sem2'] == 1 ) {

            echo '<div class="h7 text-success">Élève S2</div>';

        } else if ( $role['sem3'] == 1 ) {

            echo '<div class="h7 text-danger">Élève S3</div>';

        } else if ( $role['sem4'] == 1 ) {

            echo '<div class="h7 text-warning">Élève S4</div>';

        } else if ( $role['sem5'] == 1 ) {

            echo '<div class="h7 text-info">Élève S5</div>';

        } else if ( $role['sem6'] == 1 ) {

            echo '<div class="h7" style="color: #007E33;">Élève S6</div>';

        } else if ( $role['sem7'] == 1 ) {

            echo '<div class="h7" style="color: #2BBBAD;">Élève S7</div>';

        } else if ( $role['sem8'] == 1 ) {

            echo '<div class="h7" style="color: #9933CC;">Élève S8</div>';

        } else if ( $role['sem9'] == 1 ) {

            echo '<div class="h7" style="color: #0d47a1;">Élève S9</div>';

        } else if ( $role['sem10'] == 1 ) {

            echo '<div class="h7" style="color: #CC0000;">Élève S10</div>';

        }

        ///////////////////////////////////////////////////////
        //////////////  Affichage Professeur  ////////////////
        /////////////////////////////////////////////////////

        echo '<div class="d-flex">';
        $facto = 0;
        
        if ( $role['sem1'] > 1 ) {

            echo '<div class="h7 text-primary">Professeur S1 </div>&nbsp&nbsp';
            $facto++;
    
        }

        if ( $role['sem2'] > 1 ) {

            if ( $facto > 0 ) {

                echo '<div class="h7 text-success">S2</div>&nbsp&nbsp';

            } else {

                echo '<div class="h7 text-success">Professeur S2</div>&nbsp&nbsp';
                $facto++;

            }

        }

        if ( $role['sem3'] > 1 ) {

            if ( $facto > 0 ) {

                echo '<div class="h7 text-danger">S3</div>&nbsp&nbsp';

            } else {

                echo '<div class="h7 text-danger">Professeur S3</div>&nbsp&nbsp';
                $facto++;

            }

        }

        if ( $role['sem4'] > 1 ) {

            if ( $facto > 0 ) {

                echo '<div class="h7 text-warning">S4</div>&nbsp&nbsp';

            } else {

                echo '<div class="h7 text-warning">Professeur S4</div>&nbsp&nbsp';
                $facto++;

            }

        }

        if ( $role['sem5'] > 1 ) {

            if ( $facto > 0 ) {

                echo '<div class="h7 text-info">S5</div>&nbsp&nbsp';

            } else {

                echo '<div class="h7 text-info">Professeur S5</div>&nbsp&nbsp';
                $facto++;

            }

        }

        if ( $role['sem6'] > 1 ) {

            if ( $facto > 0 ) {

                echo '<div class="h7" style="color: #007E33;">S6</div>&nbsp&nbsp';

            } else {

                echo '<div class="h7" style="color: #007E33;">Professeur S6</div>&nbsp&nbsp';
                $facto++;

            }

        }

        if ( $role['sem7'] > 1 ) {

            if ( $facto > 0 ) {

                echo '<div class="h7" style="color: #2BBBAD;">S7</div>&nbsp&nbsp';

            } else {

                echo '<div class="h7" style="color: #2BBBAD;">Professeur S7</div>&nbsp&nbsp';
                $facto++;

            }

        }

        if ( $role['sem8'] > 1 ) {

            if ( $facto > 0 ) {

                echo '<div class="h7" style="color: #9933CC;">S8</div>&nbsp&nbsp';

            } else {
            
                echo '<div class="h7" style="color: #9933CC;">Professeur S8</div>&nbsp&nbsp';
                $facto++;

            }

        }

        if ( $role['sem9'] > 1 ) {

            if ( $facto > 0 ) {

                echo '<div class="h7" style="color: #0d47a1;">S9</div>&nbsp&nbsp';

            } else {

                echo '<div class="h7" style="color: #0d47a1;">Professeur S9</div>&nbsp&nbsp';
                $facto++;

            }

        }

        if ( $role['sem10'] > 1 ) {

            if ( $facto > 0 ) {

                echo '<div class="h7" style="color: #CC0000;">S10</div>&nbsp&nbsp';

            } else {

                echo '<div class="h7" style="color: #CC0000;">Professeur S10</div>&nbsp&nbsp';
                $facto++;

            }

        }
        echo'</div>';

        ///////////////////////////////////////////////////////
        ///////////  Affichage de l'association  /////////////
        /////////////////////////////////////////////////////

    }

    ///////////////////////////////////////////////////////
    ///////////////  Menu déroulant cours  ///////////////
    /////////////////////////////////////////////////////

    function deroulecours ( $db, $user ) {

        $role = verifrole( $db, $user );
        $teacher = false;

        foreach ( $role as $key => $value ) {

            if ( $value == 2 ) {

                $teacher = true;
                break;

            }

            if ( $value == 1 ) {

                $student = $key;
                break;

            }

        }

        unset( $key );
        unset( $value );

        if ( $teacher ) {

            echo'<a class="dropdown-item text-primary" href="postcours.php">Publier un cours</a>
                <div class="dropdown-divider"></div>';
                
            echo '<a class="nav-link dropdown-toggle text-primary text-center" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Voir Cours
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown2">';

                    foreach ( $role as $key => $value ) {

                        if ( $value == 2 ) {

                            if ( $key == 'sem10') {

                                $classe = '10';

                            } else {

                                $classe = substr($key, -1);

                            }

                            echo '<a class="dropdown-item" href="voircours.php?classe='.$key.'">Semestre '.$classe.'</a>';

                        }

                    }

            echo '</div>';
            

        } else {

            echo '<a class="dropdown-item" href="voircours.php?classe='.$student.'">Voir Cours</a>';

        }


    }

    ///////////////////////////////////////////////////////
    ////////////////  Choix de la classe  ////////////////
    /////////////////////////////////////////////////////

    function choixclasse ( $db, $user ) {

        $role = verifrole( $db, $user );

        echo '<select class="form-control d-flex flex-nowrap" name="classe">';
        $compteur = 1;
        foreach ( $role as $key => $value ) {

            if ( $value == 2 ) {
                echo '<option value="'.$key.'">Semestre '.$compteur.'</option>';
            }

            $compteur++;
        }
        echo '</select>';

    }

    ///////////////////////////////////////////////////////
    /////////////////  Publier un cours  /////////////////
    /////////////////////////////////////////////////////

    function publiercours ( $texte, $user, $classe, $db, $filename, $tmpname, $test ) {

        if ( $test ) {

            $name_file = $filename;
            $tmp_name = $tmpname;
            $local_image = "C:/wamp64/www/Walltech/images/";
            $chemin = "images/".$name_file;
            move_uploaded_file ( $tmp_name , $local_image.$name_file);

        } else {

            $chemin = 'non';

        }

        $req = $db->prepare( 'INSERT INTO cours ( classe, cours, Utilisateur, img ) VALUES ( :classe, :cours, :utilisateur, :img )' );
        $req->execute(array(
            'classe' => $classe,
            'cours' => $texte,
            'utilisateur' => $user,
            'img' => $chemin
        ));
        $req->closeCursor();

        header( "Location: enseignement.php" );

    }

    ///////////////////////////////////////////////////////
    //////////////////  Afficher cours  //////////////////
    /////////////////////////////////////////////////////

    function affichercours ( $db, $user, $classe ) {

        $role = verifrole( $db, $user );
        $verif = false;
        foreach ( $role as $key => $value ) {

            if ( $value > 0 ) {

                if ( $key == $classe ) {

                    $verif = true;
                    break;

                }
                
            }

        }

        if ( $verif ) {

            $req = $db->prepare( 'SELECT * FROM cours INNER JOIN utilisateur2 ON 
                        cours.Utilisateur = utilisateur2.idUtilisateur2 WHERE classe = :classe ORDER BY heurecours DESC' );
            $req->execute(array(
                'classe' => $classe
            ));
                
            while ( $donnees = $req->fetch() ) {     
                
                echo '<div class="card gedf-card bg-dark text-white">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" height="45" src="'.photodeprofil( $db, $donnees['idUtilisateur2']).'" 
                                            alt="">
                                            
                                    </div>
                                    <div class="ml-2">
                                        <div class="h4 m-0">'.$donnees['prenom'].' '.$donnees['nom'].'</div>';
                                        
                                        afficherrole ( verifrole ( $db, $donnees['idUtilisateur2'] ) );

                                echo   '<div class="t text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>'.$donnees['heurecours'].'</div>
                                    </div>
                                    
                                </div>';

                                if ( $user == $donnees['idUtilisateur2'] ) {
                                    
                                    echo'<form method="POST">
                                            <div class ="col col-lg-2">
                                                <button type = "submit" name = "sup" value ="'.$donnees['idCours'].'" class="btn btn-light" style = "background-color: transparent; border: none;">
                                                    <img src = "button.png"  width="25px" height="25px">
                                                </button>
                                            </div>
                                        </form>';

                                }
                                
                    echo   '</div>
                        </div>
                        
                        <div class="card-body">';

                if( $donnees['img'] != 'non' ) {

                    echo '<img width="200" height="175" src="'.$donnees['img'].'" alt="">';

                }

                echo     '<p class="card-text">'.$donnees['cours'].'</p>';

                echo    '</div>';

                echo '</div>';

            }

        } else {
            
            echo '<div class="mt-5 mb-5 text-danger">
                    <h5> Vous n\'avez rien à faire ici ! </h5>
                  </div>';

        }

    }

    ///////////////////////////////////////////////////////
    ////////////////  Supprimer un cours  ////////////////
    /////////////////////////////////////////////////////

    function supprimercours ( $id, $db ) {

        $q = $db -> prepare( "DELETE FROM cours WHERE idCours = :id" );
        $q-> execute( ['id' => $id] );

    }
?>

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
                
                $i = $db->prepare ("INSERT INTO utilisateur (email,motdepasse,prenom,nom) VALUES (:email,:password,:prenom,:nom)" );
                $i -> execute ([

                'email' => $email,
                'password'=>$password,
                'prenom'=>$prenom,
                'nom'=>$nom
                
                ]);

                $t = $db->prepare ("INSERT INTO utilisateur2 (email,motdepasse,prenom,nom) VALUES (:email,:password,:prenom,:nom)" );
                $t -> execute ([

                'email' => $email,
                'password'=>$password,
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
                $_SESSION['email'] = $email;
                header("Location:site.php");
            }
            else {

                echo " <br> identifiant incorrect <br> ";
            
            }
        }

    }

    /////////////////////////////////////////////////
    //////////////Fil d'actualité////////////////////
    ////////////////////////////////////////////////
    function postfile($texte, $date, $user, $db) {
    
        $req = $db->prepare('INSERT INTO filactu (post, heurepost, Utilisateur) VALUES (:post, :heurepost, :Utilisateur)');
        $req->execute(array(
            'post' => $texte,
            'heurepost' => $date,
            'Utilisateur' => $user
        ));
        $req->closeCursor();
    }

    function afficherfil() {
        
        $req = $db->query('SELECT * FROM filactu ORDER BY post, likepost, heurepost, Utilisateur DESC');
        while ($donnees = $req->fetch())
        {
            echo '<p><h4 class="inputFields">'.$donnees['yang'].'</h4><p>';
        }
        echo '</th>';
    }
?>
<?php
    function postfile($texte, $date, $user) {
    
        $req = $db->prepare('INSERT INTO filactu (post, heurepost, Utilisateur) VALUES (:post, :heurepost, :Utilisateur)');
        $req->execute(array(
            'post' => $texte,
            'heurepost' => $date,
            'Utilisateur' => $user
        ));
        $req->closeCursor();
    }

    function afficherfil() {

    }
?>
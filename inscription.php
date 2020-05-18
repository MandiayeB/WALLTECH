<html>
    <head>

        <title> inscription </title>
        <link href = "all.css" media="screen" rel="stylesheet" type="text/css"/>

    </head>

    <body>
    
        <form method ="POST"> 

            <input type ="text" name ="email" placeholder ="Email" required><br><br>
            <input type ="text" name ="prenom" placeholder ="Prenom"required><br><br>
            <input type ="text" name ="nom" placeholder ="Nom"required><br><br>
            <input type = "password" name = "password" placeholder ="Mot de passe" required><br><br>
            <input type = "password" name = "ipassword" placeholder ="Confirmer votre mot de passe" required><br><br>
            <input type = "submit" name ="connexion" value ="connexion"><br>
            
        </form>
        <form method ="GET">
            <input type ="submit" name ="retour" value="retour">
        </form>
        
        <?php 

            if (isset($_POST['connexion'])==TRUE){

                require('fonction.php');
                include('BDD.php');
                inscription($_POST['email'],$_POST['password'], $_POST['ipassword'], $_POST['prenom'], $_POST['nom'], $_POST['connexion'], $db);
            }
            
            else if (isset($_GET['retour'])==TRUE) {

                header("Location:connexion.php");

            }

        ?>
    </body>
</html>
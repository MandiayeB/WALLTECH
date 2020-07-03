<?php
    session_start();
    include('BDD.php');
    require ('fonctions.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Walltech - Profil</title>
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

    <!-- bannière -->
    <div class="container main-secction text-white col-md-7  gedf-main">
        <div class="row">
            <div class=" user-left-part bg-dark col card gedf-card">
            <div class="text-align: right">
                 
                        </div>
                <div class=" col-4 align-self offset-md-0">
                    <div class="row ">
                   
                        <div class="col-md-8 col-md-5-sm-5 col-xs-5 user-image text-center">
                            <?php  
                                echo '<img src="'.photodeprofil( $db, $_SESSION['idut']).'" class="rounded-circle" width= "180">'
                            ?>
                              <?php echo '<h1> '.$_SESSION['prenom']." ".$_SESSION['nom'].'</h1>
                                    <h5>Semestre 4 </h5>';
                                ?>  
                                
                            <a href="modifier.php" class="btn btn-primary btn-block">Modifier Profil</a>
                            
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
    </br></br></br>
    <?php 
        
            afficherprofil( $db, $_SESSION['idut'], );                        
        
    ?>
</body>
<?php
    session_start();
    include( 'BDD.php' );
    require ( 'fonctions.php' );

    if (isset($_SESSION['email'])==FALSE){

        header('Location:accueil.php');
        
    }

    if ( isset($_POST['message']) ) {
                        
        postmessages( $db, $_POST['message'], $_SESSION['idut'], $_GET['idUt'] );
    
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>walltech - Messages</title>
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

    <?php include('header.php'); ?>

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

                            <?php affichercontacts( $db, $_SESSION['idut'] ); ?>

                        </div>
                    </div>

                <!-- Messages -->

                <div class="mesgs card-body bg-dark text-white">
                    <div class="msg_history">

                        <?php 
                            affichermessages( $db, $_SESSION['idut'], $_GET['idUt'] );
                        ?>
                        </div>
                        <div class="type_msg">
                            <div class="input_msg_write">
                                <?php echo 
                                '<form method="POST" action="chat.php?idUt='.$_GET['idUt'].'">'; ?>
                                    <input type="text" class="write_msg text-white" name="message" placeholder="Type a message" />
                                    <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>&#x27A4;</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
    session_start();
    echo '<form method="POST" action="chat.php">
            <input type="hidden" name="idUt" value="'.$_GET['idUt'].'"/>
          </form>';
    
?>
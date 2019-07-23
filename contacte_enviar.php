<?php

    require("email/funcionesEmail.php");

    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
    $comentario = htmlspecialchars($_POST['comentario'],ENT_QUOTES);
                       
    enviarMensaje($nombre, $email, $comentario);
    echo json_encode("Hemos recibido tu mensaje. En breve nos pondremos en contacto.");
                  
                     
 ?>

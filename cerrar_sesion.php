<?php
    session_start();
    session_destroy();
    setcookie("password","",-1);
    setcookie("usuario","",-1);

    header('Location: login.php')
   //aa
?>
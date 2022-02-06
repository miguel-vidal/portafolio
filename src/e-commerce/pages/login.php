<?php
    session_start();
     if(!isset($_SESSION["idUser"])){ 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/base/base.css">
    <link rel="stylesheet" href="../styles/components/footer.css">
    <link rel="stylesheet" href="../styles/components/login.css?version=4.0">
    <link rel="stylesheet" href="../styles/components/responsive.css?version=4.0">
</head>
<body>
        <header>
            <a href="../index.php">Regresar</a>
        </header>
        <div class="content">
            <form method="POST" class="form" id="formLogin">
                <input type="email" name="email" id="email" placeholder="Ingresa tu email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <input type="password" name="password" id="password" placeholder="Contraseña" required minlength="6" maxlength="30">
                <input type="submit" value="Ingresar">
                <a href="register.php">Crear una Cuenta</a>
            </form>
        </div>

        
    <script src="../js/ajax.js"></script>
    <script src="../js/actions.js"></script>
    <script src="../js/loginUser.js"></script>
<?php

    include "partials/footer.html";
    }else{
        include "partials/404.html";
    }
?>

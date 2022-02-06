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
    <link rel="stylesheet" href="../styles/components/login.css">
    <link rel="stylesheet" href="../styles/components/register.css">
    <link rel="stylesheet" href="../styles/components/responsive.css">
</head>
<body>
        <header>
            <a href="../index.php">Regresar</a>
        </header>
        <div class="content">
            <form method="POST" class="form  form_register" id="registerForm">
                <input type="email" name="email" id="email" placeholder="Ingresa tu email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <input type="password" name="password" id="password" placeholder="Contraseña" required minlength="6" maxlength="30">
                <input type="text" name="name" id="name" required placeholder="Ingresa tu nombre">  
                <input tyoe="text" name="lastname" id="lastname" required placeholder="Ingresa tus apeliidos">
                <input type="submit" value="Registrar">
            </form>
        </div>

  
    <script src="../js/ajax.js"></script>
    <script src="../js/actions.js"></script>
    <script src="../js/registerNewUser.js"></script>
    
<?php
include "partials/footer.html";
}else{
    include "partials/404.html";
}
?>

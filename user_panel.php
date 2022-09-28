<?php 

include "connection.php";

if (session_status() == PHP_SESSION_ACTIVE){ // se existir sessao corre o codigo
    if (!isset($_SESSION["logado"])){ // se não estiver logado vai para o login
        header("location: login.php");
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de utilizador</title>
    <link rel="stylesheet" href="assets/bootstrap_forms/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<nav class="navbar navbar-light navbar-expand-lg navigation-clean-button">
    <div class="container"><a class="navbar-brand" href="index.php">Book WareHouse</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="#">Acerca</a></li>
                <?php
                    if($_SESSION["permissao"]==1){
                     echo "<li class='nav-item'><a class='nav-link' href='admin_panel.php'>Admin</a></li>";
                    }
                    ?>
            </ul><span class="navbar-text actions"> <a class="login" href="carrinho.php">Carrinho</a><a class="btn btn-light action-button" role="button" href="logout.php">Logout</a></span>
        </div>
    </div>
</nav>

<main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container" style="color: var(--bs-blue);">
                <div class="block-heading">
                    <h2 style="color: rgb(86,198,198);">Painel de Edição</h2>
                    <p style="color: rgb(0,0,0);">Pode rever e alterar a sua informação</p>
                </div>
            </div>
            <div class="container text-center" style="padding: 1%;"><a href="change_panel.php"><button class="btn btn-primary" type="button" style="background: rgb(86,198,198);width: 25%;border-color: rgb(86,198,198);border-top-color: rgb(86,198,198);">Editar</button></a></div>
           <div class="container text-center" style="padding: 1%;"><a href="moradas.php"><button class="btn btn-primary" type="button" style="background: rgb(86,198,198);width: 25%;border-color: rgb(86,198,198);border-top-color: rgb(86,198,198);">Gestor de moradas </button></a></div>
        </section>
    </main>
<footer class="footer-basic">
    <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="index.php">Home</a></li>
            <li class="list-inline-item"><a href="#">Services</a></li>
            <li class="list-inline-item"><a href="#">About</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
    <p class="copyright">Book WareHouse © 2022</p>
</footer>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/bs-init.js"></script>
</body>
</html>
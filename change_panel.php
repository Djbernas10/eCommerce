<?php 

include "connection.php";

if (session_status() == PHP_SESSION_ACTIVE){ // se existir sessao corre o codigo
    if (!isset($_SESSION["logado"])){ // se não estiver logado vai para o login
        header("location: login.php");
    }
    
}

if (isset($_GET["erro"])) { //erros relacionados
    switch($_GET["erro"]){
        case 1:
            echo"<script>alert('A password atual está errada');</script>";
            break;
        case 2:
            echo"<script>alert('As passwords nao sao iguais');</script>";
            break;
        case 3:
            echo"<script>alert('A password nova é igual à antiga');</script>";
            break;
        case 4:
            echo "<script>alert('Username já existente');</script>";
            break;
        case 5:
           echo "<script>alert('Email já existente');</script>";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de edição</title>
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
        </ul><span class="navbar-text actions"> <a class="login" href="<?php if(isset($_GET["change"])){echo"change_panel.php";}else{echo"user_panel.php";}?>">Voltar</a><a class="btn btn-light action-button" role="button" href="logout.php">Logout</a></span>
        </div>
    </div>
</nav>
<?php 
if (isset($_GET["change"])) { 
    switch ($_GET["change"]) {
        case 1:
           ?> 
         <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container" style="color: var(--bs-blue);">
                <div class="block-heading">
                    <h2 style="color: rgb(86,198,198);">Alterar nome</h2>
                    <p style="color: rgb(0,0,0);">Está atualmente a alterar o seu nome.</p>
                </div>
                <form style="border-top-color: rgb(86,198,198);color: rgb(0,0,0);" action="edicao.php?change=1" method="POST">
                    <div class="mb-3"><label class="form-label" for="name">Nome</label><input class="form-control" type="text" id="nome" name="nome" value="<?php echo $_SESSION["nome"]; ?>"></div>
                    <div class="mb-3"></div>
                    <div class="mb-3"></div><button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);border-color: rgb(86,198,198);" name="submit">Gravar Mudanças</button>
                </form>
            </div>
        </section>
    </main>
            
            <?php
            break;
        case 2:
            ?>
               <main class="page contact-us-page">
                    <section class="clean-block clean-form dark">
                        <div class="container" style="color: var(--bs-blue);">
                            <div class="block-heading">
                                <h2 style="color: rgb(86,198,198);">Alterar o username</h2>
                                <p style="color: rgb(0,0,0);">Está atualmente a alterar o seu username</p>
                            </div>
                            <form style="border-top-color: rgb(86,198,198);color: rgb(0,0,0);" action="edicao.php?change=2" method="POST">
                                <div class="mb-3"><label class="form-label" for="username">Username</label><input class="form-control" type="text" id="username" name="username" value="<?php echo $_SESSION["username"];?>" required></div>
                                <div class="mb-3"></div><button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);border-color: rgb(86,198,198);">Gravar Mudanças</button>
                            
                            </form>
                        </div>
                    </section>
                </main>
            <?php
            break;
        case 3:
            ?>
            <main class="page contact-us-page"> 
                    <section class="clean-block clean-form dark">
                        <div class="container" style="color: var(--bs-blue);">
                            <div class="block-heading">
                                <h2 style="color: rgb(86,198,198);">Alterar o email</h2>
                                <p style="color: rgb(0,0,0);">Está atualmente a alterar o seu email</p>
                            </div>
                            <form style="border-top-color: rgb(86,198,198);color: rgb(0,0,0);" action="edicao.php?change=3" method="POST">
                                <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" type="email" id="email" name="email" value="<?php echo $_SESSION["email"]?>" required></div>
                                <div class="mb-3"></div><button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);border-color: rgb(86,198,198);">Gravar Mudanças</button>
                            
                            </form>
                        </div>
                    </section>
                </main>
            <?php
            break;
        case 4:
            ?>
            <main class="page contact-us-page"> 
                    <section class="clean-block clean-form dark">
                        <div class="container" style="color: var(--bs-blue);">
                            <div class="block-heading">
                                <h2 style="color: rgb(86,198,198);">Alterar a password</h2>
                                <p style="color: rgb(0,0,0);">Está atualmente a alterar a sua password</p>
                            </div>
                            <form style="border-top-color: rgb(86,198,198);color: rgb(0,0,0);" action="edicao.php?change=4" method="POST">
                            <div class="mb-3"><label class="form-label" for="pA">Password Atual</label><input class="form-control" type="password" id="pA" name="pA" required></div>
                            <div class="mb-3"><label class="form-label" for="pN">Password Nova</label><input class="form-control" type="password" id="pN" name="pN" required></div>
                            <div class="mb-3"><label class="form-label" for="pNR">Repetir a Password</label><input class="form-control" type="password" id="pNR" name="pNR" required></div>
                            <div class="mb-3"></div><button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);border-color: rgb(86,198,198);">Gravar Mudanças</button>
                            
                            </form>
                        </div>
                    </section>
                </main>
            <?php
            break;
        case 5:
            ?>
            <main class="page contact-us-page"> 
                    <section class="clean-block clean-form dark">
                        <div class="container" style="color: var(--bs-blue);">
                            <div class="block-heading">
                                <h2 style="color: rgb(86,198,198);">Apagar a Conta</h2>
                                <p style="color: rgb(0,0,0);">Está atualmente a tentar apagar a sua conta!</p>
                            </div>
                            <form style="border-top-color: rgb(86,198,198);color: rgb(0,0,0);" action="edicao.php?change=5" method="POST">
                                <div class="mb-3"><label class="form-label" for="pA">Password Atual</label><input class="form-control" type="password" id="pA" name="pA" required></div>
                                <div class="mb-3"></div><button class="btn btn-primary" type="submit" style="background: rgb(86,198,198);border-color: rgb(86,198,198);">Gravar Mudanças</button>
                            </form>
                        </div>
                    </section>
                </main>
            <?php
            break;
    }
}
else{
?>
<main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container" style="color: var(--bs-blue);">
                <div class="block-heading">
                    <h2 style="color: rgb(86,198,198);">Painel de Edição de Utilizador</h2>
                    <p style="color: rgb(0,0,0);">Pode alterar toda a sua informação e até apagar a sua conta para sair do seu sofrimento!</p>
                </div>
            </div>
            <div class="container text-center" style="padding: 1%;"><a href="change_panel.php?change=1"><button class="btn btn-primary" type="button" style="background: rgb(86,198,198);width: 25%;border-color: rgb(86,198,198);border-top-color: rgb(86,198,198);">Alterar Nome</button></a></div>
            <div class="container text-center" style="padding: 1%;"><a href="change_panel.php?change=2"><button class="btn btn-primary" type="button" style="background: rgb(86,198,198);width: 25%;border-color: rgb(86,198,198);border-top-color: rgb(86,198,198);">Alterar Username</button></a></div>
            <div class="container text-center" style="padding: 1%;"><a href="change_panel.php?change=3"><button class="btn btn-primary" type="button" style="background: rgb(86,198,198);width: 25%;border-color: rgb(86,198,198);border-top-color: rgb(86,198,198);">Alterar Email</button></a></div>
            <div class="container text-center" style="padding: 1%;"><a href="change_panel.php?change=4"><button class="btn btn-primary" type="button" style="background: rgb(86,198,198);width: 25%;border-color: rgb(86,198,198);border-top-color: rgb(86,198,198);">Alterar Password</button></a></div>
            <div class="container text-center" style="padding: 1%;"><a href="change_panel.php?change=5"><button class="btn btn-primary" type="button" style="background: rgb(86,198,198);width: 25%;border-color: rgb(86,198,198);border-top-color: rgb(86,198,198);">Apagar Conta</button></a></div>
        </section>
    </main>
<?php 
}
?>
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
</body>
</html>
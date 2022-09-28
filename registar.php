<?php
include "connection.php";

if (session_status() == PHP_SESSION_ACTIVE){ // se existir sessao corre o codigo
    if (isset($_SESSION["logado"])){ // se estiver logado vai para o index
        header("location: index.php");
    }
}

if (isset($_GET['erro'])) { // relatorio de erros por alerts
    switch ($_GET['erro']) {

        case 1:
            echo"<script>alert('As Passwords nao são identicas');</script>";
            break;
        case 2:
            echo "<script>alert('Username e Email já existentes');</script>";
            break;
        case 3:
            echo "<script>alert('Username já existente');</script>";
            break;
        case 4:
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Registar</title>
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
<?php
 if(isset($_POST['submit'])) {
    if (!isset($_POST["nome"])){
        $nome = empty($_POST["nome"]) ? "Sem Nome": $_POST["nome"]; // caso nao tenha nome passa a ser "Sem nome"
    }
    $username = isset($_POST["username"]) ? mysqli_real_escape_string($ligacao1,$_POST["username"]):false;
    $email= isset($_POST["email"]) ? $_POST["email"]:false;
    $password = isset($_POST["password"]) ? $_POST["password"]:false;
    $password_rep = isset($_POST["password_confirm"]) ? $_POST["password_confirm"]:false;
    $permissao = isset($_POST["permissao"]) ? $_POST["permissao"]:false;
    $checkEmail = mysqli_query($ligacao1, "SELECT email from user Where email like '$email'"); //variavel para ver o email
    $checkUsername = mysqli_query($ligacao1, "SELECT username from user Where username like '$username'"); // variavel para ver o username


    if($password === $password_rep){ //caso sejam iguais da hash da password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }
    else{ // caso sejam diferentes volta ao index

        header("Location: registar.php?erro=1");
        die("As passwords sao diferentes");

    }
    if(mysqli_num_rows($checkEmail)> 0 && mysqli_num_rows($checkUsername)> 0 ){ // checka se existe já uma linha com o mesmo email e username

        header("Location: registar.php?erro=2");
        die("O email e o username ja existem");

    }
    elseif(mysqli_num_rows($checkUsername)> 0){ // checka se existe já uma linha da BD com o mesmo username

        header("Location: registar.php?erro=3");
        die("O username já existe");

    }
    elseif(mysqli_num_rows($checkEmail)> 0 ){ //checka se existe uma linha da BD onde o email ja exista  

        header("Location: registar.php?erro=4");
        die("O email ja existe");

    }
    else{ // senao insere os valores na BD - tabela user

    $resultado = mysqli_query($ligacao1, "insert into user (Nome,email,username,password,permissao) Values('$nome','$email','$username','$hashed_password','$permissao')");
    header("Location: login.php?certo=1");
    //echo "<script>alert('Conta criada com sucesso');</script>";

    }

}
else{
?>
<nav class="navbar navbar-light navbar-expand-lg navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="index.php">Book WareHouse</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Acerca</a></li>
                </ul><span class="navbar-text actions"> </a><a class="btn btn-light action-button" role="button" href="login.php">Log In</a></span>
            </div>
        </div>
    </nav>
    <section class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="POST" action="">
                <h2 class="text-center"><strong>Crie&nbsp;</strong>a sua conta.</h2>
                <input class="form-control" type="text" name="username" placeholder="Username">
                <div class="mb-3"></div><input class="form-control" type="email" name="email" placeholder="Email">
                <div class="mb-3"></div><input class="form-control" type="password" name="password" placeholder="Password">
                <div class="mb-3"></div>
                <div class="mb-3"></div><input class="form-control" type="password" name="password_confirm" placeholder="Repetir Password">
                <div class="mb-3"><button style="background-color: rgb(86,198,198);" class="btn btn-primary d-block w-100" type="submit" name="submit">Registar</button></div><a class="already" href="login.php">You already have an account? Login here.</a>
            </form>
        </div>
    </section>
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
<?php
  }

?>

</body>
</html>
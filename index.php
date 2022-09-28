
<?php 

include "connection.php";

if(isset($_GET["erro"])){
    switch ($_GET["erro"]){
    case 1:
        echo "<script>alert('Livro Inexistente');</script>";
        break;
    case 2:
        echo "<script>alert('Carrinho Vazio');</script>";
        break;

}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="initial_page.css"  />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.reflowhq.com/v1/toolkit.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
</head>
<body>
<?php
if(!isset($_SESSION["username"])) { // se a variavel de sessao username nao existir entao aparece o login e o registo
    ?>
    <nav class="navbar navbar-light navbar-expand-lg navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="index.php">Book WareHouse</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Acerca</a></li>
                </ul><span class="navbar-text actions"> <a class="login" href="login.php">Log In</a><a class="btn btn-light action-button" role="button" href="registar.php">Registar</a></span>
            </div>
        </div>
    </nav>
    <?php
}else{ //caso exista entao estou logado logo so posso dar logout
?> 
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
                </ul><span class="navbar-text actions"> <a class="login" href="carrinho.php">Carrinho</a><a class="btn btn-light action-button" role="button" href="user_panel.php"><?php echo $_SESSION["username"]; ?></a></span>
            </div>
        </div>
    </nav>
<?php

}
$livro = mysqli_query($ligacao1,"SELECT idLivro,Titulo,Foto,PrecoUnidade,Autor_idAutor,QStock FROM livro");
    
    ?>
<section  class="m">
    <?php    
    while($row=mysqli_fetch_assoc($livro)){
        $idAutor = $row["Autor_idAutor"];
        $idlivro = $row["idLivro"];
        $quantidade = $row["QStock"];
        $autor = mysqli_fetch_row(mysqli_query($ligacao1,"SELECT Nome FROM autor where idAutor like '$idAutor'"))[0];
        $titulo = $row["Titulo"];
        $foto = $row["Foto"];
        $precoUnidade = $row["PrecoUnidade"];
        echo " <article>
        <img src='imagens_livros/".$foto."'>
        <p>$titulo</p>
        <p>$precoUnidade €</p>
        <p>$autor</p>";
        if($quantidade <= 0){ 
            echo"
        <button disabled>Produto Indisponivel</button>
        </article>"; 
        }
        else{
        echo"
        <a href='acao_carrinho.php?id=".$idlivro."'><button>Adicionar ao carrinho</button></a>
        </article>";
        }   
    }
?>
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
</body>
</html>
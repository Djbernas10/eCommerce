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
    <title>Carrinho</title>
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
                </ul><span class="navbar-text actions"> <a class="login" href="carrinho.php">Carrinho</a><a class="btn btn-light action-button" role="button" href="user_panel.php"><?php echo $_SESSION["username"]; ?></a></span>
            </div>
        </div>
    </nav>
    <div class="container">
    <form action="acao_encomenda.php" method="POST">
        <div class="table-responsive">
            <table class="table">
               <thead>
                    <tr>
                        <th>Nome do livro</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $total = 0;
                    if(isset($_SESSION["carrinho"]) && is_array($_SESSION["carrinho"])){
                            foreach($_SESSION["carrinho"] as $chave => $valor) {
                                $inf=mysqli_fetch_row(mysqli_query($ligacao1,"Select Titulo,PrecoUnidade from livro WHERE idLivro = $chave"));
                                $pT=$valor * $inf[1];//preco total
                                echo "<tr><td>".$inf[0]."
                                <td>$valor
                                </td><td>".$pT."</td></tr>";
                                $total+= $pT;   
                        }   
                    }
                    else{
                        header("location:index.php?erro=2");
                    }
                    
                    ?>
                    <td>Total</td><td></td><td><?php echo $total;?></td></tr>
                </tbody>
            </table>
        </div>
            <button name="submit" class="btn btn-primary border rounded-pill d-lg-flex" type="submit" style="background: rgb(86,198,198);border-color: rgb(86,198,198);border-radius: 18px;">Encomendar</button>
    </form>
</div>
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
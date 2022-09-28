<?php 

include "connection.php";

/*
$id = $_GET["id"];
$_SESSION["carrinho"] = array($id => 2);
print_r($_SESSION["carrinho"][$id]);
*/
if (session_status() == PHP_SESSION_ACTIVE){ // se existir sessao corre o codigo
    if (!isset($_SESSION["logado"])){ // se não estiver logado vai para o login
        header("location: login.php");
    }
    else{
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $produto = mysqli_query($ligacao1, "Select * from livro WHERE idLivro = $id"); // cria a variavvel produto e procura o livro de id do get
            $arreio = mysqli_fetch_assoc($produto);
            if (mysqli_num_rows($produto) <= 0) {
            header("location: index.php?erro=1");
            }
            else{
                //se entrou aqui é pq o produto existe
                if(isset($_SESSION["carrinho"]) && is_array($_SESSION["carrinho"])){
                    if(array_key_exists($id,$_SESSION["carrinho"])){
                        //se já exitir o produto no carrinho adiciona 1 provisorio
                        $_SESSION["carrinho"][$id] +=1;
                        //print_r($_SESSION["carrinho"][$id]);
                         header("location: index.php");
                    }
                    else{
                        //se nao existir iguala a quantidade 1 provisorio
                        $_SESSION["carrinho"][$id] =1;
                         header("location: index.php");
                    }
                }
                else{
                    //se o carrinho estiver vazrio adiciona o primeiro produto ao carrinho
                    $_SESSION["carrinho"] = array($id => 1);
                     header("location: index.php");
                }   
            }
        }
        /*
        elseif(isset($_GET['remover']) && is_numeric($_GET['remover']) && isset($_SESSION['carrinho']) && isset($_SESSION['carrinho'][$_GET['remover']])) {
            // Remove o produto do carrinho
            unset($_SESSION['carrinho'][$_GET['remover']]);
            header("location: carrinho.php");
        }
        */
        //print_r($_SESSION["carrinho"]);
}       
}else{
    header("location: index.php");
}
?>

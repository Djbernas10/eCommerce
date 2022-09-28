<?php 

include "connection.php";
$iduser = $_SESSION["idLogin"];

if (session_status() == PHP_SESSION_ACTIVE){ // se existir sessao corre o codigo
    if (!isset($_SESSION["logado"])){ // se não estiver logado vai para o login
        header("location: login.php");
    }
    else{
        $data = date("Y/m/d");
        $pt=0;
        $qT = 0; //quantidae total de livros
        $total =0;//preco total dos lviros encomendaddos
         //criar encomenda
         $encomenda = mysqli_query($ligacao1,"Insert into encomenda(User_idlogin,DataCompra) values('$iduser','$data')");
         $idEncomenda = mysqli_insert_id($ligacao1);

        if(isset($_SESSION["carrinho"]) && is_array($_SESSION["carrinho"])){
            foreach($_SESSION["carrinho"] as $idLivro => $quantidade) {
                
                //procurar o valor total dos livros e a sua quantidade
                $inf=mysqli_fetch_row(mysqli_query($ligacao1,"Select PrecoUnidade from livro WHERE idLivro = '$idLivro'")); //preco total
                $pT=$quantidade * $inf[0];//preco total por livro encomendado
                //criar um gestor e colocar valores
                $gestor=mysqli_query($ligacao1,"insert into gestor (Quantidade,PrecoUnidade,Livro_idLivro,Encomenda_idEncomenda) Values('$quantidade','$pT','$idLivro','$idEncomenda')");

                $qT +=$quantidade;//adiciona a quantidade de livros total por incremento
                $total+=$pT;
            }   
            mysqli_query($ligacao1, "UPDATE encomenda SET Quantidade = '$qT',PrecoTotal = '$total' WHERE idEncomenda = '$idEncomenda'"); 
            mysqli_query($ligacao1, "INSERT into compra (Estado,Encomenda_idEncomenda,User_idlogin) Values('Não Enviado','$idEncomenda','$iduser')"); 
            //unset dos valores do carrinho
            unset($_SESSION["carrinho"]);
            header("location: index.php");
        }
    }
} 
else{
    header("location: index.php");
}

?>
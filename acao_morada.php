<?php 

include "connection.php";

if (session_status() == PHP_SESSION_ACTIVE){ // se existir sessao corre o codigo
    if (!isset($_SESSION["logado"])){ // se não estiver logado vai para o login
        header("location: login.php");
    }
    
}

$idLogin = $_SESSION["idLogin"];

if(isset($_GET["acao"])){
    switch($_GET["acao"]){
    
        case 1:
            $nc = $_POST["nC"];
            $linha1 = $_POST["linha1"];
            $cidade = $_POST["cidade"];
            $cP = $_POST["cP"];
            $pais = $_POST["pais"];
            mysqli_query($ligacao1,"insert into morada (nomeCompleto,Linha1,Cidade,CP,Pais,User_idlogin) Values('$nc','$linha1','$cidade','$cP','$pais','$idLogin')");
            header("Location: moradas.php?verMorada=1");
            break;
    }
}
else{
    header("location: moradas.php");
}

?>
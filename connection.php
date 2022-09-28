<?php 
$servidor="127.0.0.1";//
$utilizador="root";//utilizador
$password="";//pass
$nomebd="eCommerce"; //DB

if(session_status() != PHP_SESSION_ACTIVE){ // caso nao exista sessao criar uma
    session_start();
}
$ligacao1 = mysqli_connect($servidor,$utilizador,$password,$nomebd);
if (mysqli_connect_errno() ){

    exit("Erro a conectar a base de dados: " . mysqli_connect_error());

}
?>


<?php 

include "connection.php";

if (!isset($_POST['username'], $_POST['password']) ) {
    header("location: index.php");
    exit('Sem valores introduzidos'); // mensagem de erro caso utilizador consiga submeter o from sem username ou password

}

$username = isset($_POST['username']) ? $_POST['username']:false;
$password = isset($_POST['password']) ? $_POST['password']:false;
$username1 = mysqli_real_escape_string($ligacao1,$username);
$resultado = mysqli_fetch_row(mysqli_query($ligacao1, "Select password from user where username like '$username'"))[0];

if (password_verify($password,$resultado) == true){ // se tudo estiver correto entra no site
    $_SESSION["username"] = $username;
    $_SESSION["nome"] = mysqli_fetch_row(mysqli_query($ligacao1,"Select Nome from user where username like '$username'" ))[0];
    $_SESSION["email"] = mysqli_fetch_row(mysqli_query($ligacao1,"Select email from user where username like '$username'" ))[0];
    $_SESSION["idLogin"] = mysqli_fetch_row(mysqli_query($ligacao1,"Select idlogin from user where username like '$username'" ))[0];
    $_SESSION["permissao"] = mysqli_fetch_row(mysqli_query($ligacao1,"Select permissao from user where username like '$username'" ))[0];
    $_SESSION["logado"] = true;
    //print $_SESSION["idLogin"]; debug
    //print $resultado; debug
    header("location: index.php");
}
else{

    header("location: login.php?erro=5"); // se errar na password
    die("Erro na password");

}

?>






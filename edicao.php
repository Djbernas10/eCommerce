<?php 

include "connection.php";

if (session_status() == PHP_SESSION_ACTIVE){ // se existir sessao corre o codigo
    if (!isset($_SESSION["logado"])){ // se não estiver logado vai para o login
        header("location: login.php");
    }
    
}

$idLogin = $_SESSION["idLogin"];
$userS = $_SESSION["username"]; //user da sessao
$emailS = $_SESSION["email"];
$password_DB = mysqli_fetch_row(mysqli_query($ligacao1, "Select password from user where username like '$userS'"))[0]; // password encryptada da DB

if (isset($_GET["change"])) { 
    switch ($_GET["change"]) {

        case 1: // caso a variavel change seja 1 mudar o nome
            $Nome = $_POST["nome"];
            mysqli_query($ligacao1, "UPDATE user SET Nome='$Nome' WHERE idlogin='$idLogin'"); 
            $_SESSION["nome"] = $Nome;
            header("location: change_panel.php");
            break;
        case 2: // caso a variavel change seja 2 mudar o username
            $username = $_POST["username"];
            $checkUsername = mysqli_query($ligacao1, "SELECT username from user Where username like '$username' "); // variavel para ver o username
            if((mysqli_num_rows($checkUsername)> 0) && ($username != $userS)){
                header("location: change_panel.php?erro=4");
            }else{
            mysqli_query($ligacao1, "UPDATE user SET username='$username' WHERE idlogin='$idLogin'"); 
            $_SESSION["username"] = $username;
            header("location: change_panel.php?certo=1");
            }
            break;
        case 3: // caso a variavel change seja 3 mudar o email
            $email = $_POST["email"];
            $checkEmail = mysqli_query($ligacao1, "SELECT email from user Where email like '$email' "); //variavel para ver o email
            if((mysqli_num_rows($checkEmail)> 0) && ($email != $emailS)){
                header("location: change_panel.php?erro=5");
            }else{
            mysqli_query($ligacao1, "UPDATE user SET email='$email' WHERE idlogin='$idLogin'"); 
            $_SESSION["email"] = $email;
            header("location: change_panel.php");
            }
            break;
        case 4: // caso a variavel change seja 4 mudar a password
            $pA = $_POST["pA"];// password atual
            $pN = $_POST["pN"];// password nova
            $pNR = $_POST["pNR"];//password nova repeticao
            if(password_verify($pA,$password_DB) != true){
                    header("location: change_panel.php?erro=1");
            }
            else{
                if($pA === $pN)
                    header("location: change_panel.php?erro=3");
                elseif($pN===$pNR){
                    $hashed_password = password_hash($pN, PASSWORD_DEFAULT);
                    mysqli_query($ligacao1, "Update user SET password='$hashed_password' where idlogin='$idLogin'");
                    header("location: logout.php");
                }
                else{
                    header("location: change_panel.php?erro=2");
                }
            }
            break;
        case 5:
            $pA = $_POST["pA"];
            if(password_verify($pA,$password_DB) != true){
                header("location: change_panel.php?erro=1");
            }
            else{
                mysqli_query($ligacao1, "DELETE from user where idlogin='$idLogin'");
                header("location: logout.php");
            }
            break;
    }
}


?>
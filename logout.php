<?php

include "connection.php";

unset($_SESSION["logado"]);
unset($_SESSION["username"]);
unset($_SESSION["nome"]);
unset($_SESSION["email"]);
unset($_SESSION["idLogin"]);
unset($_SESSION["permissao"]);
unset($_SESSION["carrinho"]);
session_destroy();
header("location:index.php");

?>
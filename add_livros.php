<?php 

include "connection.php";

if (session_status() == PHP_SESSION_ACTIVE){ // se existir sessao corre o codigo
    if (!isset($_SESSION["logado"])){ // se não estiver logado vai para o login
        header("location: login.php");
    }
    
}

if($_SESSION["permissao"]!= 1){
    header("location : index.php");
}

if(isset($_POST["submit"])){
    
        $photo = isset($_FILES["img"]) ? $_FILES["img"]["name"] : NULL;
        $titulo = $_POST["titulo"];
        $preco = $_POST["preco"];
        $qStock = $_POST["qStock"];
        $idAutor = $_POST["autor"];
        $idGenero = $_POST["genero"];
        mysqli_query($ligacao1,"INSERT into livro (Titulo,PrecoUnidade,QStock,Autor_idAutor,Genero_idGenero,Foto) Values('$titulo','$preco','$qStock','$idAutor','$idGenero','$photo')");
        if($photo != NULL){

            move_uploaded_file($_FILES["img"]["tmp_name"],"imagens_livros/".$_FILES["img"]["name"]);
            header("location: admin_panel.php");

        }

}

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Dashboard - Adicionar Livros</title>
        <link rel="stylesheet" href="assets_admin/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets_admin/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets_admin/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets_admin/fonts/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/Footer-Basic.css">
        <link rel="stylesheet" href="assets_admin/fonts/fontawesome5-overrides.min.css">
        <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    </head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: #56c6c6;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="admin_panel.php">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-book"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>Painel de Admin</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Pagina Principal</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="encomendas.php"><i class="fas fa-tachometer-alt"></i><span>Encomendas</span></a></li></ul>
                </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                   
                        <section class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 ">
                            <a href="admin_panel.php" style="text-decoration: none; color:white;"><button class="btn btn-primary py-0" type="button" style="background: #56c6c6;border-color: #56c6c6;"><strong>Voltar</strong></button></a>
                        </section>
                   
                </nav>
        <section class="container" style="height: 80%;width: 95%;">
        <div class="login-clean">
            <form method="POST" action="" enctype="multipart/form-data">
                <h2 class="visually-hidden">Login Form</h2>
                <div class="mb-3"><input class="form-control" type="text" name="titulo" placeholder="Titulo" /></div>
                
                <div class="mb-3"><input class="form-control" type="text" name="preco" placeholder="Preco Unitário" /></div>
                <div class="mb-3"><input class="form-control" type="text" name="qStock" placeholder="Quantidade em stock" /></div>
                <div class="mb-3">
                <select class="form-select" name="autor" id="genero">
                <?php
                $query = mysqli_query($ligacao1,"Select idAutor,Alias from autor");
                while($row = mysqli_fetch_assoc($query)){
                    echo "<option value='".$row['idAutor']."'>".$row['Alias']."</option>";
                }
                ?></select></div>
                <div class="mb-3">
                <select class="form-select" name="genero" id="genero">
                <?php
                $query = mysqli_query($ligacao1,"Select idGenero,Tipo from genero");
                while($row = mysqli_fetch_assoc($query)){
                    echo "<option value='".$row['idGenero']."'>".$row['Tipo']."</option>";
                }
                ?>
                </select>               
                </div>
                <div class="mb-3"><input class="form-control" type="file" id="img" name="img"></div>
                <div class="mb-3">
                <button class="btn btn-primary d-block w-100" type="submit" style="background: rgb(86,198,198);border-color: rgb(86,198,198);" name="submit">Criar Livro</button>
                </div>
            </form>
         </div>
            </section>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
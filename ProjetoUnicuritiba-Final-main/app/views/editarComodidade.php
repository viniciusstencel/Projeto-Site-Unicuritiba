<?php
    include '../controllers/controllers.php';
    use App\Controllers\Controllers as Controllers;
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'principal.php';
    include '../database/conexao.php';
    include '../helpers/funcoes.php';
    if(!Controllers::isLogged()) header('Location: ../../public/principal.php');

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['atualizar'])){
        $idComodidade = $_POST['id'];
        $nome = $_POST['nome'];
        $desc = $_POST['desc'];

        $banner = $_FILES['banner'];
        move_uploaded_file($logo['tmp_name'], '../../public/assets/img/comodidades/' . $banner['name']);
        $endereco_imagem = 'assets/img/atleticas/' . $banner['name'];

        $queryUpdate = "UPDATE comodidades SET nome = '$nome', descricao = '$desc', banner = '$endereco_imagem' WHERE id = '$idComodidade';";
        echo $queryUpdate;
        $resultUpdate = mysqli_query($con, $queryUpdate);

        if($resultUpdate)echo"<script class='alerta'>alert('Comodidade Atualizada.');window.location.href ='../../public/painelAdm.php';</script>";
        else echo"<script class='alerta'>alert('[ERRO] Não foi possível Atualizar Comodidade.');window.location.href ='../../public/painelAdm.php';</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Comodidade</title>
    <link rel="stylesheet" href="../../public/assets/CSS/atleticas.css">

</head>
<body>
    <div class="login-box1">
        
    <h2>Atualizar Informações de Comodidade.</h2>
    <form action="" method="post" enctype="multipart/form-data">
    <?php 
            $id = $_POST['editarComodidade'];
            $result = infoComodidade($con, $id);
            $row = mysqli_fetch_assoc($result);
    echo'

        <input type="hidden" name="id" value="'.$row['id'].'">

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="nome" id="nome" value="'.$row['nome'].'" required><br>
        </div>

        <div class="user-box">
        <label for="">Banner</label><br>
        <input type="file" name="banner" id="logo_atletica" required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <textarea name="desc" id="desc" rows="5" cols="33" required>'.$row['descricao'].'</textarea>
        </div>

        <input type="submit" name="atualizar" class="atualizar"  value="Atualizar">
    ';
    ?>
    </form>
    <?php

        echo'<a href="gerenComodidades.php" name="sair">Voltar</a>';

    ?>
    </div>
    </div>
</body>
</html>

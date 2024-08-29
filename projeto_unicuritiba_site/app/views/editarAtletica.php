<?php
    include '../controllers/controllers.php';
    use App\Controllers\Controllers as Controllers;
    include '../database/conexao.php';
    include '../helpers/funcoes.php';
    if(!Controllers::isLogged()) header('Location: ../../public/principal.php');
    $userInfo = Controllers::getInfo();
    $idAtletica = $_POST['editarAtletica'];
    $result = infoEditarAtletica($con, $idAtletica);
    $row = mysqli_fetch_assoc($result);
    $query = "SELECT * FROM atleticas WHERE id = '$idAtletica';";
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['atualizar'])){
        $idAtletica = $_POST['id_atletica'];
        $nome = $_POST['nome'];
        $nomePresidente = $_POST['nome_presidente'];
        $raPresidente = $_POST['ra_presidente'];
        $nomeVice = $_POST['nome_vice'];
        $raVice = $_POST['ra_vice'];
        $sobre = $_POST['sobre'];
        $managerId = $userInfo['id'];

        $logo = $_FILES['logo_atletica'];
        move_uploaded_file($logo['tmp_name'], '../../public/assets/img/atleticas/' . $logo['name']);
        $endereco_imagem = 'assets/img/atleticas/' . $logo['name'];

        if($userInfo['nivel'] == 'ADM'){
            $query = "UPDATE atleticas SET nome = '$nome', sobre = '$sobre', presidente = '$nomePresidente', ra_presidente = '$raPresidente',
            vice_presidente = '$nomeVice', ra_vice = '$raVice', logo = '$endereco_imagem' WHERE id ='$idAtletica';";        
            $result = mysqli_query($con, $query);
            if($result)echo"<script class='alerta'>alert('Atlética atualizada com sucesso.');window.location.href ='gerenAtleticas.php';</script>";
            else echo"<script class='alerta'>alert('[ERRO] Não foi possível editar Atlética');window.location.href ='gerenAtleticas.php';</script>";

        }else{
            $query = "UPDATE atleticas SET nome = '$nome', sobre = '$sobre', presidente = '$nomePresidente', ra_presidente = '$raPresidente',
            vice_presidente = '$nomeVice', ra_vice = '$raVice', logo = '$endereco_imagem', id_manager = '$managerId', liberado = 'NAO' WHERE id ='$idAtletica';";
            $result = mysqli_query($con, $query);
            if($result)echo"<script class='alerta'>alert('Atletica editada com sucesso. Aguarde a autorização do Administrador');window.location.href ='gerenAtleticas.php';</script>";
            else echo"<script class='alerta'>alert('[ERRO] Não foi possível editar Atlética');window.location.href ='gerenAtleticas.php';</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Atleticas</title>
    <link rel="stylesheet" href="../../public/assets/CSS/atleticas.css">
</head>
<body>
    <div class="login-box1">
        
    <h2>Editar Atlética</h2>
    <?php
    echo'
    <form action="" method="post" enctype="multipart/form-data">
        
    
        <div class="user-box">
        <label for=""></label>
        <input type="text" name="nome" id="nome" placeholder="Nome da Atlética" value="'.$row['nome'].'"required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="nome_presidente" id="nome_presidente" placeholder="Nome do Presidente" value="'.$row['presidente'].'"required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="ra_presidente" id="ra_presidente" placeholder="R.A do Presidente" value="'.$row['ra_presidente'].'" required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="nome_vice" id="nome_vice" placeholder="Nome do Vice Presidente" value="'.$row['vice_presidente'].'" required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="ra_vice" id="ra_vice" placeholder="R.A do Vice Presidente" value="'.$row['ra_vice'].'" required><br>
        </div>

        <div class="user-box">
        <label for="">Logo da Atlética</label><br>
        <input type="file" name="logo_atletica" id="logo_atletica" required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <textarea name="sobre" id="sobre" rows="5" cols="33" placeholder="Sobre a Atlética.." required>'.$row['sobre'].'</textarea>
        </div>
        <input type="hidden" name="id_atletica" value="'.$row['id'].'">

        <input type="submit" name="atualizar" class="atualizar"  value="Atualizar">


    </form>
    ';
    ?>
    <?php
        if($userInfo['nivel'] == 'ADM'){
            echo'<a href="gerenAtleticas.php" name="sair">Voltar</a>';
        }else{
            echo'<a href="../../public/painelUser.php" name="sair">Voltar</a>';
        }
    ?>
    </div>
    </div>
</body>
</html>

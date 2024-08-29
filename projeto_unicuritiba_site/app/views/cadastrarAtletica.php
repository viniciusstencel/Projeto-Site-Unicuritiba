<?php
    include '../controllers/controllers.php';
    use App\Controllers\Controllers as Controllers;
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'principal.php';
    include '../database/conexao.php';
    include '../helpers/funcoes.php';
    if(!Controllers::isLogged()) header('Location: ../../public/principal.php');
    $userInfo = Controllers::getInfo();
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
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

        $queryVerifica = "SELECT * FROM atleticas WHERE nome = '$nome';";
        $resultVerifica = mysqli_query($con, $queryVerifica);

        if(mysqli_num_rows($resultVerifica) <= 0){

            $query = "INSERT INTO atleticas (nome, sobre, presidente, ra_presidente, vice_presidente, ra_vice, logo, id_manager, liberado) 
            VALUES ('$nome', '$sobre', '$nomePresidente', '$raPresidente', '$nomeVice', '$raVice', '$endereco_imagem', '$managerId', 'NAO');";
            $result = mysqli_query($con, $query);
            if($result)echo"<script class='alerta'>alert('Atletica cadastrada. Aguarde a liberação pelo Administrador.');window.location.href ='../../public/atleticas.php';</script>";
            else echo"<script class='alerta'>alert('[ERRO] Não foi possível cadastrar Atlética');window.location.href ='../../public/atleticas.php';</script>";

        }else echo"<script class='alerta'>alert('[ERRO] Atlética já cadastrada');window.location.href ='../../public/atleticas.php';</script>"; 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Atletica</title>
    <link rel="stylesheet" href="../../public/assets/CSS/atleticas.css">
</head>
<body>
    <div class="login-box1">
        
    <h2>Cadastro de Atlética</h2>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="nome" id="nome" placeholder="Nome da Atlética:"required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="nome_presidente" id="nome_presidente" placeholder="Nome do Presidente:"required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="ra_presidente" id="ra_presidente" placeholder="R.A do Presidente:" required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="nome_vice" id="nome_vice" placeholder="Nome do Vice-presidente:" required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="ra_vice" id="ra_vice" placeholder="R.A do Vice-presidente:" required><br>
        </div>

        <div class="user-box">
        <label for="">Logo da Atlética</label><br>
        <input type="file" name="logo_atletica" id="logo_atletica" required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <textarea name="sobre" id="sobre" rows="5" cols="33" placeholder="Sobre a Atlética..." required></textarea>
        </div>

        <input type="submit" name="cadastro" class="cadastro"  value="Cadastrar">


    </form>
    <?php
        if($userInfo['nivel'] == 'ADM'){
            echo'<a href="'.$previous_page.'" name="sair">Voltar</a>';
        }else{
            echo'<a href="'.$previous_page.'" name="sair">Voltar</a>';
        }
    ?>
    </div>
    </div>
</body>
</html>

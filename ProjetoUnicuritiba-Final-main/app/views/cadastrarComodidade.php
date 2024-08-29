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
        $desc = $_POST['desc'];

        $banner = $_FILES['banner'];
        move_uploaded_file($banner['tmp_name'], '../../public/assets/img/comodidades/' . $banner['name']);
        $endereco_imagem = 'assets/img/comodidades/' . $banner['name'];

        $queryVerifica = "SELECT * FROM comodidades WHERE nome = '$nome';";
        $resultVerifica = mysqli_query($con, $queryVerifica);

        if(mysqli_num_rows($resultVerifica) <= 0){

            $query = "INSERT INTO comodidades (nome, descricao, banner) VALUES ('$nome', '$desc', '$endereco_imagem');";
            $result = mysqli_query($con, $query);
            if($result)echo"<script class='alerta'>alert('Comodidade cadastrada.');window.location.href ='../../public/index.php';</script>";
            else echo"<script class='alerta'>alert('[ERRO] Não foi possível cadastrar Comodidade.');window.location.href ='../../public/index.php';</script>";

        }else echo"<script class='alerta'>alert('[ERRO] Comodidade já cadastrada');window.location.href ='../../public/index.php';</script>"; 
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Comodidade</title>
    <link rel="stylesheet" href="../../public/assets/CSS/atleticas.css">

</head>
<body>
    <div class="login-box1">
        
    <h2>Cadastro de Comodidade</h2>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="nome" id="nome" placeholder="Nome da Comodidade:"required><br>
        </div>

        <div class="user-box">
        <label for="">Banner</label><br>
        <input type="file" name="banner" id="logo_atletica" required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <textarea name="desc" id="desc" rows="5" cols="33" placeholder="Descrição da comodidade..." required></textarea>
        </div>

        <input type="submit" name="cadastro" class="cadastro"  value="Cadastrar">


    </form>
    

        <a href="<?php echo $previous_page; ?>" name="sair">Voltar</a>

    
    </div>
    </div>
</body>
</html>

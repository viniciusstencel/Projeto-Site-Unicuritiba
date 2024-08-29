<?php
    use App\Controllers\Controllers as Controllers;
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'principal.php';
    include '../controllers/controllers.php';
    include '../database/conexao.php';
    include '../helpers/funcoes.php';
    if(!Controllers::isLogged()) header('Location: ../../public/index.php');
    $userInfo = Controllers::getInfo();

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['atualizar'])){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $ra = $_POST['ra'];
        $senha = md5($_POST['senha']);
        $curso = $_POST['curso'];
        $atletica = $_POST['atletica'];
        $nivel = $_POST['nivel'];
        $autorizado = $_POST['autorizado'];

        $queryUpdate = "UPDATE users SET nome = '$nome', ra = '$ra', senha = '$senha', curso = '$curso', atletica = '$atletica', nivel = '$nivel', autorizado = '$autorizado' WHERE id ='$id';";
        $resultUpdate = mysqli_query($con, $queryUpdate);
        if($resultUpdate)echo"<script class='alerta'>alert('Usuário atualizado com sucesso.');window.location.href ='../../public/index.php';</script>";
        else echo"<script>alert('[ERRO] Não foi possível atualizar o usuário.');window.location.href ='../../public/index.php';</script>";

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de dados</title>
    <link rel="stylesheet" href="../../public/assets/CSS/editUser1.css">
</head>
<body>
    <div class="login-box1">
        
    <h2>Gerenciamento de dados</h2>
    <?php
        if($userInfo['nivel'] == 'ADM'){
            $usrId = $_POST['editarUsr'];
            $result = infoEditarUsr($con, $usrId);
            $usrInfoEdit = mysqli_fetch_assoc($result);
            echo'
                <form action="" method="post">
                    <input type="hidden" name="id" value="'.$usrInfoEdit['id'].'">
                    <div class="user-box">
                    <label for=""></label>
                    <input type="text" name="nome" id="nome" value="'.$usrInfoEdit['nome'].'"required>
                    </div>

                    <div class="user-box">
                    <label for=""></label>
                    <input type="text" name="ra" id="ra" value="'.$usrInfoEdit['ra'].'"required>
                    </div>

                    <div class="user-box">
                    <label for=""></label>
                    <input type="password" name="senha" id="senha" placeholder="Senha:" required>
                    </div>

                    <div class="user-box">
                    <label for=""></label>
                    <input type="text" name="curso" id="curso" value="'.$usrInfoEdit['curso'].'">
                    </div>

                    <div class="user-box">
                    <label for=""></label>
                    <input type="text" name="atletica" id="atletica" value="'.$usrInfoEdit['atletica'].'">
                    </div>




                    <div class="form-group">
                    <label for="">Nível:</label><br>
                    <div><br>';


                    if($usrInfoEdit['nivel'] == 'ADM'){
                        echo'
                        <input type="radio" name="nivel" id="atletica" value="ADM" checked>ADM
                        <input type="radio" name="nivel" id="atletica" value="USER">USER';
                    }else{
                        echo'
                        <input type="radio" name="nivel" id="nivel" value="ADM">ADM
                        <input type="radio" name="nivel" id="nivel" value="USER" checked>USER';
                    }
                    echo '</div>
                    </div>



                    <div class="form-group">
                    <label for="">Autorizado:</label><br>
                    <div><br>';
                    if($usrInfoEdit['autorizado'] == 'SIM'){
                       echo' 
                        <input type="radio" name="autorizado" id="autorizado" value="SIM" checked>SIM
                        <input type="radio" name="autorizado" id="autorizado" value="NAO">NAO';
                    }else{
                        echo'
                        <input type="radio" name="autorizado" id="autorizado" value="SIM">SIM
                        <input type="radio" name="autorizado" id="autorizado" value="NAO" checked>NAO';
                    }
                    echo'
                    </div>
                    </div>

                    <input type="submit" name="atualizar" class="atualizar" value="Atualizar">

                </form>';
        }elseif ($userInfo['nivel'] == 'USER'){
            echo'
            <form action="" method="post">
                <div class="user-box">
                <label for=""></label>
                <input type="text" name="nome" id="nome" value="'.$userInfo['nome'].'"required><br>
                </div>

                <div class="user-box">
                <label for=""></label>
                <input type="text" name="ra" id="ra" value="'.$userInfo['ra'].'"required><br>
                </div>

                <div class="user-box">
                <label for=""></label>
                <input type="password" name="senha" id="senha" placeholder="Senha:" required><br>
                </div>

                <div class="user-box">
                <label for=""></label>
                <input type="text" name="curso" id="curso" value="'.$userInfo['curso'].'"><br>
                </div>

                <div class="user-box">
                <label for=""></label>
                <input type="text" name="atletica" id="atletica" value="'.$userInfo['atletica'].'"><br>
                </div>
                <input type="hidden" name="id" value="'.$userInfo['id'].'">
                <input type="hidden" name="nivel" value="'.$userInfo['nivel'].'">
                <input type="hidden" name="autorizado" value="SIM">

                <input type="submit" name="atualizar" class="atualizar"  value="Atualizar">


            </form>';
        }
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

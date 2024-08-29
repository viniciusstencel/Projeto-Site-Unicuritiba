<?php
include '../controllers/controllers.php';
use App\Controllers\Controllers as Controllers;
include '../helpers/funcoes.php';
include '../database/conexao.php';

$userInfo = Controllers::getInfo();
if ($userInfo['nivel'] !== 'ADM') {
    header('Location: ../../public/index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['autorizarCad'])) {
    $idUsrCad = $_POST['autorizarCad'];
    autorizarCadUsr($con, $idUsrCad);
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['excluirUsr'])){
    $idUsrEx = $_POST['excluirUsr'];
    excluirUsr($con, $idUsrEx);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/CSS/painel.css">
    <title>Gerenciador de Users</title>
</head>
<header>
    <div class="center">
        <div class="logo">
            <img src="../../public/assets/img/PRINCIPAL (1).png" alt="Logo">
        </div>
        <div class="menu">
            <a class="link" href="../../public/principal.php">Início</a>
            <a class="link" href="../../public/comodidades.php">Comodidades</a>
            <a class="link" href="../../public/eventos.php">Eventos</a>
            <a class="link" href="../../public/atleticas.php">Atléticas</a>
            <?php 
            if (Controllers::isLogged()) {
                echo "<a class='conta' href='../../public/index.php'><img src='../../public/assets/img/CONTA (2).png' alt='Conta'></a>";
            } else {
                echo "<a class='conta' href='../../public/login.php'><img src='../../public/assets/img/CONTA (2).png' alt='Conta'></a>";
            }
            ?>
        </div>
    </div>
</header>
<body>
    <?php
    $result = gerenUser($con);
    if(mysqli_num_rows($result) > 0){
        echo"<table id='tabela'>
                <tr>
                    <th scope='col'>Id</th>
                    <th scope='col'>Nome</th>
                    <th scope='col'>Senha</th>
                    <th scope='col'>Curso</th>
                    <th scope='col'>R.A</th>
                    <th scope='col'>Atlética</th>
                    <th scope='col'>Nivel</th>
                    <th scope='col'>Autorizado</th>
                </tr>";
        while($row = mysqli_fetch_assoc($result)){
            echo "
                    <tr>
                        <th whdth='5%'>".$row['id']."</th>
                        <th whdth='30%'>".$row['nome']."</th>
                        <th whdth='5%'>****</th>
                        <th whdth='15%'>".$row['curso']."</th>
                        <th whdth='20%'>".$row['ra']."</th>
                        <th whdth='20%'>".$row['atletica']."</th>
                        <th whdth='5%'>".$row['nivel']."</th>
                        <th whdth='5%'>".$row['autorizado']."</th>
                        <td>
                        <form action='editarUser.php' method='POST'>
                            <button class='button-formborda-inversa' name='editarUsr' value = '".$row['id']."'>Editar</button>
                        </form>
                        <form action='' method='POST'>
                            <button class='button-formborda-inversa' name='excluirUsr' value = '".$row['id']."' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\")'>Excluir</button>
                        </form>
                        
                    </td>
                    </tr>

                   ";
        }
    echo "</table>";    
    }
    ?>
        <br>
        <a href="../../public/painelAdm.php" class="voltar">Voltar</a>
</body>
</html>

<?php 
use App\Controllers\Controllers as Controllers;
include '../app/helpers/funcoes.php';
include '../app/database/conexao.php';
$userInfo = Controllers::getInfo();
if($userInfo['nivel'] !== 'USER' && !Controllers::isLogged()) header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/CSS/painel.css">
    <title>Perfil</title>
</head>    
<header>
    <div class="center">
        <div class="logo"><img src="./assets/img/PRINCIPAL (1).png" alt=""></div>
            <div class="menu">
                <a class="link" href="principal.php">Inicio</a>
                <a class="link" href="comodidades.php">Comodidades</a>
                <a class="link" href="eventos.php">Eventos</a>
                <a class="link" href="atleticas.php">Atleticas</a>
                <?php 
                    if (Controllers::isLogged()) {
                        echo "<a class='conta' href='index.php'><img src='./assets/img/CONTA (2).png' alt=''></a>";
                    } else {

                        echo "<a class='conta' href='login.php'><img src='./assets/img/CONTA (2).png' alt=''></a>";
                    }
                    ?>
            </div>
    </div>
    </header>
<body>
    <form action="../app/views/editarUser.php" method="post">
        <button type="submit" name="gerenUser" class="button">Gerenciar dados</button>
    </form> 
    <form action="../app/views/gerenAtleticas.php" method="post">
     <button type="submit" name="gerenAtleticas" class="button">Gerenciar minhas Atléticas</button>
    </form>
    <form action="../app/views/gerenEventos.php" method="post">
     <button type="submit" name="gerenEventos" class="button">Gerenciar meus Eventos</button>
    </form>         
    <br>
        <a href="index.php" class="voltar">Voltar</a>
    <div class="extras">
    </div>
</body>
</html>
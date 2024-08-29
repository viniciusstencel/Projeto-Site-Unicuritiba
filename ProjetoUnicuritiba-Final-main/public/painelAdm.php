<?php
    use App\Controllers\Controllers as Controllers;
    include '../app/helpers/funcoes.php';
    include '../app/database/conexao.php';
    $userInfo = Controllers::getInfo();
    if($userInfo['nivel'] !== 'ADM') header('Location: index.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/CSS/painel1.css">
    <title>Painel ADM</title>
</head>    
<header>
    <div class="center">
        <div class="logo">
            <img src="./assets/img/PRINCIPAL (1).png" alt="">
        </div>
            <div class="menu">
                <a class="link" href="principal.php">Inicio</a>
                <a class="link" href="comodidades.php">Comodidades</a>
                <a class="link" href="eventos.php">Eventos</a>
                <a class="link" href="atleticas.php">Atleticas</a>
            <?php 
                if (Controllers::isLogged()) {
                     echo "<a class='conta' href='index.php'><img src='./assets/img/CONTA (2).png' alt=''></a>";
                } else echo "<a class='conta' href='login.php'><img src='./assets/img/CONTA (2).png' alt=''></a>";
                ?>
            </div>
    </div>
</header>
<body>

    <div class="usuario"><h1>Usuários</h1>
    <form action="../app/views/reqCadastroUser.php" method="post">
        <button type="submit" name="reqCadastro" class="button">Requisições de cadastros</button>           
    </form>
    <form action="../app/views/gerenUsers.php" method="post">
        <button type="submit" name="gerenUser" class="button">Gerenciamento de Usuário</button>
    </form>   

    </div>


    <div class=atleticas><h1>Atléticas</h1>

    <form action="../app/views/reqAtleticas.php" method="post">
        <button type="submit" name="reqAtletica" class="button">Requisições de Atleticas</button>       
    </form>
    <form action="../app/views/gerenAtleticas.php" method="post">
        <button type="submit" name="gerenAtletica" class="button">Gerenciamento de Atleticas</button>       
    </form> 

    </div>


    <div class="comodidades"><h1>Comodidades</h1>
    <form action="../app/views/gerenComodidades.php" method="post">
        <button type="submit" name="gerenComodidades" class="button">Gerenciamento de Comodidades</button>       
    </form>
    </div>
    <div class="eventos"><h1>Eventos</h1>

    <form action="../app/views/reqEventos.php" method="post">
        <button type="submit" name="reqEventos" class="button">Requisições de Eventos</button>       
    </form> 
    <form action="../app/views/gerenEventos.php" method="post">
        <button type="submit" name="gerenEventos" class="button">Gerenciamento de Eventos</button>       
    </form>             

    </div>

        <br>
        <a href="index.php" class="voltar">Voltar</a>
    <div class="extras">
    </div>

</body>
</html>
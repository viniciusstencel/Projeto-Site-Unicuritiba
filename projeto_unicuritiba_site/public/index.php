<?php
    include '../app/Controllers/Controllers.php';
    use App\Controllers\Controllers as Controllers;
    $userInfo = Controllers::getInfo();
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/CSS/index.css">
    <title>Seja Bem-vindo(a)</title>
</head>

<body>

<header>
    <div class="center">
        <div class="logo"><img src="./assets/img/PRINCIPAL (1).png" alt=""></div>
        <div class="menu">
            <a class="link" href="principal.php">Inicio</a>
            <a class="link" href="comodidades.php">Comodidades</a>
            <a class="link" href="eventos.php">Eventos</a>
            <a class="link" href="atleticas.php">Atleticas</a>
            <a class="conta"href="#.php"><img src="./assets/img/CONTA (2).png" alt=""></a>

        </div>
    </div>
    </header>
    <?php if(Controllers::isLogged()){ 
        echo "<p class='ola'>Olá, ". $userInfo['nome'] ."</p>" ;


        if($userInfo['nivel'] == 'ADM'){
            echo "<a href ='painelAdm.php' class='all'>Painel de Administrador</a>";
            echo "<a href ='../app/views/cadastrarAtletica.php' class='all'>Cadastrar Atlética</a>";
            echo "<a href ='../app/views/cadastrarComodidade.php' class='all'>Cadastrar Comodidade</a>";
        }

        if($userInfo['nivel'] == 'USER'){
         echo "<a href ='painelUser.php' class='all'>Perfil</a>";  
        }



        echo "<p><a href='../app/views/cadastrarEvento.php' class='all'>Cadastrar Evento</a></p>";
        echo "<p><a href='logout.php' class='all'>Sair</a></p>";}
        ?>
        <?php if (!Controllers::isLogged()): ?>
        <?php endif; ?>
        <div class="extras">
        </div>

</body>

</html>
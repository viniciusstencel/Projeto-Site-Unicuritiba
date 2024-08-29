<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/CSS/principal1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicuritiba</title>
</head>
<body>
    <header>
    <div class="center">
        <div class="logo"><img src="./assets/img/PRINCIPAL (1).png" alt=""></div>
        <div class="menu">
            <a class="link" href="#">Inicio</a>
            <a class="link" href="comodidades.php">Comodidades</a>
            <a class="link" href="eventos.php">Eventos</a>
            <a class="link" href="atleticas.php">Atleticas</a>
            <?php 
use App\Controllers\Controllers as Controllers;

include '../app/helpers/funcoes.php';
include '../app/database/conexao.php';
$userInfo = Controllers::getInfo();

if(Controllers::isLogged()){ 
    if($userInfo['nivel'] == 'ADM' || $userInfo['nivel'] == 'USER'){
        echo "<a class='conta' href='index.php'><img src='./assets/img/CONTA (2).png' alt=''></a>";
    }
    else {
        echo "<a class='conta' href='login.php'><img src='./assets/img/CONTA (2).png' alt=''></a>";
    }
}
else {
    echo "<a class='conta' href='login.php'><img src='./assets/img/CONTA (2).png' alt=''></a>";
}
?>



        </div>
    </div>
    </header>
    <section class="funcoes">
    <div class="botao-container">
    <div class="botao-container">
    <a href="comodidades.php"><button><img src="./assets/img/COMODIDADES.png" alt=""><br>
    <span>Comodidades</span>
    </button></a>
    <a href="eventos.php"><button><img src="./assets/img/EVENTOS.png" alt=""><br>
    <span>Eventos</span>
    </button></a>
    <a href="atleticas.php"><button><img src="./assets/img/ATLETICAS.png" alt=""><br>
    <span>Atleticas</span>
    </button></a>
</div>



        <div class="extras">
        </div>
    </section>
</body>
</html>
<?php use 
    App\Controllers\Controllers as Controllers;
    include '../app/helpers/funcoes.php';
    include '../app/database/conexao.php';
    $userInfo = Controllers::getInfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/CSS/atleticas.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comodidades</title>
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
<body>

<div class="button-container">

   

    <button><a href="principal.php">Voltar</a></button>
    </div>
    <?php
        $query = "SELECT * FROM comodidades;";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0){
            echo '<div class="grid-container">';
            while($row = mysqli_fetch_assoc($result)){
                echo'
                    <div class="box">
                        <img src="' . $row['banner'] . '" class="card-img-top-1" alt="..">
                        <h3 class="card-title-1">' . $row['nome'] . '</h3>
                        <form action="verComodidade.php" method="post">
                            <button name="verComodidade" class="saiba-mais-1" value="'. $row['id'].'">Saiba mais</button>
                        </form>
                    </div>
                ';
            }
        echo '</div>';
        }
    ?>

    
</body>
</html>
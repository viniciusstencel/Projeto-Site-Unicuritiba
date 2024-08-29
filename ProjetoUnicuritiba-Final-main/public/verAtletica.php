<?php use 
    App\Controllers\Controllers as Controllers;
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'principal.php';
    include '../app/helpers/funcoes.php';
    include '../app/database/conexao.php';
    $userInfo = Controllers::getInfo();
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['verAtletica'])){
        $idAtletica = $_POST['verAtletica'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./assets/CSS/atleticas.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atleticas</title>
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
    <?php
        $query = "SELECT * FROM atleticas WHERE id = '$idAtletica';";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo'
                <div>   
                <img src="' . $row['logo'] . '" class="card-img-top-2" alt="..">
                <div class = "box-size">
                <h1 class="card-title-ver">' . $row['nome'] . '</h1><br>
                <h3 class="card-title-ver">Descrição: ' . $row['sobre'] . '</h3><br>
                </div>
                <div class="box-size1">
                <h3 class="card-title-ver">Presidente:  ' . $row['presidente'] . '</h3><br>
                </div>
                <div class="box-size1">
                <h3 class="card-title-ver">Vice Presidente:  ' . $row['vice_presidente'] . '</h3><br>
                </div>
                    </div>
                ';
            }
        }
    ?>
    
    <div class="button-container">
    <a href="<?php echo $previous_page; ?>" class="voltar1">Voltar</a>
    </div>
    <div class="extras"></div>
    
</body>
</html>
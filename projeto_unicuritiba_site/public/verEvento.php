<?php use 
    App\Controllers\Controllers as Controllers;
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'principal.php';
    include '../app/helpers/funcoes.php';
    include '../app/database/conexao.php';
    $userInfo = Controllers::getInfo();
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['verEvento'])){
        $idEvento = $_POST['verEvento'];
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
        $query = "SELECT * FROM eventos WHERE id = '$idEvento';";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo'
                <div>   
                <img src="' . $row['banner'] . '" class="card-img-top-2" alt="..">
                <div class = "box-size">
                <h1 class="card-title-ver">' . $row['titulo'] . '</h1><br>
                <h3 class="card-title-ver">Descrição: ' . $row['descricao'] . '</h3><br>
                <h3 class="card-title-ver">Data Início: ' . $row['data_inicio_evento'] . '  às  ' . $row['hora_inicio_evento'] . '</h3><br>
                <h3 class="card-title-ver">Data Fim: ' . $row['data_fim_evento'] . '  às ' . $row['hora_fim_evento'] . '</h3><br>
                <h3 class="card-title-ver">Data Inscrições:  de ' . $row['data_inicio_insc_event'] . '  às ' . $row['hora_inicio_insc_event'] . '. até  ' . $row['data_fim_insc_event'] . ' às  ' . $row['hora_fim_insc_event'] . '</h3><br>
                <h3 class="card-title-ver">Endereço: ' . $row['endereco_evento'] . '</h3><br>
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
<?php
    include '../controllers/controllers.php';
    use App\Controllers\Controllers as Controllers;
    include '../helpers/funcoes.php';
    include '../database/conexao.php';
    $userInfo = Controllers::getInfo();

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['autorizar'])){
        $idAtletica = $_POST['autorizar'];
        autorizarAtletica($con, $idAtletica);
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['excluir'])){
        $idEvent = $_POST['excluir'];
        excluirAtletica($con, $idEvent);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../public/assets/CSS/atleticas.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atleticas</title>
</head>
<header>
    <div class="center">
        <div class="logo"><img src="../../public/assets/img/PRINCIPAL (1).png" alt=""></div>
        <div class="menu">
            <a class="link" href="../../public/principal.php">Inicio</a>
            <a class="link" href="../../public/comodidades.php">Comodidades</a>
            <a class="link" href="../../public/eventos.php">Eventos</a>
            <a class="link" href="../../public/atleticas.php">Atleticas</a>
            <?php 

                if(Controllers::isLogged()){ 
                    if($userInfo['nivel'] == 'ADM' || $userInfo['nivel'] == 'USER'){
                        echo "<a class='conta' href='../../public/index.php'><img src='../../public/assets/img/CONTA (2).png' alt=''></a>";
                    }
                    else {
                        echo "<a class='conta' href='../../public/login.php'><img src='../../public/assets/img/CONTA (2).png' alt=''></a>";
                    }
                }
                else {
                       echo "<a class='conta' href='../../public/login.php'><img src='../../public/assets/img/CONTA (2).png' alt=''></a>";
                }
            ?>



        </div>
    </div>
    </header>
<body>
    <h3 class= "nr">Requisições de Atléticas</h3>
    <?php
        $query = "SELECT * FROM atleticas WHERE liberado = 'NAO';";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo"
                    <div>
                        <img src='../../public/" . $row['logo'] . "' class='card-img-top' alt='..'>
                        <h1 class='card-title'>" .$row['nome'] . "</h1>
                        <form action='../../public/verAtletica.php' method='post'>
                        <div class='button-container-top'>
                            <button name='verAtletica' class='button-form borda-inversa' value='". $row['id']."'>Saiba mais</button>
                        </form>
                        <form action='' method='post'>
                            <button name='autorizar' class='button-form borda-inversa' value='".$row['id']."' onclick='return confirm(\"Tem certeza que deseja autorizar esta Atlética?\")'>Autorizar</button>
                        </form>
                        <form action='' method='post'>
                            <button name='excluir' class='button-form borda-inversa' value='".$row['id']."' onclick='return confirm(\"Tem certeza que deseja excluir esta Atlética?\")'>Não autorizar</button>
                            </div>
                        </form>
                    </div>
                ";
            }
        }else echo'<p class="nr">Nenhuma requisição de atlética.</p>';
    ?>
    
    <div class="button-container">

    <a href="../../public/painelAdm.php" class="voltar">Voltar</a>
    </div>

    
</body>
</html>
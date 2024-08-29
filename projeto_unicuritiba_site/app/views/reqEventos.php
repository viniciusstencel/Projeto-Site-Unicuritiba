<?php
    include '../controllers/controllers.php';
    use App\Controllers\Controllers as Controllers;
    include '../helpers/funcoes.php';
    include '../database/conexao.php';
    $userInfo = Controllers::getInfo();

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['autorizar'])){
        $idEvent = $_POST['autorizar'];
        autorizarEvento($con, $idEvent);
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['excluir'])){
        $idEvent = $_POST['excluir'];
        excluirEvento($con, $idEvent);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../public/assets/CSS/eventos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
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
    <h3 class= "nr">Requisições de Eventos</h3>
    <?php
        $query = "SELECT * FROM eventos WHERE liberado = 'NAO';";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo"
                    <div>
                        <img src='../../public/" . $row['banner'] . "' class='card-img-top' alt='..'>
                        <h1 class='card-title'>" .$row['titulo'] . "</h1>
                        <form action='../../public/verEvento.php' method='post'>
                        <div class='button-container-top'>
                            <button name='verEvento' class='button-form borda-inversa' value='". $row['id']."'>Saiba mais</button>
                        </form>
                        <form action='' method='post'>
                            <button name='autorizar' class='button-form borda-inversa' value='".$row['id']."' onclick='return confirm(\"Tem certeza que deseja autorizar este Evento?\")'>Autorizar</button>
                        </form>
                        <form action='' method='post'>
                            <button name='excluir' class='button-form borda-inversa' value='".$row['id']."' onclick='return confirm(\"Tem certeza que deseja excluir este Evento?\")'>Não autorizar</button>
                            </div>
                        </form>
                    </div>
                ";
            }

        }else echo'<p class="nr">Nenhuma requisição de evento.</p>';

    ?>
    
    <div class="button-container">

    <a href="../../public/painelAdm.php" class="voltar">Voltar</a>
    </div>

    
</body>
</html>
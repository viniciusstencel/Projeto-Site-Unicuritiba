<?php
    include '../controllers/controllers.php';
    use App\Controllers\Controllers as Controllers;
    include '../helpers/funcoes.php';
    include '../database/conexao.php';
    $userInfo = Controllers::getInfo();

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
    <h3 class="nr">Gerenciamento de Eventos</h3>
    <?php
        if($userInfo['nivel'] == 'ADM'){
            $query = "SELECT * FROM eventos;";
            $result = mysqli_query($con, $query);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo"
                        <div>
                            <img src='../../public/" . $row['banner'] . "' class='card-img-top' alt='..'>
                            <h1 class='card-title'>" .$row['titulo'] . "</h1>
                            <h1 class='card-title'>Autorizado:  " .$row['liberado'] . "</h1>
                            <form action='../../public/verEvento.php' method='post'>
                            <div class='button-container'>
                                <button name='verEvento' class='button-form borda-inversa' value='". $row['id']."'>Saiba mais</button>
                            </form>
                            <form action='editarEvento.php' method='post'>
                                <button name='editarEvento' class='button-form borda-inversa' value='". $row['id']."'>Editar</button>
                            </form>
                            <form action='' method='post'>
                                <button name='excluir' class='button-form borda-inversa' value='".$row['id']."' onclick='return confirm(\"Tem certeza que deseja excluir este Evento?\")'>Excluir</button>
                                </div>
                            </form>
                        </div>
                    ";
                }
            }else echo"<p class= 'nr'>Nenhum Evento cadastrado.</p>";


        }else{
            $idUsr = $userInfo['id'];
            $query = "SELECT * FROM eventos WHERE manager_user_id = '$idUsr';";
            $result = mysqli_query($con, $query);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo"
                        <div>
                            <img src='../../public/" . $row['banner'] . "' class='card-img-top' alt='..'>
                            <h5 class='card-title'>" .$row['titulo'] . "</h5>
                            <h5 class='card-title'>Autorizada:  " .$row['liberado'] . "</h5>
                            <form action='../../public/verEvento.php' method='post'>
                             <div class='button-container'>
                                <button name='verEvento' class='button-form borda-inversa' value='". $row['id']."'>Saiba mais</button>
                            </form>
                            <form action='editarEvento.php' method='post'>
                                <button name='editarEvento' class='button-form borda-inversa' value='". $row['id']."'>Editar</button>
                            </form>
                            <form action='' method='post'>
                                <button name='excluir' class='button-form borda-inversa' value='".$row['id']."' onclick='return confirm(\"Tem certeza que deseja excluir este Evento?\")'>Excluir</button>
                            </div>
                            </form>
                        </div>
                    ";
                }
            }else {echo"<p class='nr'>Você não possui nenhum Evento cadastrado.</p>";

            echo "<a href='cadastrarEvento.php' class='voltar'>Publique seu evento!</a>";}

        }
    ?>
    
    <div class="button-container">
    <?php
        if($userInfo['nivel'] == 'ADM'){
            echo'<a href="../../public/painelAdm.php" class="voltar">Voltar</a>';
        }else{
            echo'<a href="../../public/painelUser.php" class="voltar">Voltar</a>';
        }
    ?>    
    </div>
    
</body>
</html>
<?php
    include '../controllers/controllers.php';
    use App\Controllers\Controllers as Controllers;
    include '../helpers/funcoes.php';
    include '../database/conexao.php';
    $userInfo = Controllers::getInfo();

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['excluir'])){
        $idEvent = $_POST['excluir'];
        excluirAtletica($con, $idEvent);
    }
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'principal.php';

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
    <h3 class="nr">Gerenciamento de Atléticas</h3>
    <?php
        if($userInfo['nivel'] == 'ADM'){
            $query = "SELECT * FROM atleticas;";
            $result = mysqli_query($con, $query);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo"
                        <div>
                            <img src='../../public/" . $row['logo'] . "' class='card-img-top' alt='..'>
                            <h1 class='card-title'>" .$row['nome'] . "</h1>
                            <h1 class='card-title'>Autorizada:  " .$row['liberado'] . "</h1>
                            <form action='../../public/verAtletica.php' method='post'>
                            <div class='button-container'>
                                <button name='verAtletica' class='button-form borda-inversa' value='". $row['id']."'>Saiba mais</button>
                            </form>
                            <form action='editarAtletica.php' method='post'>
                                <button name='editarAtletica' class='button-form borda-inversa' value='". $row['id']."'>Editar</button>
                            </form>
                            <form action='' method='post'>
                                <button name='excluir' class='button-form borda-inversa' value='".$row['id']."' onclick='return confirm(\"Tem certeza que deseja excluir esta Atlética?\")'>Excluir</button>
                                </div>
                            </form>
                        </div>
                    ";
                }
            }else echo"<p class= 'nr'>Nenhuma Atlética cadastrada.</p>";

            

        }else{
            $idUsr = $userInfo['id'];
            $query = "SELECT * FROM atleticas WHERE id_manager = '$idUsr' ;";
            $result = mysqli_query($con, $query);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo"
                        <div>
                            <img src='../../public/" . $row['logo'] . "' class='card-img-top' alt='..'>
                            <h1 class='card-title'>" .$row['nome'] . "</h1>
                            <h1 class='card-title'>Autorizada:  " .$row['liberado'] . "</h1>
                            <form action='../../public/verAtletica.php' method='post'>
                            <div class='button-container'>
                                <button name='verAtletica' class='button-form borda-inversa' value='". $row['id']."'>Saiba mais</button>
                            </form>
                            <form action='editarAtletica.php' method='post'>
                                <button name='editarAtletica' class='button-form borda-inversa' value='". $row['id']."'>Editar</button>
                            </form>
                            <form action='' method='post'>
                                <button name='excluir' class='button-form borda-inversa' value='".$row['id']."' onclick='return confirm(\"Tem certeza que deseja excluir esta Atlética?\")'>Excluir</button>
                            </div>
                            </form>
                        </div>
                    ";
                }
            }else {echo"<p class='nr'>Você não possui nenhuma atletica cadastrada.</p>";
            echo "<a href='cadastrarAtletica.php' class='voltar'>Crie a sua!</a>";}
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
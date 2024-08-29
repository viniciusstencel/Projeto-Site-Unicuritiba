<?php
    include '../controllers/controllers.php';
    use App\Controllers\Controllers as Controllers;
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'principal.php';
    include '../database/conexao.php';
    include '../helpers/funcoes.php';
    if(!Controllers::isLogged()) header('Location: ../../public/principal.php');
    $userInfo = Controllers::getInfo();

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['publicar'])){

        $dataInicioEvento = $_POST['data_inicio_evento'];
        $dataFimEvento = $_POST['data_fim_evento'];
        $hrInicioEvento = $_POST['hora_inicio_evento'];
        $hrFimEvento = $_POST['hora_fim_evento'];
        
        $dataInicioInsc = $_POST['data_inicio_insc_evento'];
        $dataFimInsc = $_POST['data_fim_insc_evento'];
        $hrInicioInsc = $_POST['hora_inicio_insc_evento'];
        $hrFimInsc = $_POST['hora_fim_insc_evento'];
 
        $titulo = $_POST['titulo'];
        $desc = $_POST['desc'];
        $endereco = $_POST['endereco'];
        $tipoEvento = $_POST['tipo_evento'];

        $idUsr = $userInfo['id'];
        $nivelUsr = $userInfo['nivel'];
        $raUsr = $userInfo['ra'];


        $banner = $_FILES['banner'];
        move_uploaded_file($banner['tmp_name'], '../../public/assets/img/eventos/' . $banner['name']);
        $endereco_banner = 'assets/img/eventos/' . $banner['name'];

        $foto1 = $_FILES['foto_1'];
        move_uploaded_file($foto1['tmp_name'], '../../public/assets/img/eventos/' . $foto1['name']);
        $endereco_foto1 = 'assets/img/eventos/' . $foto1['name'];

        $foto2 = $_FILES['foto_2'];
        move_uploaded_file($foto2['tmp_name'], '../../public/assets/img/eventos/' . $foto2['name']);
        $endereco_foto2 = 'assets/img/eventos/' . $foto2['name'];

        $video = $_FILES['video'];
        move_uploaded_file($video['tmp_name'], '../../public/assets/img/eventos/' . $video['name']);
        $endereco_video = 'assets/img/eventos/' . $video['name'];

        $query = "INSERT INTO eventos ( titulo, descricao, data_inicio_evento, data_fim_evento, hora_inicio_evento, hora_fim_evento, data_inicio_insc_event, data_fim_insc_event,
        hora_inicio_insc_event, hora_fim_insc_event, banner, foto_1, foto_2, video, tipo_evento, endereco_evento, manager_user_id, nivel_user, user_ra, liberado) VALUES ('$titulo',
        '$desc', '$dataInicioEvento', '$dataFimEvento', '$hrInicioEvento', '$hrFimEvento', '$dataInicioInsc', '$dataFimInsc', '$hrInicioInsc',
        '$hrFimInsc', '$endereco_banner', '$endereco_foto1', '$endereco_foto2', '$endereco_video', '$tipoEvento', '$endereco', '$idUsr', '$nivelUsr', '$raUsr', 'NAO')";
        
        $result = mysqli_query($con, $query);
        if($result) echo '<script>alert("Evento Cadastrado com sucesso, aguarde liberação do Administrador."); window.location.href = "../../public/eventos.php";</script>';
        else echo '<script>alert("[ERRO] Não foi possivel cadastrar evento."); window.location.href = "../eventos.php";</script>';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Evento</title>
    <link rel="stylesheet" href="../../public/assets/CSS/eventos.css">

</head>
<body>
    <div class="login-box1">
        

    <h2>Cadastro de Evento</h2>

    <form action="" method="post" enctype="multipart/form-data">
        
    
        <div class="user-box">
        <label for=""></label>
        <input type="text" name="titulo" id="titulo" placeholder="Título do Evento" required><br>
        </div>

        <div class="user-box">
        <label for="">Data de início do Evento:</label><br>
        <input type="date" name="data_inicio_evento" id="data_inicio_evento" required><br>
        </div>

        <div class="user-box">
        <label for="">Data de Término do Evento:</label><br>
        <input type="date" name="data_fim_evento" id="data_fim_evento" required><br>
        </div>

        <div class="user-box">
        <label for="">Hora início do Evento:</label><br>
        <input type="time" name="hora_inicio_evento" id="hora_inicio_evento" required><br>
        </div>

        <div class="user-box">
        <label for="">Hora de Término do Evento:</label><br>
        <input type="time" name="hora_fim_evento" id="hora_fim_evento" required><br>
        </div>


        <div class="user-box">
        <label for="">Data de início de Inscrições do Evento:</label><br><br>
        <input type="date" name="data_inicio_insc_evento" id="data_inicio_insc_evento" required><br>
        </div>

        <div class="user-box">
        <label for="">Data de Término de Inscrições do Evento:</label><br><br>
        <input type="date" name="data_fim_insc_evento" id="data_fim_insc_evento" required><br>
        </div>

        <div class="user-box">
        <label for="">Hora de início de Inscrições do Evento:</label><br><br>
        <input type="time" name="hora_inicio_insc_evento" id="hora_inicio_insc_evento" required><br>
        </div>

        <div class="user-box">
        <label for="">Hora de término de Inscrições do Evento:</label><br><br>
        <input type="time" name="hora_fim_insc_evento" id="hora_fim_insc_evento" required><br>
        </div>

        <div class="user-box">
        <label for="">Banner do Evento</label><br>
        <input type="file" name="banner" id="banner" required><br>
        </div>

        <div class="user-box">
        <label for="">Foto 1 do Evento (Não obrigatório)</label><br>
        <input type="file" name="foto_1" id="foto_1" ><br>
        </div>

        <div class="user-box">
        <label for="">Foto 2 do Evento (Não obrigatório)</label><br>
        <input type="file" name="foto_2" id="foto_2" ><br>
        </div>

        <div class="user-box">
        <label for="">Vídeo do Evento (Não obrigatório)</label><br>
        <input type="file" name="video" id="video" ><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="endereco" id="endereco" placeholder="Endereço do Evento" required><br>
        </div>



        <div class="form-group">
        <label for="">Tipo de Evento:</label><br>
        <div>
        <input type="radio" name="tipo_evento" id="tipo_evento" value="atletica" required> Atlética<br>
        <input type="radio" name="tipo_evento" id="tipo_evento" value="institucional" required> Institucional<br>
        </div>
        </div>


        <div class="user-box">
        <label for=""></label>
        <textarea name="desc" id="desc" rows="5" cols="33" placeholder="Descrição do evento.." required></textarea>
        </div>

        <input type="submit" name="publicar" class="atualizar"  value="Publicar">


    </form>
 
        <a href="<?php echo $previous_page; ?>" name="sair">Voltar</a>
    
    </div>
    </div>
</body>
</html>

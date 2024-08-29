<?php
    include '../controllers/controllers.php';
    use App\Controllers\Controllers as Controllers;
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'principal.php';
    include '../database/conexao.php';
    include '../helpers/funcoes.php';
    if(!Controllers::isLogged()) header('Location: ../../public/principal.php');
    $userInfo = Controllers::getInfo();

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['atualizar'])){
        $titulo = $_POST['titulo'];
        $desc = $_POST['desc'];
        $endereco = $_POST['endereco'];
        $tipoEvento = $_POST['tipo_evento'];

        $idUsr = $_POST['id'];
        $nivelUsr = $_POST['nivel'];
        $raUsr = $_POST['ra'];

        $dataInicioEvento = $_POST['data_inicio_evento'];
        $dataFimEvento = $_POST['data_fim_evento'];
        $hrInicioEvento = $_POST['hora_inicio_evento'];
        $hrFimEvento = $_POST['hora_fim_evento'];
        
        $dataInicioInsc = $_POST['data_inicio_insc_evento'];
        $dataFimInsc = $_POST['data_fim_insc_evento'];
        $hrInicioInsc = $_POST['hora_inicio_insc_evento'];
        $hrFimInsc = $_POST['hora_fim_insc_evento'];

        $idEvento = $_POST['id_evento'];

        $banner = $_FILES['banner'];
        move_uploaded_file($banner['tmp_name'], '../../public/assets/img/eventos/' . $banner['name']);
        $endereco_banner = 'assets/img/atleticas/' . $banner['name'];

        $foto1 = $_FILES['foto_1'];
        move_uploaded_file($foto1['tmp_name'], '../../public/assets/img/eventos/' . $foto1['name']);
        $endereco_foto1 = 'assets/img/atleticas/' . $foto1['name'];

        $foto2 = $_FILES['foto_2'];
        move_uploaded_file($foto2['tmp_name'], '../../public/assets/img/eventos/' . $foto2['name']);
        $endereco_foto2 = 'assets/img/atleticas/' . $foto2['name'];

        $video = $_FILES['video'];
        move_uploaded_file($video['tmp_name'], '../../public/assets/img/eventos/' . $video['name']);
        $endereco_video = 'assets/img/atleticas/' . $video['name'];

        if($userInfo['nivel'] == 'ADM'){
            $query = "UPDATE eventos SET 
                        titulo = '$titulo', 
                        descricao = '$desc', 
                        data_inicio_evento = '$dataInicioEvento', 
                        data_fim_evento = '$dataFimEvento',
                        hora_inicio_evento = '$hrInicioEvento', 
                        hora_fim_evento = '$hrFimEvento', 
                        data_inicio_insc_event = '$dataInicioInsc', 
                        data_fim_insc_event = '$dataFimInsc',
                        hora_inicio_insc_event = '$hrInicioInsc', 
                        hora_fim_insc_event = '$hrFimInsc', 
                        banner = '$endereco_banner', 
                        foto_1 = '$endereco_foto1', 
                        foto_2 = '$endereco_foto2',
                        video = '$endereco_video', 
                        tipo_evento = '$tipoEvento', 
                        endereco_evento = '$endereco', 
                        manager_user_id = '$idUsr', 
                        nivel_user = '$nivelUsr', 
                        user_ra = '$raUsr', 
                        liberado = 'SIM' 
                    WHERE id = '$idEvento'";
            $result = mysqli_query($con, $query);

            if($result) {
                echo '<script>alert("Evento Atualizado."); window.location.href = "gerenEventos.php";</script>';
            } else {
                echo '<script>alert("[ERRO] Não foi possivel Atualizar evento."); window.location.href = "gerenEventos.php";</script>';
            }

        } else {
            $query = "UPDATE eventos SET 
                        titulo = '$titulo', 
                        descricao = '$desc', 
                        data_inicio_evento = '$dataInicioEvento', 
                        data_fim_evento = '$dataFimEvento',
                        hora_inicio_evento = '$hrInicioEvento', 
                        hora_fim_evento = '$hrFimEvento', 
                        data_inicio_insc_event = '$dataInicioInsc', 
                        data_fim_insc_event = '$dataFimInsc',
                        hora_inicio_insc_event = '$hrInicioInsc', 
                        hora_fim_insc_event = '$hrFimInsc', 
                        banner = '$endereco_banner', 
                        foto_1 = '$endereco_foto1', 
                        foto_2 = '$endereco_foto2',
                        video = '$endereco_video', 
                        tipo_evento = '$tipoEvento', 
                        endereco_evento = '$endereco', 
                        manager_user_id = '$idUsr', 
                        nivel_user = '$nivelUsr', 
                        user_ra = '$raUsr', 
                        liberado = 'NAO' 
                    WHERE id = '$idEvento'";
     
            $result = mysqli_query($con, $query);
            if($result) {
                echo '<script>alert("Evento Atualizado com sucesso, aguarde liberação do Administrador."); window.location.href = "gerenEventos.php";</script>';
            } else {
                echo '<script>alert("[ERRO] Não foi possivel Atualizar evento."); window.location.href = "gerenEventos.php";</script>';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Evento</title>
    <link rel="stylesheet" href="../../public/assets/CSS/eventos.css">

</head>
<body>
    <div class="login-box1">
        

    <h2>Edição de Evento</h2>

    <?php
        $idEvent = $_POST['editarEvento'];
        $result = infoEvento($con, $idEvent);
        $row = mysqli_fetch_assoc($result);
    ?>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_evento" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="id" value="<?php echo $row['manager_user_id']; ?>">
        <input type="hidden" name="nivel" value="<?php echo $row['nivel_user']; ?>">      
        <input type="hidden" name="ra" value="<?php echo $row['user_ra']; ?>">

        <div class="user-box">
            <label for=""></label>
            <input type="text" name="titulo" id="titulo" value="<?php echo $row['titulo']; ?>" required><br>
        </div>

        <div class="user-box">
            <label for="">Data de início do Evento:</label><br>
            <input type="date" name="data_inicio_evento" id="data_inicio_evento" value="<?php echo $row['data_inicio_evento']; ?>" required><br>
        </div>

        <div class="user-box">
            <label for="">Data de Término do Evento:</label><br>
            <input type="date" name="data_fim_evento" id="data_fim_evento" value="<?php echo $row['data_fim_evento']; ?>" required><br>
        </div>

        <div class="user-box">
            <label for="">Hora início do Evento:</label><br>
            <input type="time" name="hora_inicio_evento" id="hora_inicio_evento" value="<?php echo $row['hora_inicio_evento']; ?>" required><br>
        </div>

        <div class="user-box">
            <label for="">Hora de Término do Evento:</label><br>
            <input type="time" name="hora_fim_evento" id="hora_fim_evento" value="<?php echo $row['hora_fim_evento']; ?>" required><br>
        </div>

        <div class="user-box">
            <label for="">Data de início de Inscrições do Evento:</label><br><br>
            <input type="date" name="data_inicio_insc_evento" id="data_inicio_insc_evento" value="<?php echo $row['data_inicio_insc_event']; ?>" required><br>
        </div>

        <div class="user-box">
            <label for="">Data de Término de Inscrições do Evento:</label><br><br>
            <input type="date" name="data_fim_insc_evento" id="data_fim_insc_evento" value="<?php echo $row['data_fim_insc_event']; ?>" required><br>
        </div>

        <div class="user-box">
            <label for="">Hora de início de Inscrições do Evento:</label><br><br>
            <input type="time" name="hora_inicio_insc_evento" id="hora_inicio_insc_evento" value="<?php echo $row['hora_inicio_insc_event']; ?>" required><br>
        </div>

        <div class="user-box">
            <label for="">Hora de término de Inscrições do Evento:</label><br><br>
            <input type="time" name="hora_fim_insc_evento" id="hora_fim_insc_evento" value="<?php echo $row['hora_fim_insc_event']; ?>" required><br>
        </div>

        <div class="user-box">
            <label for="">Banner do Evento</label><br>
            <input type="file" name="banner" id="banner" required><br>
        </div>

        <div class="user-box">
            <label for="">Foto 1 do Evento (Não obrigatório)</label><br>
            <input type="file" name="foto_1" id="foto_1"><br>
        </div>

        <div class="user-box">
            <label for="">Foto 2 do Evento (Não obrigatório)</label><br>
            <input type="file" name="foto_2" id="foto_2"><br>
        </div>

        <div class="user-box">
            <label for="">Vídeo do Evento (Não obrigatório)</label><br>
            <input type="file" name="video" id="video"><br>
        </div>

        <div class="user-box">
            <label for=""></label>
            <input type="text" name="endereco" id="endereco" placeholder="Endereço do Evento" value="<?php echo $row['endereco_evento']; ?>" required><br>
        </div>


        <div class="form-group">
            <label for="">Tipo de Evento:</label><br>
            <div>
            <input type="radio" name="tipo_evento" id="tipo_evento" value="atletica" <?php echo ($row['tipo_evento'] == 'atletica') ? 'checked' : ''; ?> required> Atlética<br>
            <input type="radio" name="tipo_evento" id="tipo_evento" value="institucional" <?php echo ($row['tipo_evento'] == 'institucional') ? 'checked' : ''; ?> required> Institucional<br>
</div>

        </div>

        <div class="user-box">
            <label for=""></label>
            <textarea name="desc" id="desc" rows="5" cols="33" placeholder="Descrição do evento.." required><?php echo $row['descricao']; ?></textarea>
        </div>

        <input type="submit" name="atualizar" class="atualizar" value="Publicar">
    </form>
    
    <?php echo '<a href="'.$previous_page.'" name="sair">Voltar</a>'; ?>
    </div>
</body>
</html>

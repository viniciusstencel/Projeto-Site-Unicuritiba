
<?php
include '../app/controllers/controllers.php';
use App\Controllers\Controllers;

    function cadastrarUser($con){
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
            $nome = $_POST['nome'];
            $ra = $_POST['ra'];
            $senha = md5($_POST['senha']);
            $curso = $_POST['curso'];
            $atletica = $_POST['atletica'];
    
            $verifica = "SELECT * FROM users WHERE ra = '$ra';";
            $result = mysqli_query($con, $verifica);
    
    
            if($result){
                $tabelaData = array();
                while($row = mysqli_fetch_assoc($result)){
                    $tabelaData = $row; 
                }
            }
            
            if($tabelaData['ra'] !== $ra){
                $query = "INSERT INTO users (nome, ra, senha, curso, nivel, atletica, autorizado) VALUES ('$nome', '$ra', '$senha', '$curso', 'USER', '$atletica', 'NAO');";
                $result = mysqli_query($con, $query);
                
                echo '<script>alert("Cadastro feito com Sucesso."); window.location.href = "login.php";</script>';
            }else echo '<script>alert("[ERRO] R.A já cadastrado."); window.location.href = "cadastro.php";</script>';
        }
    }

    function loginUser($con){
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])){
            $ra = $_POST['ra'];
            $senha = md5($_POST['senha']);

            $queryVerifica = "SELECT * FROM users WHERE ra = '$ra' AND senha = '$senha';";
            $resultVerifica = mysqli_query($con, $queryVerifica);

            if(mysqli_num_rows($resultVerifica) > 0){
                if($resultVerifica){
                    $tabelaData = array();
                    while($row = mysqli_fetch_assoc($resultVerifica)){
                        $tabelaData = $row; 
                    }
                    $nome = $tabelaData['nome'];
                    $id = $tabelaData['id'];
                    $nivel = $tabelaData['nivel'];
                    $curso = $tabelaData['curso'];
                    $atletica = $tabelaData['atletica'];
                    
                    if($tabelaData['autorizado'] == 'SIM'){
                        Controllers::login($ra, $nome, $id, $nivel, $senha, $curso, $atletica);
                        header('Location: index.php');
                    }else echo '<script>alert("[ERRO] Usuario ainda não autorizado pelo administrador, tente novamente mais tarde."); window.location.href ="principal.php";</script>';

                }
            }else {
                echo '<script>alert("[ERRO] Usuario ou senha incorretos.");
                window.location.href ="login.php";</script>';
            }
        }
    }

    function reqCadastro($con){
            $query = "SELECT * FROM users WHERE autorizado = 'NAO';";
            $result = mysqli_query($con, $query);
            return $result;
    }
    function infoEvento($con, $idEvent){
        $query = "SELECT * FROM eventos WHERE id = '$idEvent';";
        $result = mysqli_query($con, $query);
        return $result;
    }
    function autorizarEvento($con, $idEvent){
        $queryAutorizar = "UPDATE eventos SET liberado = 'SIM' WHERE id = '$idEvent';";
        $resultAutorizar = mysqli_query($con, $queryAutorizar);
        if($resultAutorizar) echo '<script>alert("Evento autorizado.");window.location.href ="reqEventos.php";</script>';
        else echo '<script>alert("[ERRO] Não foi possivel autorizar Evento.");window.location.href ="reqEventos.php";</script>';
    }
    function autorizarAtletica($con, $idAtletica){
        $queryAutorizar = "UPDATE atleticas SET liberado = 'SIM' WHERE id = '$idAtletica';";
        $resultAutorizar = mysqli_query($con, $queryAutorizar);
        if($resultAutorizar){
            echo '<script>alert("Atlética autorizada.");
                    window.location.href ="reqAtleticas.php";</script>';
        }else echo '<script>alert("[ERRO] Erro ao autorizar Atlética.");
                    window.location.href ="reqAtleticas.php";</script>';
    }
    function excluirEvento($con, $idEvent){
        $queryExcluir = "DELETE FROM eventos WHERE id = '$idEvent';";
        $resultExcluir = mysqli_query($con, $queryExcluir);
        if($resultExcluir) echo '<script>alert("Evento excluído.");window.location.href ="reqEventos.php";</script>';
        else echo '<script>alert("[ERRO] Não foi possível excluír Evento.");window.location.href ="reqEventos.php";</script>';
    }
    function excluirAtletica($con, $idAtletica){
        $userInfo = Controllers::getInfo();
        $queryAutorizar = "DELETE FROM atleticas WHERE id = '$idAtletica';";
        $resultAutorizar = mysqli_query($con, $queryAutorizar);
        if($resultAutorizar){
            if($userInfo['nivel'] == 'ADM'){
                echo '<script>alert("Atlética Excluída.");
                        window.location.href ="../../public/painelADM.php";</script>';
                }else{
                    echo '<script>alert("Atlética Excluída.");
                    window.location.href ="gerenAtleticas.php";</script>';
                }
        }else{
                if($userInfo['nivel'] == 'ADM'){
                echo '<script>alert("[ERRO] Erro ao excluir Atlética.");
                    window.location.href ="../../public/painelADM.php";</script>';
                }else{
                    echo '<script>alert("[ERRO] Erro ao excluir Atlética.");
                    window.location.href ="gerenAtleticas.php";</script>';
                }
            }          
    }
    function infoComodidade($con, $id){
        $query = "SELECT * FROM comodidades WHERE id = '$id';";
        $result = mysqli_query($con, $query);
        return $result;
    }
    function excluirComodidade($con, $idComodidade){
        $queryExcluir = "DELETE FROM comodidades WHERE id = '$idComodidade';";
        $resultExcluir = mysqli_query($con, $queryExcluir);
        if($resultExcluir)echo '<script>alert("Comodidade Excluída.");window.location.href ="../../public/painelADM.php";</script>';
        else echo '<script>alert("[ERRO] Não foi possível excluir Comodidade.");window.location.href ="../../public/painelADM.php";</script>';

    }
    function autorizarCadUsr($con, $idUsr){
        $queryAutorizar = "UPDATE users SET autorizado = 'SIM' WHERE id = '$idUsr';";
        $resultAutorizar = mysqli_query($con, $queryAutorizar);
        if($resultAutorizar){
            echo '<script>alert("Usuário autorizado.");
                    window.location.href ="../views/reqCadastroUser.php";</script>';
        }else echo '<script>alert("[ERRO] Erro ao autorizar usuário.");
                    window.location.href ="../views/reqCadastroUser.php";</script>';
    }
    function infoEditarAtletica($con, $idAtletica){
        $query = "SELECT * FROM atleticas WHERE id = '$idAtletica';";
        $result = mysqli_query($con, $query);
        return $result;
    }
    function gerenUser($con){
        $query = "SELECT * FROM users WHERE id > 0;";
        $result = mysqli_query($con, $query);
        return $result;
    }
    function excluirUsr($con, $idUsr){
        $query = "DELETE FROM users WHERE id='$idUsr';";
        $result = mysqli_query($con, $query);
        if($result)echo '<script>alert("Usuário excluido com sucesso.");window.location.href ="../views/gerenUsers.php";</script>';
        else echo '<script>alert("[ERRO] Não foi possivel excluir usuário.");window.location.href ="../views/gerenUsers.php";</script>';
    }
    function infoEditarUsr($con, $idUsr){
        $query = "SELECT * FROM users WHERE id = '$idUsr';";
        $result = mysqli_query($con, $query);
        return $result;
    }
    function funcoesAdm($con){

        /*
        *@  Excluir Usuário
        */
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['excluirUsr'])){
            $idUsr = $_POST['excluirUsr'];
            $queryExcluir = "DELETE FROM users WHERE id = '$idUsr';";
            $resultExcluir = mysqli_query($con, $queryExcluir);
            if($resultExcluir) echo"<script>alert('Usuário Excluido com sucesso.')</script>";
            else echo"<script>alert('[ERRO] Não foi possível excluir usuário'.)</script>";
        }
        /*
        *@  Editar/Atualizar Usuário
        */
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['editarUsr'])){
            $idUsr = $_POST['editarUsr'];
            $query = "SELECT * FROM users WHERE id = '$idUsr';";
            $result = mysqli_query($con, $query);
            $row=mysqli_fetch_assoc($result);
            echo"
            <div class='atualizar-usr'>
             <h2 class='atualizacao'>Atualizar Usuário</h2>
              
                    <form action='' method='post'>
                        
                        <input type='hidden' name='id' value='".$row['id']."'>

                        <div class='formulario-ats'>


                        <div class='user-box'>
                        <label for=''></label>

                            <input type='text' id='nome' class='input-bordas' name='nome' placeholder='Nome do Usuário:'  value='".$row['nome']."' required><br><br>
                            </div>


                            <div class='user-box'>
                        <label for=''></label>
                            <input type='number' id='ra' class='input-bordas' name='ra' placeholder='R.A do Usuário:'  value='".$row['ra']."' required><br><br>
                            </div>



                            <div class='user-box'>
                        <label for=''></label>

                            <input type='password' id='senha' class='input-bordas' name='senha' placeholder='Nova senha:' required><br><br>
                            </div>

                        

                            <div class='user-box'>
                        <label for=''></label>

                            <input type='text' id='curso' class='input-bordas' name='curso' placeholder='Curso do Usuário:'  value='".$row['curso']."' required><br><br>
                            </div>

                        

                            <div class='user-box'>
                        <label for=''></label>

                            <input type='text' id='atletica' class='input-bordas' name='atletica' placeholder='Atlética do Usuário:'  value='".$row['atletica']."' required><br><br>
                            </div>

                        

                        
                        "; if($row['nivel'] == 'USER'){
                           echo '<label class="label">Nível:
                                    <input type="radio" name="nivel" id="nivel" value="USER" checked>USER
                                    <input type="radio" name="nivel" id="nivel" value="ADM">ADM<br><br>
                                </label>';

                        }else echo '<label class="label">Nível:
                                        <input type="radio" name="nivel" id="nivel" value="USER">USER
                                        <input type="radio" name="nivel" id="nivel" value="ADM" checked>ADM<br><br>
                                    </label>';
                        echo"
                        <label class='label'>Autorizado:
                            <input type='radio' name='autorizado' id='autorizado' value='SIM' required>SIM
                            <input type='radio' name='autorizado' id='autorizado' value='NAO'>NAO<br><br>
                        </label>

                        <input type='submit' name='atualizarUsr' value='Atualizar Usuário' onclick='return confirm(\"Tem certeza que deseja atualizar este usuário?\")'></input>
                    </form>    
                    </div>
                </div>"; 

        }
        /*
        *@  Editar/Atualizar Usuário
        */
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['atualizarUsr'])){
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $ra = $_POST['ra'];
            $senha = md5($_POST['senha']);
            $curso = $_POST['curso'];
            $atletica = $_POST['atletica'];
            $nivel = $_POST['nivel'];
            $autorizado = $_POST['autorizado'];

            $queryUpdate = "UPDATE users SET nome = '$nome', ra = '$ra', senha = '$senha', curso = '$curso', atletica = '$atletica', nivel = '$nivel', autorizado = '$autorizado' WHERE id ='$id';";
            $resultUpdate = mysqli_query($con, $queryUpdate);
            if($resultUpdate)echo"<script class='alerta'>alert('Usuário atualizado com sucesso.');window.location.href ='painelAdm.php';</script>";
            else echo"<script>alert('[ERRO] Não foi possível atualizar o usuário.');window.location.href ='painelAdm.php';</script>";
        }
    }
    function funcoesUser($con){
        /*
        *@  Editar/Atualizar Usuário
        */
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['gerenUser'])){
            $infoUsr = Controllers::getInfo();
            $id = $infoUsr['id'];
            $query = "SELECT * FROM users WHERE id = '$id';";
            $result = mysqli_query($con, $query);
            $row=mysqli_fetch_assoc($result);
            echo"


            <div class='atualizar-usr'>

             <h2 class='atualizacao'>Atualizar Informações</h2>

                    <form action='' method='post'>
                        
                        <input type='hidden' name='id' value='".$row['id']."'>

                        <div class='formulario-ats'>

                        <div class='user-box'>
                        <label for=''></label>
            
                            <input type='text' id='nome' class='input-bordas' name='nome' placeholder='Nome do Usuário:'  value='".$row['nome']."' required><br><br>
                            </div>

                            <div class='user-box'>
                            <label for=''></label>
                                <input type='number' id='ra' class='input-bordas' name='ra' placeholder='R.A do Usuário:'  value='".$row['ra']."' required><br><br>
                                </div>
                
                
                
                                <div class='user-box'>
                            <label for=''></label>
                
                                <input type='password' id='senha' class='input-bordas' name='senha' placeholder='Nova senha:' required><br><br>
                                </div>
                
                            
                
                                <div class='user-box'>
                            <label for=''></label>
                
                                <input type='text' id='curso' class='input-bordas' name='curso' placeholder='Curso do Usuário:'  value='".$row['curso']."' required><br><br>
                                </div>
                
                            
                
                                <div class='user-box'>
                            <label for=''></label>
                
                                <input type='text' id='atletica' class='input-bordas' name='atletica' placeholder='Atlética do Usuário:'  value='".$row['atletica']."' required><br><br>
                                </div>

                        <input type='submit' name='atualizarUsr' value='Atualizar Dados' onclick='return confirm(\"Tem certeza que deseja atualizar os dados?\")'></input>
                    </form>    
                    </div>
                </div>"; 
        }
        /*
        *@  Editar/Atualizar Usuário
        */
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['atualizarUsr'])){
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $ra = $_POST['ra'];
            $senha = md5($_POST['senha']);
            $curso = $_POST['curso'];
            $atletica = $_POST['atletica'];


            $queryUpdate = "UPDATE users SET nome = '$nome', ra = '$ra', senha = '$senha', curso = '$curso', atletica = '$atletica', nivel = 'USER', autorizado = 'SIM' WHERE id ='$id';";
            $resultUpdate = mysqli_query($con, $queryUpdate);
            if($resultUpdate)echo"<script>alert('Dados atualizados com sucesso.');window.location.href ='painelUser.php';</script>";
            else echo"<script>alert('[ERRO] Não foi possível atualizar os dados.');window.location.href ='painelUser.php';</script>";
        }
    }
<?php
    $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'principal.php';
    include '../app/database/conexao.php';
    include '../app/helpers/funcoes.php';
    loginUser($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="./assets/css/cadastro.css">
</head>
<body>

  <div class="login-box">
    <h2>Login</h2>
    <form action="" method="post">

      <div class="user-box">
        <label for=""></label>
        <input class="text" type="text" name="ra" id="ra" placeholder="R.A:" required><br>
      </div>

      <div class=user-box>
        <label for=""></label>
        <input class="password" type="password" name="senha" id="senha" placeholder="Senha:" required><br>
      </div>

      <input type="submit" name="login"  value="Login">
    </form>
  <a href="cadastro.php" class="cadastro">Não possui conta? Cadastre-se!</a>
    <a href="principal.php" name="sair">Voltar</a>

</div> 
</div>
        <div class="extras">
        </div>


</body>
</html>
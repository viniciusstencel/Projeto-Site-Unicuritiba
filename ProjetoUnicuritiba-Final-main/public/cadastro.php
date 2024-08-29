<?php
    include '../app/database/conexao.php';
    include '../app/helpers/funcoes.php';
    cadastrarUser($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./assets/CSS/cadastro.css">
</head>
<body>
    <div class="login-box1">
        
    <h2>Bem-Vindo ao cadastro de membros de atlética.</h2>
    <form action="" method="post">
        <div class="user-box">
        <label for=""></label>
        <input type="text" name="nome" id="nome" placeholder="Nome:"required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="ra" id="ra" placeholder="R.A:(Lembre-se o R.A será o seu no Login)"required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="password" name="senha" id="senha" placeholder="Senha:" required><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="curso" id="curso" placeholder="Curso:"><br>
        </div>

        <div class="user-box">
        <label for=""></label>
        <input type="text" name="atletica" id="atletica" placeholder="Atlética:"><br>
        </div>

        <input type="submit" name="cadastro"  value="Cadastrar-se">


    </form>

    <a href="login.php" name="sair">Voltar</a>
    </div>
    </div>
        <div class="extras">
        </div>
</body>
</html>

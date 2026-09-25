<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Dados</title>
</head>

<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>
    <main>
        <h1>Atualiza Dados</h1>
        <form action="" method="post">
            <label for="id">ID: </label>
            <input type="number" name="id" id="id" placeholder="Insira o ID para atualizar" required><br>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome"><br>
            <label for="turma">Turma: </label>
            <input type="text" name="turma" id="turma"><br>
            <label for="email">E-mail: </label>
            <input type="email" name="email" id="email"><br>
            <label for="nascimento">Nascimento: </label>
            <input type="date" name="nascimento" id="nascimento"><br>
            <label for="ativo">Ativo: </label><br>
            <input type="radio" name="ativo" id="ativo" value="true">
            <label for="ativo">Sim </label>
            <input type="radio" name="ativo" id="ativo" value="false">
            <label for="ativo">Não </label><br>
            <input type="submit" value="Atualizar ">
            <input type="reset" value="Limpar ">

        </form>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            atualizar($conexao, $_POST['id'], $_POST['nome'], $_POST['turma'], $_POST['nascimento'], $_POST['ativo'], $_POST['email']);
        }
        ?>

    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
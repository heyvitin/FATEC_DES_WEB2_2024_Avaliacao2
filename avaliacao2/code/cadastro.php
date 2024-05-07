<?php

session_start();


if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== TRUE) {
    header("Location: login.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h2>Cadastro</h2>
    <form method="post" action="classes.php">
        <label for="nome">Nome Completo:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="curso">Curso:</label><br>
        <select id="curso" name="curso" required>
            <option value="1">1-Desenvolvimento de Software</option>
            <option value="2">2-Gestao Empresarial</option>
        </select><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>

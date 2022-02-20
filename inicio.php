<?php
    session_start();

    if (!isset($_SESSION['logado'])) {
        header('Location: login.php');
    }
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1.0; user-scalable=no">
        <title>Molde PHP</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Molde PHP</h1>
        <h2>Página inicial</h2>
        Olá, <?php echo $_SESSION['nome']; ?>!
        <a href="logoff.php">Logoff</a>
        <a href="atualiza_cadastro.php?id=<?php echo $_SESSION['id']; ?>">Atualizar cadastro</a>
        <a href="exclui_cadastro.php?id=<?php echo $_SESSION['id']; ?>">Excluir cadastro</a>
    </body>
</html>
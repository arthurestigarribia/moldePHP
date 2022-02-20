<?php
    session_start();

    if (isset($_SESSION['logado'])) {
       header('Location: inicio.php');
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
        <h2>Fazer cadastro</h2>
        <form action="cadastro.php" method="post">
            <input type="text" name="nome" placeholder="Nome" minlength="8" maxlength="100">
            <input type="text" name="email" placeholder="Email" minlength="8" maxlength="100">
            <input type="password" name="senha" placeholder="Senha" minlength="8" maxlength="16">
            <input type="submit" text="Cadastrar">
        </form>
    </body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $c = mysqli_connect('localhost', 'root', '', 'moldephp') or die('Não foi possível se conectar ao banco de dados.');
        
        function validaUsuario($email, $senha){
            return preg_match("/(\S+)@(\S+).(\S+)/i", $email) && preg_match("/([a-zA-Z]+|[0-9]+){8,}/i", $senha);
        }

        function nenhumUsuario($c, $e, $s) {
            $q = mysqli_query($c, "SELECT email, senha FROM usuarios WHERE email = '$e' AND senha = md5('$s');") or die('Não foi possível se conectar ao banco de dados.');
            $r = mysqli_fetch_assoc($q);

            return empty($r);
        }

        function obtemId($c, $e, $s) {
            $q = mysqli_query($c, "SELECT id FROM usuarios WHERE email = '$e' AND senha = md5('$s');") or die('Não foi possível se conectar ao banco de dados.');
            $r = mysqli_fetch_assoc($q);

            return $r["id"];
        }

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (validaUsuario($email, $senha) && nenhumUsuario($c, $email, $senha)) {
            $insert = mysqli_query($c, "INSERT INTO usuarios(nome, email, senha) VALUES ('$nome', '$email', md5('$senha'));") or die('Não foi possível se conectar ao banco de dados.');

            $_SESSION['id'] = obtemId($c, $email, $senha);
            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            $_SESSION['logado'] = true;

            header("Location: inicio.php");

            echo 'Cadastrado com sucesso!';
        } else {
            unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'], $_SESSION['logado']);

            session_destroy();

            echo "Cadastro inválido.";
        }
    }
?>
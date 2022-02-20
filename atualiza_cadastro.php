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
        <h2>Atualizar cadastro</h2>
        <form action="atualiza_cadastro.php?id=<?php echo $_SESSION['id']; ?>" method="post">
            <input type="text" name="nome" placeholder="Nome" minlength="8" maxlength="100" value="<?php echo $_SESSION['nome']; ?>">
            <input type="text" name="email" placeholder="Email" minlength="8" maxlength="100" value="<?php echo $_SESSION['email']; ?>">
            <input type="password" name="senha" placeholder="Senha" minlength="8" maxlength="16">
            <input type="submit" text="Atualizar">
        </form>
    </body>
</html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $c = mysqli_connect('localhost', 'root', '', 'moldephp') or die('Não foi possível se conectar ao banco de dados.');
        
        function validaUsuario($email, $senha){
            return preg_match("/(\S+)@(\S+).(\S+)/i", $email) && preg_match("/([a-zA-Z]+|[0-9]+){8,}/i", $senha);
        }

        $id = $_SESSION['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        
        if (validaUsuario($email, $senha)) {
            $q = mysqli_query($c, "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = $id") or die('Não foi possível se conectar ao banco de dados.');

            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;
            $_SESSION['logado'] = true;

            header("Location: inicio.php");
        } else {
            echo "Erro ao atualizar cadastro.";
        }
    }
?>
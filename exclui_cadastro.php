<?php
    session_start();

    $id = $_GET['id'];

    $c = mysqli_connect('localhost', 'root', '', 'moldephp') or die('Não foi possível se conectar ao banco de dados.');

    $q = mysqli_query($c, "DELETE FROM usuarios WHERE id = $id");

    if ($q) {
        session_destroy();

        echo "Registro excluído com sucesso.";
        mysqli_close($c);

        header('Location: inicio.php');
    } else {
        echo "Erro ao excluir usuário.";
    }
?>
<?php
    session_start();

    $id = $_GET['id'];

    $c = mysqli_connect('localhost', 'root', '', 'moldephp') or die('Erro no banco de dados.');

    $q = mysqli_query($c, "DELETE FROM usuarios WHERE id = $id");

    if ($q) {
        session_destroy();

        echo "<div class='alert alert-success' role='alert'>Registro excluído com sucesso.</div>";
        mysqli_close($c);

        header('Location: inicio.php');
    } else {
        echo "<div class='alert alert-danger' role='alert'>Registro não excluído.</div>";
    }
?>
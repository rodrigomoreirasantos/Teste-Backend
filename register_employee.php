<?php
    session_start();
    @include_once './conexao.php';

    $nome_completo = filter_input(INPUT_POST,'nome_completo', FILTER_SANITIZE_STRING);
    $login = filter_input(INPUT_POST,'login', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);

    $result_employee = "INSERT INTO funcionarios (nome_completo, login, senha, saldo_atual, administrador_id, data_criacao, data_alteracao) VALUES ('$nome_completo', '$login', '$password',0,1, NOW(), NOW())";

    $resultado_employee = mysqli_query($conn, $result_employee);
    if(mysqli_insert_id($conn)){
        //$_SESSION['msg'] = "<p>Funcionário Cadastrado com Sucesso</p>";
        header("Location: panel.php");
    }else{
        //$_SESSION['msg'] = "<p>Funcionário Não Cadastrado</p>";
        header("Location: panel.php");
    }
?>
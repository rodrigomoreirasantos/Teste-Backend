<?php
    session_start();
    @include_once './conexao.php';
    
    $id = filter_input(INPUT_POST,'id', FILTER_SANITIZE_NUMBER_INT);
    $nome_completo = filter_input(INPUT_POST,'nome_completo', FILTER_SANITIZE_STRING);
    $login = filter_input(INPUT_POST,'login', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);
    $saldo_atual = filter_input(INPUT_POST,'saldo_atual', FILTER_SANITIZE_STRING);

    echo "ID = $id";
    echo "NOME = $nome_completo";
    echo "LOGIN = $login";
    echo "PASS = $password";
    echo "SALDO = $saldo_atual";

    $query = "UPDATE funcionarios SET nome_completo='$nome_completo', login='$login', senha='$password', data_alteracao=NOW() WHERE id='$id'";
    $result_employee = mysqli_query($conn,$query);
    
    if(mysqli_affected_rows($conn)){
        $_SESSION['msg'] = "<p>Usuário editado com sucesso</p>";
        header("Location: panel.php");
    }else{
        $_SESSION['msg'] = "<p>Usuário não foi editado com sucesso</p>";
        header("Location: panel.php");
    }


    
?>
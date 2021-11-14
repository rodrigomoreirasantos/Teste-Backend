<?php
    @include_once ("./conexao.php");

    $id = filter_input(INPUT_POST,'id', FILTER_SANITIZE_STRING);
    $tipo_movimentacao = filter_input(INPUT_POST,'tipo_movimentacao', FILTER_SANITIZE_STRING);
    $valor_movimentacao = filter_input(INPUT_POST,'valor_movimentacao', FILTER_SANITIZE_NUMBER_FLOAT);
    $observacao_movimentacao = filter_input(INPUT_POST,'observacao_movimentacao', FILTER_SANITIZE_STRING);
    $valor_movimentacao = $valor_movimentacao * 10;

    $query = "INSERT INTO movimentacao (tipo_movimentacao, valor, observacao, funcionario_id, administrador_id, data_criacao) VALUES ('$tipo_movimentacao', '$valor_movimentacao', '$observacao_movimentacao','$id',1, NOW())";

    $resultado_employee = mysqli_query($conn, $query);



    $query = "SELECT SUM(valor) as valor FROM movimentacao WHERE funcionario_id = '$id' AND tipo_movimentacao = 'saida'";
    $negative_money = mysqli_query($conn, $query);
    echo $total_negative = mysqli_fetch_assoc($negative_money);


    $query = "SELECT SUM(valor) as valor FROM movimentacao WHERE funcionario_id = '$id' AND tipo_movimentacao = 'entrada'";
    $positive_money = mysqli_query($conn, $query);
    echo $total_positive = mysqli_fetch_assoc($positive_money);

    $total_money = number_format($total_positive['valor'], 2, ",", ".") - number_format($total_negative['valor'], 2, ",", ".") ;

    $query = "UPDATE funcionarios SET saldo_atual='$total_money' WHERE id = '$id'";
    $refresh = mysqli_query($conn, $query);

    if(mysqli_insert_id($conn)){
    //     $_SESSION['msg'] = "<p>Movimentação Realizada com Sucesso</p>";
        header("Location: panel.php");
    }else{
    //     $_SESSION['msg'] = "<p>Movimentação Não Realizada</p>";
        header("Location: panel.php");
     }
?>
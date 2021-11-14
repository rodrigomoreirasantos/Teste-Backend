<?php
    @include_once './conexao.php';
    


    $query = "SELECT * FROM funcionarios WHERE id='".$_POST["id"]."'";
    $result_employee = mysqli_query($conn,$query);

    while($exibe = mysqli_fetch_array($result_employee)){
        $data = array(
            'id' => $exibe[0],
            'nome'=> $exibe[1],
            'login'=>$exibe[2],
            'senha'=>$exibe[3]
        );

    }
    
    echo json_encode($data);
?>
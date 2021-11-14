<?php
    @include_once './conexao.php';

    if(isset($_POST["id"])){
        $delete_employee = "DELETE FROM funcionarios WHERE id='".$_POST["id"]."'";
        if(mysqli_query($conn,$delete_employee)){
            echo "Funcionário Deletado";
        }
    }
?>
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> -->
    
    <link rel="stylesheet" href="./css/main.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    
    
    <script src="./js/dataTable.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>


    <title>Bonificação</title>
</head>
<body>

    <header class="s-hero">
        <div class="container-header">
            <div class="user">
                <button class="add-employee"><img src="./img/employee_add.svg" alt="Adicionar Funcionario"></button>  
            </div>
        </div>
    </header> 

    <div class="list-employee"> 
        <div class="container-infos">
            <table id="all-list-employee" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Saldo atual</th>
                        <th>Data de criação</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            <?php
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            ?>
            <div id="view-statement"></div>
            <div id="form-employee"></div>
            <div id="table-statement">
            <table id="all-list-statetment" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                   <th>ID</th>
                   <th>Tipo de Movimentação</th>
                   <th>Valor</th>
                   <th>Funcionário</th>
                   <th>Observação</th>
                   <th>Data de Cadastro</th>
               </tr>
          </thead>
       </table>
            </div>
            
        </div> 
    </div>
    
   
    <script src="./js/formCadastro.js"></script>
    <script src="./js/formStatement.js"></script>
    <script src="./js/formEdit.js"></script>

</body>
</html>
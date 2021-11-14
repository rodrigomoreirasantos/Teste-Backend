<?php
    @include_once './conexao.php';
    // Checa a conexao
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    $query = "SELECT * FROM movimentacao WHERE funcionario_id='".$_GET["id"]."'";

    if ($result = $conn->query($query)) {

        // Fetch Objeto de array
        while ($row = $result->fetch_row()) {
            printf ("%s %s %s %s\n", $row[6], $row[1], $row[2], $row[3]);
        }

        $result->close();
    }

    //Encerra conexao
    $conn->close();
?>
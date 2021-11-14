<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/main.css">
    <title>Boonificação</title>
</head>
<body class="login">
    <div class="modal-login">
        <p class="text-error">
            <?php
                if(isset($_SESSION['loginError'])){
                    echo $_SESSION['loginError'];
                    unset($_SESSION['loginError']);
                }
            ?>
        </p>
        <form class="form-signin" method="post" action="valida.php">
            <h2 class="form-signin-head">Nano Incube Teste</h2>
            <label for="inputLogin" class="sr-only">Login</label>
            <input type="text" name="login" id="inputLogin" class="form-control" required autofocus >
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" name="senha" id="inputPassword" class="form-control" required >
            <button class="btn-access" type="submit">Acessar</button>
        </form>
    </div>
    
</body>
</html>
<?php
	session_start();	
	//Incluindo a conexão com banco de dados
	include_once("./conexao.php");	
	//O campo usuário e senha preenchido entra no if para validar
	if((isset($_POST['login'])) && (isset($_POST['senha']))){
		$usuario = mysqli_real_escape_string($conn, $_POST['login']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
		$senha = mysqli_real_escape_string($conn, $_POST['senha']);
		//$senha = md5($senha);
			
		//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
		$result_usuario = "SELECT * FROM administrador WHERE login = '$usuario' && senha = '$senha' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		$resultado = mysqli_fetch_assoc($resultado_usuario);
		
        if(empty($resultado)){
            $_SESSION['loginErro'] = "Usuário ou senha inválido";
		    header("Location: index.php");
        }elseif(!empty($resultado)){
            header("Location: panel.php");
        }else{
            $_SESSION['loginErro'] = "Usuário ou senha inválido";
		    header("Location: index.php");
        }
		
	//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
	}else{
		$_SESSION['loginErro'] = "Usuário ou senha inválido";
		header("Location: index.php");
	}
?>
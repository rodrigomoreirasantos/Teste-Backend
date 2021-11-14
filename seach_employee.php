<?php

@include_once './conexao.php';

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;


//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array( 
	0 =>'id',
    1 => 'nome_completo',
    2 => 'saldo_atual',
    3 => 'data_criacao'

);

//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT id, nome_completo, saldo_atual, data_criacao FROM funcionarios";
$resultado_user =mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT id, nome_completo, saldo_atual, data_criacao FROM funcionarios WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios.=" AND ( nome_completo LIKE '".$requestData['search']['value']."%' ";    
	$result_usuarios.=" OR data_criacao LIKE '".$requestData['search']['value']."%' )";
}
$resultado_usuarios=mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);

//Ordenar o resultado
$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_usuarios=mysqli_query($conn, $result_usuarios);

// Ler e criar o array de dados
$dados = array();
	while( $row_usuarios =mysqli_fetch_array($resultado_usuarios) ) {  
	$dado = array(); 
	$dado[] = $row_usuarios["id"];
	$dado[] = $row_usuarios["nome_completo"];
	$dado[] = number_format($row_usuarios["saldo_atual"], 2, ",", ".") ;
	$dado[] = $row_usuarios["data_criacao"];
    $dado[] = '<div class="button-action-employee">
    <button class="btn-view" id="'.$row_usuarios["id"].'"><img src="./img/description.svg" alt="Visualizar Movimentacao"><p class="btn-info-actions">Visualizar Movimentção</p></button>
    <button class="btn-statement" id="'.$row_usuarios["id"].'"><img src="./img/statement.svg" alt="Nova Movimentacao"><p>Nova Movimentação</p></button>
    <button class="btn-edit" id="'.$row_usuarios["id"].'"><img src="./img/edit.svg" alt="Editar Funcionario"><p>Editar Funcionário</p></button>
    <button class="btn-delete" id="'.$row_usuarios["id"].'"><img src="./img/delete.svg" alt="Deletar Funcionario"><p>Deletar Funcionário</p></button>
    </div>';

	$dados[] = $dado;
}


//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data);  //enviar dados como formato json

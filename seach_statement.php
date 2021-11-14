<?php

@include_once './conexao.php';

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;

$query = "SELECT * FROM funcionarios WHERE id='".$_POST["id"]."'";
$result_nameEmployee = mysqli_query($conn, $query);

//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array( 
	0 =>'id',
    1 => 'tipo_movimentacao',
    2 => 'valor',
    3 => 'nome_completo',
    4 => 'observacao',
    5 => 'data_criacao'

);


//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT movimentacao.id, movimentacao.tipo_movimentacao, movimentacao.valor, funcionarios.nome_completo, movimentacao.observacao, movimentacao.data_criacao FROM movimentacao
INNER JOIN funcionarios ON movimentacao.funcionario_id = funcionarios.id
WHERE movimentacao.funcionario_id = '".$_POST["id"]."' 
ORDER BY movimentacao.data_criacao DESC";

$resultado_user =mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT movimentacao.id, movimentacao.tipo_movimentacao, movimentacao.valor, funcionarios.nome_completo, movimentacao.observacao, movimentacao.data_criacao FROM movimentacao
INNER JOIN funcionarios ON movimentacao.funcionario_id = funcionarios.id
WHERE movimentacao.funcionario_id = '".$_POST["id"]."'";

if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios.=" AND ( observacao LIKE '".$requestData['search']['value']."%' ";    
	$result_usuarios.=" OR tipo_movimentacao LIKE '".$requestData['search']['value']."%' )";
}
$resultado_usuarios=mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);

//$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']." ";
$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." DESC LIMIT ".$requestData['start'].",".$requestData['length']." ";
$resultado_usuarios=mysqli_query($conn, $result_usuarios);

// Ler e criar o array de dados
$dados = array();
	while( $result_statetment = mysqli_fetch_array($resultado_usuarios) ) {  
	$dado = array(); 
	$dado[] = $result_statetment["id"];
	$dado[] = $result_statetment["tipo_movimentacao"];
	$dado[] = $result_statetment["valor"];
	$dado[] = $result_statetment["nome_completo"];
	$dado[] = $result_statetment["observacao"];
	$dado[] = $result_statetment["data_criacao"];
    
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














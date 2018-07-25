<?php
require_once "../config.php";

$id_vacina= $_POST['id_vacina'];
$nome_vacina= $_POST['nome_vacina'];
$imunizacao= $_POST['imunizacao'];
$duracao_vacina= $_POST['duracao_vacina'];
$obs_vacina= $_POST['obs_vacina'];

$action = $_POST['action'];

$Item = new Tb_vacina();
$Item->SetValues($id_vacina, $nome_vacina, $imunizacao, $duracao_vacina, $obs_vacina);

switch($action){
	case 'create':

	$res = $Item->Create();
	$res = json_decode($res);

	if($res->{'result'} === NULL){
		$result['res'] = "true";
	}else{
		$result['res'] = "false";
	}

	$result['id_usuario'] = $res->{'lastId'};

	echo json_encode($result);
	break;

	case 'update':
	$res = $Item->Update();

	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;

	case 'delete':

	$res = $Item->Delete();
	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;

	};
?>
<?php
require_once "../config.php";

$id_registro= $_POST['id_registro'];
$fk_usuario= $_POST['fk_usuario'];
$fk_vacina= $_POST['fk_vacina'];
$data_vacinacao= $_POST['data_vacinacao'];
$fk_aplicador= $_POST['fk_aplicador'];

$action = $_POST['action'];

$Item = new Tb_registro();
$Item->SetValues($id_registro, $fk_usuario, $fk_vacina, $data_vacinacao, $fk_aplicador);

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
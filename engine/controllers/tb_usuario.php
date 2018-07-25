<?php
require_once "../config.php";

$id_usuario= $_POST['id_usuario'];
$nome_usuario= $_POST['nome_usuario'];
$sexo_usuario= $_POST['sexo_usuario'];
$cpf_usuario= $_POST['cpf_usuario'];
$data_nasc= $_POST['data_nasc'];
$tipo_usuario= $_POST['tipo_usuario'];
$senha_usuario= $_POST['senha_usuario'];

$action = $_POST['action'];

$Item = new Tb_usuario();
$Item->SetValues($id_usuario, $nome_usuario, $sexo_usuario, $cpf_usuario, $data_nasc, $tipo_usuario, password_hash($senha_usuario, PASSWORD_DEFAULT));

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

	case 'updateSenha':
	$res = $Item->UpdateSenha($id_usuario);

	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;

	case 'cripto':
	$tb_usuario = new Tb_usuario();
	$tb_usuario = $tb_usuario->Read($_POST['id_usuario']);
	$senha_temp = $tb_usuario['senha_usuario'];

	if (password_verify($senha_usuario, $senha_temp)) {
		$res = "true";
	} else {
		$res = "false";
	}
	echo $res;
	break;

	case 'updateAcesso':
	$res = $Item->updateAcesso($id_usuario);

	if($res === NULL){
		$res= 'true';
	}else{
		$res = 'false';
	}
	echo $res;
	break;
};
?>
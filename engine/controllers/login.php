<?php session_start();

	require_once "../config.php";

	$cpf = addslashes($_POST['cpf']);
	$senha = addslashes($_POST['senha']);
	$res;

	$Tb_usuario = new Tb_usuario();
	$Tb_usuario = $Tb_usuario->ReadByCpf($cpf);

	if ($Tb_usuario === NULL) {
		$res = 'no_user_found';
		session_destroy();
	}else if ($Tb_usuario['tipo_usuario'] != 0) {
		$res = 'no_permission';
		session_destroy();
	} else {
		$verificaCpf = strcmp($cpf,$Tb_usuario['cpf_usuario']);
		if ($verificaCpf === 0) {
			$verificaSenha = password_verify($senha,$Tb_usuario['senha_usuario']);
			if ($verificaSenha) {
				$_SESSION['id_usuario'] = $Tb_usuario['id_usuario'];
				$_SESSION['nome_usuario'] = $Tb_usuario['nome_usuario'];
				$_SESSION['sexo_usuario'] = $Tb_usuario['sexo_usuario'];
				$_SESSION['cpf_usuario'] = $Tb_usuario['cpf_usuario'];
				$_SESSION['data_nasc'] = $Tb_usuario['data_nasc'];
				$_SESSION['tipo_usuario'] = $Tb_usuario['tipo_usuario'];

				$res = 'true';
			}
			else {
				$res = 'wrong_password';
				session_destroy();
			}
		} else {
			$res = 'wrong_user_found';
			session_destroy();
		}
	}

	echo $res;
?>
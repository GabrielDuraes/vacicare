<?php
$showerros = true;
if($showerros) {
	ini_set("display_errors", $showerros);
	error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}

session_start();
// Inicia a sessão
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vacicare</title>

	<link rel = "shortcut icon" type = "imagem/x-icon" href = "img/favicon.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/foundation.min.css" rel="stylesheet">
	<link href="css/home.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

	<div id="home">
		<div id="menu">
			<a href="<?php if($_SESSION){echo "admin/";}else{echo "index.php";} ?>"><img src="img/logo.png" id="logo"></a>
			<?php if(!$_SESSION){ ?>
				<a style="margin: 0.5em;" data-open="modal_login" id="login"><i class="fa fa-lock"></i> Login</a>
			<?php }else{ ?>
				<ul class="dropdown menu" data-dropdown-menu style="display: inline-block;">
					<li>
						<a  id="login"><i class="fa fa-unlock"></i> <?php echo $_SESSION['nome_usuario']; ?></a>
						<ul class="menu" id="submenu">
							<li data-open="perfil_user"><a> <i class="fa fa-user-edit"></i>  Editar Perfil</a></li>
							<li data-open="alterar_senha"><a> <i class="fa fa-edit"></i>  Alterar Senha</a></li>
							<li class="getout"><a><i class="fa fa-sign-out-alt"></i>  Sair</a></li>
						</ul>
					</li>
				</ul>
			<?php } ?>
		</div>

		<?php 
		require_once "engine/config.php";

		$tb_usuario = new Tb_usuario();
		$tb_usuario = $tb_usuario->ReadByCpf($_GET['cpf']);

		$id = $tb_usuario['id_usuario'];
		$nome = $tb_usuario['nome_usuario'];
		$tipo_user = $tb_usuario['tipo_usuario'];

		if(empty($tb_usuario)){
			echo '<h1 class="text-center">Usuário não encontrado!</h1>';
		}else{
		?>

		<div class="cell small-1"></div>
		<br>
		<div class="cell medium-12 small-10">
			<h4 class="text-center" style="color: #fff; margin-top: -2em;">Cartão de Vacina de <?php echo $nome ?></h4>
		</div> 
		<div class="cell small-12" style="display: block; text-align: center;">
			<?php if($_SESSION){ ?>
				<button data-open="add_vacina" style="margin-left: 1em;" type="button" class="success button small">Adicionar Vacina <i class="fa fa-plus"></i></button>
				<button id="delete_user" style="margin-left: 1em;" type="button" class="alert button small">Apagar Usuário <i class="fa fa-trash"></i></button>
					<?php if ($tipo_user == 1) { ?>
						<button id="update_tipouser" style="margin-left: 1em;" type="button" class="warning button small">Dar Acesso <i class="fa fa-unlock"></i></button>
					<?php }else { ?>
						<button id="update_tipouser_user" style="margin-left: 1em;" type="button" class="warning button small">Remover Acesso <i class="fa fa-lock"></i></button>
			<?php 
					} 
				} 
			?>
		</div>

		<div class="table-scroll hover" style="padding: 0 1em;">
			<?php

			$tb_registro = new Tb_registro();
			$tb_registro = $tb_registro->Readfk_user($id);

			if(!$tb_registro){ ?>
				<h3 class="text-center" style="color: #fff; margin-top: 5em;"> Nenhuma vacina encontrada! </h3>
				<?php
			}else{
				?>
				<table style="width:100%; font-size: 0.9em; margin-top: 1em;">
					<tr style="background: ; color: ;">
						<th>Vacina</th>
						<th>Imunização</th> 
						<th>Período de Imunização</th>
						<th>Observações</th>
						<th>Data da aplicação</th>
						<th>Nome do Aplicador</th>
						<th <?php if(!$_SESSION){ echo 'style="display: none;"';} ?>>Deletar</th>
					</tr>
					<?php 
					foreach ($tb_registro as $tb_registro) {
						?>
						<tr class="text-center">
							<td><?php 
							$tb_vacina = new Tb_vacina();
							$tb_vacina = $tb_vacina->Read($tb_registro['fk_vacina']);
							echo $tb_vacina['nome_vacina'];
							?></td>
							<td><?php echo $tb_vacina['imunizacao']; ?></td> 
							<td><?php echo $tb_vacina['duracao_vacina']; ?></td>
							<td><?php echo $tb_vacina['obs_vacina']; ?></td>
							<td><?php echo $tb_registro['data_vacinacao'] ?></td> 
							<td><?php 
							$tb_usuario = new Tb_usuario();
							$tb_usuario = $tb_usuario->Read($tb_registro['fk_aplicador']);
							echo $tb_usuario['nome_usuario'];
							?></td>
							<td class="delete" id="<?php echo $tb_registro['id_registro']?>" <?php if(!$_SESSION){ echo 'style="display: none;"';} ?>><i class="fa fa-trash"></i></td>
						</tr>
						<?php 
					}
					?>
				</table>
				<?php 
			}
		}
			?>
		</div>

		<div id="footer">
			Desenvolvido por Durães, Lipin e Pedro
		</div>
	</div>

	<div class="reveal animated bounceInDown" id="modal_login" data-reveal data-overlay="false">
		<img src="img/logo1.png" style="width: 200px; display: block; margin-left: auto; margin-right: auto;">
		<br>
		<div class="input-group">
			<span class="input-group-label"><i class="fa fa-user"></i></span>
			<input class="input-group-field" id="cpf_login" type="text" placeholder="CPF">
		</div>

		<div class="input-group">
			<span class="input-group-label"><i class="fa fa-unlock"></i></span>
			<input class="input-group-field" type="password" id="password" placeholder="Senha">
		</div>

		<p style="text-align: center;"><button type="button" class="success button" style="background: #2980b9; color: #fff; font-weight: 600;" id="logar">Entrar <i class="fa fa-play"></i> </button></p>
		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>


	<!-- modal editar perfil -->
	<div class="reveal animated bounceInDown" id="perfil_user" data-reveal data-overlay="false">
		<h4 class="text-center">Editar Perfil</h4>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-user"></i></span>
			<input class="input-group-field" type="text" id="nome_usuario_edita" value="<?php echo $_SESSION['nome_usuario'] ?>" placeholder="Nome do Usuário">
		</div>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-flag"></i></span>
			<select class="input-group-field" id="sexo_usuario_edita" style="font-size: 1.2em; color: #777; padding: 0.5em;">
				<option value="" selected disabled>Gênero</option>
				<option <?php if($_SESSION['nome_usuario'] == 0){echo 'selected';} ?> value="0">Masculino</option>
				<option <?php if($_SESSION['nome_usuario'] == 1){echo 'selected';} ?> value="1">Feminino</option>
				<option <?php if($_SESSION['nome_usuario'] == 2){echo 'selected';} ?> value="2">Outro</option>
			</select>
		</div>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-address-card"></i></span>
			<input class="input-group-field" type="text" id="cpf_edita" value="<?php echo $_SESSION['cpf_usuario'] ?>" placeholder="CPF do Usuário">
		</div>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-calendar"></i></span>
			<input class="input-group-field" type="text" id="data_nasc_edita" value="<?php $nova_data = str_replace("-", "/", $_SESSION['data_nasc']);
		echo date('d/m/Y', strtotime($nova_data)); ?>" placeholder="Data de Nascimento">
		</div>

		<!--<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-users"></i></span>
			<select class="input-group-field" id="tipo_user_edita" style="font-size: 1.2em; color: #777; padding: 0.5em;">
				<option value="husker" selected disabled>Tipo de Usuário</option>
				<option <?php if($_SESSION['nome_usuario'] == 0){echo 'selected';} ?> value="0">Admin</option>
				<option <?php if($_SESSION['nome_usuario'] == 1){echo 'selected';} ?> value="1">User</option>
			</select>
		</div>-->

		<p style="text-align: center;"><button type="button" class="success button" style="background: #2980b9; color: #fff; font-weight: 600;" id="editar_user">Alterar <i class="fa fa-check"></i> </button></p>
		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<!-- modal alterar senha -->
	<div class="reveal animated bounceInDown" id="alterar_senha" data-reveal data-overlay="false">
		<h4 class="text-center">Alterar senha</h4>
		
		<div class="input-group">
			<span class="input-group-label"><i class="fa fa-key"></i></span>
			<input  class="input-group-field" type="password" id="senha_atual"  placeholder="Senha Atual">
		</div>
		<div class="input-group">
			<span class="input-group-label"><i class="fa fa-key"></i></span>
			<input class="input-group-field" type="password" id="senha_nova" placeholder="Senha Nova">
		</div>

		<p style="text-align: center;"><button type="button" class="success button" style="background: #2980b9; color: #fff; font-weight: 600;" id="muda_senha">Alterar <i class="fa fa-retweet"></i> </button></p>
		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<!-- modal add vacina -->
	<div class="reveal animated bounceInDown" id="add_vacina" data-reveal data-overlay="false">
		<h4 class="text-center">Adicionar Vacina</h4>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-flag"></i></span>
			<select class="input-group-field" id="fk_vacina" style="font-size: 1.2em; color: #777; padding: 0.5em;">
				<option value="" selected disabled>Vacina</option>
				<?php 
				$tb_vacina = new Tb_vacina();
				$tb_vacina = $tb_vacina->ReadAll();
				foreach ($tb_vacina as $vacina) {
					?>
					<option value="<?php echo $vacina['id_vacina']; ?>"><?php echo $vacina['nome_vacina']; ?></option>
				<?php }?>
			</select>
		</div>

		<p style="text-align: center;"><button type="button" class="success button" style="background: #2980b9; color: #fff; font-weight: 600;" id="adiciona_vacina">Adicionar <i class="fa fa-plus"></i> </button></p>

		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/foundation.js"></script>
	<script src="js/vanilla_mask.js"></script>
	<script>
		$(document).foundation();
		VMasker(document.querySelector("#data_nasc_edita")).maskPattern("99/99/9999");
		VMasker(document.querySelector("#cpf_login")).maskPattern("999.999.999-99");
		$(document).ready(function(e) {
			$('#password').keypress(function (e) {
				var key = e.which;
				if(key == 13){
					$('#logar').click();
					return false;
				}
			});

			$('.delete').click(function(e) {
				e.preventDefault();
				var id_registro = $(this).attr('id');

				swal("Deseja apagar este registro de vacinação?", {
					buttons: {
						cancel: "Cancelar",
						defeat: {
							text: "Ok",
							value: "apagar",
						},
					},
				})
				.then((value) => {
					switch (value) {

						case "apagar":
						$.ajax({
							url: 'engine/controllers/tb_registro.php',
							data: {
								id_registro : id_registro,

								action: 'delete'
							},
							success: function(data) {
								if(data === 'true') {
									swal("Registro Apagado!", {
										buttons: {
											defeat: {
												text: "Ok",
												value: "apagar",
											},
										},
									})
									.then((value) => {
										switch (value) {
											case "apagar":
											location.reload();
											break;

											default:
											location.reload();
										}
									});
								}
							},
							type: 'POST'
						});
						break;

						default:
						swal("Cancelado!");
					}
				});
			});

			$('#delete_user').click(function(e) {
				e.preventDefault();
				var id_user = '<?php echo $id; ?>'

				swal("Deseja deletar este usuário?", {
					buttons: {
						cancel: "Cancelar",
						defeat: {
							text: "Ok",
							value: "apagar",
						},
					},
				})
				.then((value) => {
					switch (value) {

						case "apagar":
						$.ajax({
							url: 'engine/controllers/tb_usuario.php',
							data: {
								id_usuario : id_user,

								action: 'delete'
							},
							success: function(data) {
								if(data === 'true') {
									swal("Usuário Deletado!", {
										buttons: {
											defeat: {
												text: "Ok",
												value: "apagar",
											},
										},
									})
									.then((value) => {
										switch (value) {
											case "apagar":
											window.location = "admin";
											break;

											default:
											window.location = "admin";
										}
									});
								}
							},
							type: 'POST'
						});
						break;

						default:
						swal("Cancelado!");
					}
				});
			});

			$('#adiciona_vacina').click(function(e) {
				e.preventDefault();
				
				var fk_vacina = $('#fk_vacina').val();
				var fk_aplicador = '<?php echo $_SESSION['id_usuario']; ?>';
				var id_usuario = '<?php echo $id; ?>';

				if(fk_vacina == null || fk_aplicador == null || id_usuario == ""){
					swal({title: "Ops!", text: "Preencha todos os dados!", icon: "error", button: "OK",})
				}else{
					$.ajax({
						url: 'engine/controllers/tb_registro.php',
						data: {
							fk_usuario : id_usuario,
							fk_vacina : fk_vacina,
							fk_aplicador : fk_aplicador,

							action: 'create'
						},
						async: false,
						success: function(data) {
							obj = JSON.parse(data);
							if (obj.res == 'true') {
								swal({title: "Oba!", text: "Registro Cadastrado!", icon: "success",
									buttons: {
										defeat: {
											text: "Ok",
											value: "ok",
										},
									},
								})
								.then((value) => {
									switch (value) {
										case "ok":
										location.reload();
										break;

										default:
										location.reload();
									}
								});
							}
						},
						type: 'POST'
					});
				}
			});

			$('#logar').click(function(e) {
				e.preventDefault();
				var cpf = $('#cpf_login').val();
				var senha = $('#password').val();

				var cpf_pesquisa = '<?php echo $_GET['cpf'] ?>';

				if(cpf === "" || senha === "") {
					swal({title: "Oops!", text: "Preencha todos os campos!", icon: "warning", button: "OK",})
				} else { 
					$.ajax({
						url: 'engine/controllers/login.php',
						data: {
							cpf : cpf,
							senha: senha
						},
						error: function() {
							alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
						},
						success: function(data) {
							if(data === 'true') {
								document.location = 'pesquisa.php?cpf='+cpf_pesquisa;
							} else if(data === 'no_user_found') {
								swal({title: "Oops!", text: "Usuário não encontrado!", icon: "warning", button: "OK",})
							} else if(data === 'wrong_password') {
								swal({title: "Oops!", text: "Senha incorreta!", icon: "error", button: "OK",})
							} else if(data === "no_permission"){
								swal({title: "Oops!", text: "Você não tem permissão para acessar esta área!", icon: "error", button: "OK",})
							} else {
								alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
							}
						},

						type: 'POST'
					});
				}
			});

			$('.getout').click(function(e) {
				e.preventDefault();
				$.ajax({
					url: 'engine/controllers/logout.php',
					data: {

					},
					error: function() {
						alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
					},
					success: function(data) {
						console.log(data);
						if(data === 'kickme'){
							location.reload();
						}

						else{
							alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
						}
					},

					type: 'POST'
				});

			});

			$('#muda_senha').click(function(e) {
				e.preventDefault();
				
				var senha_atual = $('#senha_atual').val();
				var senha_nova = $('#senha_nova').val();

				var id_usuario = '<?php echo $_SESSION['id_usuario']; ?>';

				if(senha_atual == "" || senha_nova == ""){
					swal({title: "Oops!", text: "Preencha todos os campos!", icon: "warning", button: "OK",})
				}else{
					$.ajax({
						url: 'engine/controllers/tb_usuario.php',
						data: {
							id_usuario : id_usuario,
							senha_usuario : senha_atual,

							action: 'cripto'
						},
						async: false,
						success: function(data) {
							if(data === 'true'){
								$.ajax({
									url: 'engine/controllers/tb_usuario.php',
									data: {
										id_usuario : id_usuario,
										senha_usuario : senha_nova,

										action: 'updateSenha'
									},
									async: false,
									success: function(data) {
										if(data === 'true'){
											swal({title: "Oba!", text: "Senha Alterada!", icon: "success", button: "OK",})
										}
									},
									type: 'POST'
								});
							}else{
								swal({title: "Oops!", text: "Sua senha atual esta incorreta!", icon: "error", button: "OK",})
							}
						},
						type: 'POST'
					});
				}
			});

			$('#editar_user').click(function(e) {
				e.preventDefault();
				
				var nome_usuario_edita = $('#nome_usuario_edita').val();
				var sexo_usuario_edita = $('#sexo_usuario_edita').val();
				var cpf_edita = $('#cpf_edita').val();
				var data_nasc_edita = $('#data_nasc_edita').val();
				var id = '<?php echo $_SESSION['id_usuario'] ?>'

				var parts = data_nasc_edita.split('/');
		        var ano = parts[2];
		        var mes = parts[1];
		        var dia = parts[0];

          		data_nasc_edita = ([ano, mes, dia].join('-'));

				if(nome_usuario_edita == "" || sexo_usuario_edita == "" || cpf_edita == "" || data_nasc_edita == "--"){
					swal({title: "Ops!", text: "Preencha todos os dados!", icon: "error", button: "OK",})
				}else{
					$.ajax({
						url: 'engine/controllers/tb_usuario.php',
						data: {
							id_usuario: id,
							nome_usuario : nome_usuario_edita,
							sexo_usuario : sexo_usuario_edita,
							cpf_usuario : cpf_edita,
							data_nasc : data_nasc_edita,

							action: 'update'
						},
						async: false,
						success: function(data) {
							if (data == 'true') {
								swal({title: "Oba!", text: "Usuário Editado!", icon: "success",
									buttons: {
										defeat: {
											text: "Ok",
											value: "ok",
										},
									},
								})
								.then((value) => {
									switch (value) {
										case "ok":
										location.reload();
										break;

										default:
										location.reload();
									}
								});
							}
						},
						type: 'POST'
					});
				}
			});

			$('#update_tipouser').click(function(e) {
				e.preventDefault();
				var id_usuario = '<?php echo $id; ?>'
				swal("Deseja Dar Acesso de Administrador a este usuário?", {
					buttons: {
						cancel: "Cancelar",
						defeat: {
							text: "Ok",
							value: "ok",
						},
					},
				})
				.then((value) => {
					switch (value) {

						case "ok":
						$.ajax({
							url: 'engine/controllers/tb_usuario.php',
							data: {
								id_usuario : id_usuario,
								tipo_usuario: 0,
								senha_usuario : '12345',

								action: 'updateAcesso'
							},
							success: function(data) {
								if(data === 'true') {
									swal("Nível de acesso alterado! A senha é 12345, acesse o perfil para alterar.", {
										buttons: {
											defeat: {
												text: "Ok",
												value: "ok",
											},
										},
									})
									.then((value) => {
										switch (value) {
											case "ok":
											location.reload();
											break;

											default:
											location.reload();
										}
									});
								}
							},
							type: 'POST'
						});
						break;

						default:
						swal("Cancelado!");
					}
				});
			});

			$('#update_tipouser_user').click(function(e) {
				e.preventDefault();
				var id_usuario = '<?php echo $id; ?>'
				swal("Deseja Remover Acesso de Administrador deste usuário?", {
					buttons: {
						cancel: "Cancelar",
						defeat: {
							text: "Ok",
							value: "ok",
						},
					},
				})
				.then((value) => {
					switch (value) {

						case "ok":
						$.ajax({
							url: 'engine/controllers/tb_usuario.php',
							data: {
								id_usuario : id_usuario,
								tipo_usuario: 1,
								senha_usuario : '',

								action: 'updateAcesso'
							},
							success: function(data) {
								if(data === 'true') {
									swal("Nível de acesso alterado!", {
										buttons: {
											defeat: {
												text: "Ok",
												value: "ok",
											},
										},
									})
									.then((value) => {
										switch (value) {
											case "ok":
											location.reload();
											break;

											default:
											location.reload();
										}
									});
								}
							},
							type: 'POST'
						});
						break;

						default:
						swal("Cancelado!");
					}
				});
			});
		});
	</script>

</body>
</html>
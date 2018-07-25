<?php
$showerros = true;
if($showerros) {
	ini_set("display_errors", $showerros);
	error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
}

session_start();
// Inicia a sessão

if(empty($_SESSION)){ ?>
	<script>
		document.location.href = '../' ;
	</script>
	<?php
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vacicare</title>

	<link rel = "shortcut icon" type = "imagem/x-icon" href = "../img/favicon.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/foundation.min.css" rel="stylesheet">
	<link href="../css/home.css" rel="stylesheet">
	<link href="../css/animate.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

	<div id="home">
		<div id="menu">
			<a href="index.php"><img src="../img/logo.png" id="logo"></a>
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
		</div>

		<ul class="menu align-center">
			<li><a href="vacinas.php"> <i class="fa fa-prescription-bottle-alt"></i> Vacinas</a></li>
			<li data-open="cadastrar_user"><a><i class="fa fa-address-card"></i> Cadastrar Usuário</a></li>
		</ul>

		<div class="grid-x">

			<div class="cell small-1"></div>
			<div class="cell medium-12 small-10">
				<h4 class="text-center"> Busque um usário pelo CPF </h4>
			</div> 

			<div class="cell small-12"></div>

			<div class="cell medium-4 small-1"></div>
			<div class="cell medium-4 small-10">
				<div class="input-group box_search">
					<span class="input-group-label"><i class="fa fa-user"></i></span>
					<input class="input-group-field" type="text" id="cpf_search" placeholder="CPF">
					<div class="input-group-button">
						<button class="button" id="serch_paciente"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</div>
			<div class="cell medium-4 small-1"></div>
		</div>

		<div id="footer">
			Desenvolvido por Durães, Lipin e Pedro
		</div>
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

	<!-- modal cadastrar user -->
	<div class="reveal animated bounceInDown" id="cadastrar_user" data-reveal data-overlay="false">
		<h4 class="text-center">Cadastrar Usuário</h4>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-user"></i></span>
			<input class="input-group-field" type="text" id="nome_usuario" placeholder="Nome do Usuário">
		</div>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-flag"></i></span>
			<select class="input-group-field" id="sexo_usuario" style="font-size: 1.2em; color: #777; padding: 0.5em;">
				<option value="" selected disabled>Gênero</option>
				<option value="0">Masculino</option>
				<option value="1">Feminino</option>
				<option value="2">Outro</option>
			</select>
		</div>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-address-card"></i></span>
			<input class="input-group-field" type="text" id="cpf_cadastro" placeholder="CPF do Usuário">
		</div>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-calendar"></i></span>
			<input class="input-group-field" type="text" id="data_nasc" placeholder="Data de Nascimento">
		</div>

		<div class="input-group">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-users"></i></span>
			<select class="input-group-field" id="tipo_user" style="font-size: 1.2em; color: #777; padding: 0.5em;">
				<option value="husker" selected disabled>Tipo de Usuário</option>
				<option value="0">Admin</option>
				<option value="1">User</option>
			</select>
		</div>

		<div class="input-group hide" id="senha_cadastro_admin">
			<span class="input-group-label" style="width: 2.5em"><i class="fa fa-key"></i></span>
			<input class="input-group-field" type="text" id="senha_cadastro" placeholder="Senha do Usuário">
		</div>

		<p style="text-align: center;"><button type="button" class="success button" style="background: #2980b9; color: #fff; font-weight: 600;" id="add_user">Cadastrar <i class="fa fa-check"></i> </button></p>
		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<script src="../js/jquery.js"></script>
	<script src="../js/foundation.js"></script>
	<script src="../js/vanilla_mask.js"></script>
	<script>
		$(document).foundation();

		VMasker(document.querySelector("#cpf_search")).maskPattern("999.999.999-99");
		VMasker(document.querySelector("#cpf_cadastro")).maskPattern("999.999.999-99");
		VMasker(document.querySelector("#data_nasc")).maskPattern("99/99/9999");
		VMasker(document.querySelector("#data_nasc_edita")).maskPattern("99/99/9999");

		$(document).ready(function(e) {
			$('.getout').click(function(e) {
				e.preventDefault();
				$.ajax({
					url: '../engine/controllers/logout.php',
					data: {

					},
					error: function() {
						alert('Erro na conexão com o servidor. Tente novamente em alguns segundos.');
					},
					success: function(data) {
						console.log(data);
						if(data === 'kickme'){
							document.location.href = '../';
						}

						else{
							alert('Erro ao conectar com banco de dados. Aguarde e tente novamente em alguns instantes.');
						}
					},

					type: 'POST'
				});
			});

			$('#cpf_search').keypress(function (e) {
				var key = e.which;
				if(key == 13){
					$('#serch_paciente').click();
					return false;
				}
			});

			$('#serch_paciente').click(function(e) {
				e.preventDefault();
				var cpf = $('#cpf_search').val();
				if(cpf == ""){
					swal({title: "Oops!", text: "Preencha o campo de CPF!", icon: "warning", button: "OK",})
				}else{
					window.location = "../pesquisa.php?cpf="+cpf;
				}
			});

			$('#senha_nova').keypress(function (e) {
				var key = e.which;
				if(key == 13){
					$('#muda_senha').click();
					return false;
				}
			});

			$('#muda_senha').click(function(e) {
				e.preventDefault();
				
				var senha_atual = $('#senha_atual').val();
				var senha_nova = $('#senha_nova').val();

				if(senha_atual == "" || senha_nova == ""){
					swal({title: "Oops!", text: "Preencha todos os campos!", icon: "warning", button: "OK",})
				}else{
					$.ajax({
						url: '../engine/controllers/tb_usuario.php',
						data: {
							id_usuario : <?php echo $_SESSION['id_usuario'] ?>,
							senha_usuario : senha_atual,

							action: 'cripto'
						},
						async: false,
						success: function(data) {
							if(data === 'true'){
								$.ajax({
									url: '../engine/controllers/tb_usuario.php',
									data: {
										id_usuario : <?php echo $_SESSION['id_usuario'] ?>,
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

			$("#tipo_user").change(function() {
				var tipo_user = $('#tipo_user').val();

				if(tipo_user == 0){
					$("#senha_cadastro_admin").removeClass("hide");
				}else{
					$("#senha_cadastro_admin").addClass("hide");
				}
			});

			$('#add_user').click(function(e) {
				e.preventDefault();
				
				var nome_usuario = $('#nome_usuario').val();
				var sexo_usuario = $('#sexo_usuario').val();
				var cpf_cadastro = $('#cpf_cadastro').val();
				var data_nasc = $('#data_nasc').val();
				var tipo_user = $('#tipo_user').val();
				var senha_cadastro = $('#senha_cadastro').val();

				var parts = data_nasc.split('/');
		        var ano = parts[2];
		        var mes = parts[1];
		        var dia = parts[0];

          		data_nasc = ([ano, mes, dia].join('-'));

				if(nome_usuario == "" || sexo_usuario == "" || cpf_cadastro == "" || data_nasc == "--" || tipo_user == ""){
					swal({title: "Ops!", text: "Preencha todos os dados!", icon: "error", button: "OK",})
				}else{
					$.ajax({
						url: '../engine/controllers/tb_usuario.php',
						data: {
							nome_usuario : nome_usuario,
							sexo_usuario : sexo_usuario,
							cpf_usuario : cpf_cadastro,
							data_nasc : data_nasc,
							tipo_usuario: tipo_user,
							senha_usuario: senha_cadastro,

							action: 'create'
						},
						async: false,
						success: function(data) {
							obj = JSON.parse(data);
							if (obj.res == 'true') {
								swal({title: "Oba!", text: "Usuário Cadastrado!", icon: "success",
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
										window.location = "../pesquisa.php?cpf="+cpf_cadastro;
										break;

										default:
										window.location = "../pesquisa.php?cpf="+cpf_usuario;
									}
								});
							}
						},
						type: 'POST'
					});
				}
			});

			$('#senha_cadastro').keypress(function (e) {
				var key = e.which;
				if(key == 13){
					$('#add_user').click();
					return false;
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
						url: '../engine/controllers/tb_usuario.php',
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
		});
	</script>

</body>
</html>
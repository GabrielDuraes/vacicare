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

		<div class="grid-x">

			<div class="cell small-1"></div>
			<div class="cell medium-12 small-10">
				<h4 class="text-center"> Pesquise seu cartão de vacina pelo CPF </h4>
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

	<div class="reveal animated bounceInDown" id="modal_login" data-reveal data-overlay="false">
		<img src="img/logo1.png" style="width: 200px; display: block; margin-left: auto; margin-right: auto;">
		<br>
		<div class="input-group">
			<span class="input-group-label"><i class="fa fa-user"></i></span>
			<input class="input-group-field" id="cpf_login" type="text" placeholder="CPF">
		</div>

		<div class="input-group">
			<span class="input-group-label"><i class="fa fa-lock"></i></span>
			<input class="input-group-field" type="password" id="password" placeholder="Senha">
		</div>

		<p style="text-align: center;"><button type="button" class="success button" style="background: #2980b9; color: #fff; font-weight: 600;" id="logar">Entrar <i class="fa fa-play"></i> </button></p>
		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/foundation.js"></script>
	<script src="js/vanilla_mask.js"></script>
	<script>
		$(document).foundation();

		VMasker(document.querySelector("#cpf_search")).maskPattern("999.999.999-99");
		VMasker(document.querySelector("#cpf_login")).maskPattern("999.999.999-99");

		$(document).ready(function(e) {

			$('#password').keypress(function (e) {
				var key = e.which;
				if(key == 13){
					$('#logar').click();
					return false;
				}
			});


			$('#logar').click(function(e) {
				e.preventDefault();
				var cpf = $('#cpf_login').val();
				var senha = $('#password').val();

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
								document.location.href = 'admin';
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
					window.location = "pesquisa.php?cpf="+cpf;
				}
			});
		});
	</script>

</body>
</html>
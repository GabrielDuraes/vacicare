<?php
error_reporting(error_reporting() & ~E_NOTICE);

	//pegando configurações locais (pt-br)
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

require_once "bd/bd.php";
require_once "classes/tb_usuario.php";
require_once "classes/tb_vacina.php";
require_once "classes/tb_registro.php";
?>
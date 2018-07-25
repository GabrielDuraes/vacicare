<?php
	class Tb_usuario{
		private $id_usuario;
		private $nome_usuario;
		private $sexo_usuario;
		private $cpf_usuario;
		private $data_nasc;
		private $tipo_usuario;
		private $senha_usuario;

		//setters
		public function SetValues($id_usuario, $nome_usuario, $sexo_usuario, $cpf_usuario, $data_nasc, $tipo_usuario, $senha_usuario){
			$this->id_usuario = $id_usuario;
			$this->nome_usuario = $nome_usuario;
			$this->sexo_usuario = $sexo_usuario;
			$this->cpf_usuario = $cpf_usuario;
			$this->data_nasc = $data_nasc;
			$this->tipo_usuario = $tipo_usuario;
			$this->senha_usuario = $senha_usuario;
		}

		public function Create(){
			$sql = "
				INSERT INTO tb_usuario
					(
						id_usuario,
						nome_usuario,
						sexo_usuario,
						cpf_usuario,
						data_nasc,
						tipo_usuario,
						senha_usuario,
						created_at
					)
				VALUES
					(
						'$this->id_usuario',
						'$this->nome_usuario',
						'$this->sexo_usuario',
						'$this->cpf_usuario',
						'$this->data_nasc',
						'$this->tipo_usuario',
						'$this->senha_usuario',
						now()
					);
				";

			$DB = new DB();
			$DB->open();
			// $result = $DB->query($sql);
			// $DB->close();
			// return $result;
			$result['result'] = $DB->query($sql);
			$result['lastId'] = $DB->lastId();
			$DB->close();
			return json_encode($result);
		}

		//Funcao que retorna uma Instancia especifica da classe no bd
		public function Read($id){
			$sql = "
				SELECT *
				FROM
					tb_usuario AS t1
				WHERE
					t1.id_usuario = '$id'
				";

			$DB = new DB();
			$DB->open();
			$Data = $DB->fetchData($sql);
			$DB->close();
			return $Data[0];
		}

		public function ReadByCpf($cpf){
			$sql = "
				SELECT * FROM tb_usuario WHERE cpf_usuario = '$cpf' ";

			$DB = new DB();
			$DB->open();
			$Data = $DB->fetchData($sql);
			$DB->close();
			return $Data[0];
		}

		public function ReadAll(){
			$sql = "
				SELECT *
				FROM
					tb_usuario
				";

			$DB = new DB();
			$DB->open();
			$Data = $DB->fetchData($sql);
			$realData;
			if($Data ==NULL){
				$realData = $Data;
			}
			else{
				foreach($Data as $itemData){
					if(is_bool($itemData)) continue;
					else{
						$realData[] = $itemData;
					}
				}
			}
			$DB->close();
			return $realData;
		}

		public function Update(){
			$sql = "
				UPDATE tb_usuario SET

					nome_usuario = '$this->nome_usuario',
					sexo_usuario = '$this->sexo_usuario',
					cpf_usuario = '$this->cpf_usuario',
					data_nasc = '$this->data_nasc',
					updated_at = now()

				WHERE id_usuario = '$this->id_usuario'
				";

			$DB = new DB();
			$DB->open();
			$result =$DB->query($sql);
			$DB->close();
			return $result;
		}

		public function UpdateSenha(){
			$sql = "
				UPDATE tb_usuario SET

					senha_usuario = '$this->senha_usuario',
					updated_at = now()

				WHERE id_usuario = '$this->id_usuario'
				";

			$DB = new DB();
			$DB->open();
			$result =$DB->query($sql);
			$DB->close();
			return $result;
		}

		public function updateAcesso(){
			$sql = "
				UPDATE tb_usuario SET

					senha_usuario = '$this->senha_usuario',
					tipo_usuario = '$this->tipo_usuario',
					updated_at = now()

				WHERE id_usuario = '$this->id_usuario'
				";

			$DB = new DB();
			$DB->open();
			$result =$DB->query($sql);
			$DB->close();
			return $result;
		}
		
		public function Delete(){
			$sql = "
				DELETE FROM tb_usuario	WHERE id_usuario = '$this->id_usuario'
				";

			$DB = new DB();
			$DB->open();
			$result =$DB->query($sql);
			$DB->close();
			return $result;
		}


		function __construct(){
			$this->id_usuario;
			$this->nome_usuario;
			$this->sexo_usuario;
			$this->cpf_usuario;
			$this->data_nasc;
			$this->tipo_usuario;
			$this->senha_usuario;
		}

		function __destruct(){
			$this->id_usuario;
			$this->nome_usuario;
			$this->sexo_usuario;
			$this->cpf_usuario;
			$this->data_nasc;
			$this->tipo_usuario;
			$this->senha_usuario;			
		}
	};
?>
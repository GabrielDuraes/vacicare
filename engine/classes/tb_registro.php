<?php
	class Tb_registro{
		private $id_registro;
		private $fk_usuario;
		private $fk_vacina;
		private $data_vacinacao;
		private $fk_aplicador;

		//setters
		public function SetValues($id_registro, $fk_usuario, $fk_vacina, $data_vacinacao, $fk_aplicador){
			$this->id_registro = $id_registro;
			$this->fk_usuario = $fk_usuario;
			$this->fk_vacina = $fk_vacina;
			$this->data_vacinacao = $data_vacinacao;
			$this->fk_aplicador = $fk_aplicador;;
		}

		public function Create(){
			$sql = "
				INSERT INTO tb_registro
					(
						id_registro,
						fk_usuario,
						fk_vacina,
						data_vacinacao,
						fk_aplicador,
						created_at
					)
				VALUES
					(
						'$this->id_registro',
						'$this->fk_usuario',
						'$this->fk_vacina',
						now(),
						'$this->fk_aplicador',
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
					tb_registro AS t1
				WHERE
					t1.id_vacina = '$id'
				";

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
					tb_registro
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

		public function Readfk_user($id){
			$sql = "
				SELECT *
				FROM
					tb_registro as t1
				WHERE  t1.fk_usuario = '$id'
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
				UPDATE tb_registro SET

					fk_usuario = '$this->fk_usuario',
					imunizacao = '$this->imunizacao',
					data_vacinacao = '$this->data_vacinacao',
					fk_aplicador = '$this->fk_aplicador',
					updated_at = now()

				WHERE id_registro = '$this->id_registro'
				";

			$DB = new DB();
			$DB->open();
			$result =$DB->query($sql);
			$DB->close();
			return $result;
		}

		public function Delete(){
			$sql = "
				DELETE FROM tb_registro
				WHERE id_registro = '$this->id_registro'
			";

			$DB = new DB();
			$DB->open();
			$result =$DB->query($sql);
			$DB->close();
			return $result;
		}

		function __construct(){
			$this->id_registro;
			$this->fk_usuario;
			$this->imunizacao;
			$this->data_vacinacao;
			$this->fk_aplicador;
		}

		function __destruct(){
			$this->id_registro;
			$this->fk_usuario;
			$this->imunizacao;
			$this->data_vacinacao;
			$this->fk_aplicador;			
		}
	};
?>
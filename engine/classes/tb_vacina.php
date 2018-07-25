<?php
	class Tb_vacina{
		private $id_vacina;
		private $nome_vacina;
		private $imunizacao;
		private $duracao_vacina;
		private $obs_vacina;

		//setters
		public function SetValues($id_vacina, $nome_vacina, $imunizacao, $duracao_vacina, $obs_vacina){
			$this->id_vacina = $id_vacina;
			$this->nome_vacina = $nome_vacina;
			$this->imunizacao = $imunizacao;
			$this->duracao_vacina = $duracao_vacina;
			$this->obs_vacina = $obs_vacina;;
		}

		public function Create(){
			$sql = "
				INSERT INTO tb_vacina
					(
						id_vacina,
						nome_vacina,
						imunizacao,
						duracao_vacina,
						obs_vacina,
						created_at
					)
				VALUES
					(
						'$this->id_vacina',
						'$this->nome_vacina',
						'$this->imunizacao',
						'$this->duracao_vacina',
						'$this->obs_vacina',
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
					tb_vacina AS t1
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
					tb_vacina
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

		public function Delete(){
			$sql = "
				DELETE FROM tb_vacina
				WHERE id_vacina = '$this->id_vacina'
			";

			$DB = new DB();
			$DB->open();
			$result =$DB->query($sql);
			$DB->close();
			return $result;
		}

		function __construct(){
			$this->id_vacina;
			$this->nome_vacina;
			$this->imunizacao;
			$this->duracao_vacina;
			$this->obs_vacina;
		}

		function __destruct(){
			$this->id_vacina;
			$this->nome_vacina;
			$this->imunizacao;
			$this->duracao_vacina;
			$this->obs_vacina;			
		}
	};
?>
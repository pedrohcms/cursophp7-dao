<?php 

	class Usuario{

		//Atributos
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		//Métodos getters e setters
		public function getIdusuario(){
			return $this->idusuario;
		}

		public function setIdusuario($value){
			$this->idusuario = $value;
		}

		public function getDeslogin(){
			return $this->deslogin;
		}

		public function setDeslogin($value){
			$this->deslogin = $value;
		}

		public function getDessenha(){
			return $this->dessenha;
		}

		public function setDessenha($value){
			$this->dessenha = $value;
		}

		public function getDtcadastro(){
			return $this->dtcadastro;
		}

		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}

		//Método que traz as informações do banco.
		public function loadById($id){
 
		$sql = new Sql();//Uma instância da classe Sql, se conecta com o banco quando é gerada.
 
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID" => $id
		));
 
		if(count($result) > 0) {
			$row = $result[0];
			//Trazemos os valores do banco e colocamos eles nos atributos da instância.
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
 
			}
 
		}
		/*
		O método mágico __toString() transforma os dados recebidos do banco em um array com JSON e, 
		com isso podemos ver as informações de forma mais clara.
		*/
		public function __toString(){

			return json_encode(array(
				"idusuario" => $this->getIdusuario(),
				"deslogin" => $this->getDeslogin(),
				"dessenha" => $this->getDessenha(),
				"dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
			));

		}
		
	}
 ?>
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
			
			$this->setData($result[0]);
 
			}
 
		}
		/*
		O método mágico __toString() transforma os dados recebidos do banco em um array com JSON e, 
		com isso podemos ver as informações de forma mais clara.
		*/

		public static function getList() {
            
            $sql = new Sql();
            
            return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
            
        }

        public static function search($login){

        	$sql = new Sql();

        	return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
        		':SEARCH' => "%".$login."%"
        	));

        }

        public function login($login, $senha){

 			$sql = new Sql();//Uma instância da classe Sql, se conecta com o banco quando é gerada.
 
			$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
				":LOGIN" => $login,
				":SENHA" => $senha
			));
 
		if(count($result) > 0) {
			
			//Trazemos os valores do banco e colocamos eles nos atributos da instância.
			$this->setData($results[0]);
 
		}
		else{

			throw new Exception("Login e/ou senha inválidos", 1);
			
			}

        }

        public function setData($data){

 			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));       	

        }

        public function insert(){

        	$sql = new Sql();

        	$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
        		":LOGIN" => $this->getDeslogin(),
        		":SENHA" => $this->getDessenha()
        	));

        	if(count($result) > 0){

        		$this->setData($result[0]);

        	}

        }

        public function update($login, $senha){

        	$this->setDeslogin($login);
        	$this->setDessenha($senha);

        	$sql = new Sql();

        	$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID", array(
        		":LOGIN" => $this->getDeslogin(),
        		":SENHA" => $this->getDessenha(),
        		":ID" => $this->getIdusuario()
        	));

        }

        public function __construct($login = "", $senha = ""){

        	$this->setDeslogin($login);
        	$this->setDessenha($senha);

        }
		
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
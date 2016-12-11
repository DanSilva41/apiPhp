<?php
//Conexao BD
class Conexao{

	private $user;
	private $senha;
	private $host;
	private $db_name;
	private $dsn;
	public $conexao;

	public function getConexao(){ 
		try{
			$this->user = 'root';
			$this->senha = '123456';
			$this->host = '127.0.0.1:3306';
			$this->db_name = 'api_telegram';
			$this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

			$this->conexao = new PDO($this->dsn, $this->user, $this->senha);
			$this->conexao->exec("set name utf8");
			
			return $this->conexao;
		} catch (PDOException $e) {
			echo 'ERRO!!!' . $e->getMessage();
			exit();
		}
	}
}

?>
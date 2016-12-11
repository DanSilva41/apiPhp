<?php

require 'conexao.php';

class DAOFiltro{

	private $conexao;
	private $pdo;

	function __construct() {
		$this->pdo = new conexao();
		$this->conexao = $this->pdo->getConexao();
	}

	public function inserir($updateId,$comando,$resposta){
		print_r($updateId);
		$query = "INSERT INTO filtro (updateId, comando, resposta)
		            VALUES(?, ?, ?)";
		try{
			$stmt = self::$this->conexao->getConexao()->prepare($query);
			$stmt->bindParam(1, $updateId);
			$stmt->bindParam(2, $comando);
			$stmt->bindParam(3, $resposta);

			$stmt->execute();
		} catch (PDOException $excep) {
			echo 'FALHA: ' .$excep->getMessage();
		}

	}
}
?>
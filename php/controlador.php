<?php
require_once 'modelo.php';

class Controlador{
	private $modelo;
	public function __construct(){
		$this->modelo = new Modelo();
	}
	
	public function cadastrar($nome, $email, $matricula, $senha, $tipo){
		if(!is_numeric($tipo)){
			return false;
		}
		if($this->modelo->cadastrar($nome, $email, $matricula, $senha, $tipo)){
			return true;
		}
		return false;
	}
	
	public function login($matricula, $senha){
		$usuario = $this->modelo->login($matricula, $senha);
		return $usuario;
	}

}
?>

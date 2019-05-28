<?php
require_once 'db-config.php';

class Modelo{
	private $servername;
	private $usuario;
	private $password;
	private $database;
	private $con;

	public function __construct(){
		global $servername;
		global $usuario;
		global $password;
		global $database;
		$this->servername = $servername;
		$this->usuario = $usuario;
		$this->password = $password;
		$this->database = $database;
	}

	public function conectar(){
		$this->con = new mysqli(
			$this->servername,
			$this->usuario,
			$this->password,
			$this->database);
		if($this->con->connect_error){
			die("Falha ao conectar: " . mysqli_connect_error());
			return false;
		}
		if(mysqli_set_charset($this->con, "utf8")){
			return true;
		}
	}
	
	public function cadastrar($nome, $email, $matricula, $senha, $tipo){
		if($this->conectar()){
			$sql = "SELECT idUsuario FROM usuario WHERE email = '$email'";
			if($rs = mysqli_query($this->con, $sql)){
				if(mysqli_num_rows($rs) > 0){
					return false;
				}
			}
			$sql = "INSERT INTO usuario(nome, tipo, email, matricula, senha) VALUES
					('$nome', $tipo, '$email', '$matricula', md5('$senha'))";
			if(mysqli_query($this->con, $sql)){
				if(mysqli_affected_rows($this->con) == 1){
					return true;
				}
			}
		}
		return false;
	}
	
	public function login($matricula, $senha){
		if($this->conectar()){
			$sql = "SELECT nome, tipo, idUsuario AS id FROM usuario WHERE matricula = '$matricula' AND senha = md5('$senha')";
			if($rs = mysqli_query($this->con, $sql)){
				if(mysqli_num_rows($rs) == 1){
					return mysqli_fetch_assoc($rs);
				}
			}
		}
		return false;
		
	}

}
?>
<?php
session_start();

class Login { 
	private $name = 'vestibular'; 
	private $password = 'fatec'; 
	 
	public function verificar_credenciais( $name, $password ) { 
        if ( $name == $this->name ) {
            if ( $password == $this->password ) {
                $_SESSION["logged_in"] = TRUE;
                return TRUE;
            }
        }
        return FALSE;
	} 

    public function verificar_logado() { 
        if ( $_SESSION["logged_in"]) {
            return TRUE;
        }
        $this->logout();
	} 

    public function logout() { 
        session_destroy();
        header("Location: index.php");
        exit();
	} 
} 

?>

<?php

class Cadastro {
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $dbname = "vestibular";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        
        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->fecharConexao();
    }

    public function inserirUsuario($nome, $curso) {
        $sql = "INSERT INTO candidatos (nome, curso) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            echo "Erro na preparação da consulta: " . $this->conn->error;
            return false;
        }
        $stmt->bind_param("ss", $nome, $curso);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Erro ao executar a consulta: " . $stmt->error;
            return false;
        }
    }

    
    public function fecharConexao() {
        $this->conn->close();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];

    
    $cadastroUsuario = new Cadastro();

    
    if ($cadastroUsuario->inserirUsuario($nome, $curso)) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar!";
    }

    
}

?>
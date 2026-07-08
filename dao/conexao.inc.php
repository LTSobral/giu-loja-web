<!-- Lucas Torres Sobral 2020204062 -->

<?php

class Conexao
{
      private $servidor_mysql;
      private $nome_banco;
      private $usuario;
      private $senha; 
      private $con;

      public function __construct()
      {
            $this->servidor_mysql = getenv('DB_HOST') ?: 'localhost';
            $this->nome_banco = getenv('DB_NAME') ?: 'lojaweb';
            $this->usuario = getenv('DB_USER') ?: 'root';
            $this->senha = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
      }

      public function getConexao()
      {
            $this->con = new PDO("mysql:host=$this->servidor_mysql;dbname=$this->nome_banco", $this->usuario, $this->senha);
            return $this->con;
      }
}

?>


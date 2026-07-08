<?php
require_once 'conexao.inc.php';

class ClienteDao{
    private $con;

    function __construct(){
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    public function autenticar($email, $senha){
        $sql = $this->con->prepare("SELECT * FROM clientes WHERE email = :email AND senha = :senha");
        $email = strtolower($email);
        $senha = strtolower($senha);

        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        $count = $sql->rowCount();
        $cliente = null;

        if($count == 1){ //achou o cliente
            $cliente = $sql->fetch(PDO::FETCH_OBJ);
        }

        return $cliente;
    }
}
?>
<?php
require_once 'conexao.inc.php';

class FabricanteDao{
    private $con;

    function __construct(){
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    function getFabricantes(){
        $rs = $this->con->query("select * from fabricantes");
        $lista = array();
        
        while($registro = $rs->fetch(PDO::FETCH_OBJ)){
            $lista[] = $registro;
        }

        return $lista;
    }
}
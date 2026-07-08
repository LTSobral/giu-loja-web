<?php
require_once 'conexao.inc.php';
require_once '../classes/item.inc.php';
require_once '../classes/venda.inc.php';
require_once '../utils/funcoesUteis.php';


class VendaDao{
    private $con;

    function __construct(){
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    public function incluirVenda($venda, $carrinho){
        $sql = $this->con->prepare("
            insert into vendas(cpf_cliente, dataVenda, valorTotal)
            values (:cpf, :data, :val)
        ");

        $sql->bindValue(":cpf", $venda->getCpf());
        $sql->bindValue(":data", converterDataMysql($venda->getData()));
        $sql->bindValue(":val", $venda->getValorTotal());

        $sql->execute();
        $id = $this->getIdvenda();
        $this->incluirItens($id, $carrinho);
   }

   private function incluirItens($idVenda, $carrinho){
    foreach($carrinho as $item){
        $sql = $this->con->prepare("
            insert into itens(id_produto, quantidade, valorTotal, id_venda)
            values (:idPub, :q, :val, :idV)
        ");
    
        $sql->bindValue(":idPub", $item->getProduto()->getProdutoId());
        $sql->bindValue(":q", $item->getQuantidade());
        $sql->bindValue(":val", $item->getValorItem());
        $sql->bindValue(":idV", $idVenda);

        $sql->execute();
    }
   }

   private function getIdVenda(){
    $sql = $this->con->query("select MAX(id_venda) as maior from vendas");
    $row = $sql->fetch(PDO::FETCH_OBJ);
    return $row->maior;
   }
}
?>
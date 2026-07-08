<!-- Lucas Torres Sobral 2020204062 -->

<?php
require_once '../utils/funcoesUteis.php';
require_once 'conexao.inc.php';
require_once '../classes/produto.inc.php';


class ProdutoDao{
    private $con;

    function __construct(){
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    public function inserirProduto(Produto $produto){
        $sql = $this->con->prepare(
            "insert into produtos(
                nome,
                descricao,
                data_fabricacao,
                resumo,
                preco,
                estoque,
                referencia,
                cod_fabricante
            ) values (
                :nom,
                :desc,
                :data,
                :res,
                :preco,
                :est,
                :ref,
                :fab
            )"
        );

        $sql->bindValue(":nom", $produto->getNome());
        $sql->bindValue(":desc", $produto->getDescricao());
        $sql->bindValue(":data", converterDataMysql($produto->getDataFabricacao()));
        $sql->bindValue(":res", $produto->getResumo());
        $sql->bindValue(":preco", $produto->getPreco());
        $sql->bindValue(":est", $produto->getEstoque());
        $sql->bindValue(":ref", $produto->getReferencia());
        $sql->bindValue(":fab", $produto->getCodFabricante());

        $sql->execute();
    }

    //TESTAR UTILIZANDO SOMENTE O CONSTRUTOR COM PARAMETROS
    //TESTAR UTILIZANDO PDO:FETCH_ALL
    public function getProdutos(){
        $rs = $this->con->query("select * from produtos");

        $lista = array();
        while($registro = $rs->fetch(PDO::FETCH_OBJ)){
            $produto = new Produto();
            $produto->setProdutoId($registro->produto_id);
            $produto->setNome($registro->nome);
            $produto->setDataFabricacao($registro->data_fabricacao);
            $produto->setPreco($registro->preco);
            $produto->setEstoque($registro->estoque);
            $produto->setDescricao($registro->descricao);
            $produto->setResumo($registro->resumo);
            $produto->setReferencia($registro->referencia);
            $produto->setCodFabricante($this->getNomeFabricante($registro->cod_fabricante));
            
            $lista[] = $produto;
        }

        return $lista;
    }
    //

    public function excluirProduto($id){
        $sql = $this->con->prepare("delete from produtos where produto_id = :id");
        $sql->bindValue(":id", $id);
        
        $sql->execute();
    }

    public function getProduto($id){
        $rs = $this->con->prepare("select * from produtos where produto_id = :id");
        $rs->bindValue(":id", $id);
        $rs->execute();

        $registro = $rs->fetch(PDO::FETCH_OBJ);
        
        $produto = new Produto();
        $produto->setProdutoId($registro->produto_id);
        $produto->setNome($registro->nome);
        $produto->setDataFabricacao($registro->data_fabricacao);
        $produto->setPreco($registro->preco);
        $produto->setEstoque($registro->estoque);
        $produto->setDescricao($registro->descricao);
        $produto->setResumo($registro->resumo);
        $produto->setReferencia($registro->referencia);
        $produto->setCodFabricante($this->getNomeFabricante($registro->cod_fabricante));

        return $produto;
    }

    public function alterarProduto(Produto $produto){
        $sql = $this->con->prepare(
            "
            update produtos
            set nome = :nom,
            descricao = :desc,
            data_fabricacao = :data,
            resumo = :res,
            preco = :preco,
            estoque = :est,
            referencia = :ref,
            cod_fabricante = :fab
            where produto_id = :id
            "
        );

        $sql->bindValue(":nom", $produto->getNome());
        $sql->bindValue(":desc", $produto->getDescricao());
        $sql->bindValue(":data", converterDataMysql($produto->getDataFabricacao()));
        $sql->bindValue(":res", $produto->getResumo());
        $sql->bindValue(":preco", $produto->getPreco());
        $sql->bindValue(":est", $produto->getEstoque());
        $sql->bindValue(":ref", $produto->getReferencia());
        $sql->bindValue(":fab", $produto->getCodFabricante());
        $sql->bindValue(":id", $produto->getProdutoId());

        $sql->execute();
    }

    public function getNomeFabricante($codFabricante){
        $sql = $this->con->prepare("select nome from fabricantes where codigo = :cod");
        $sql->bindValue(":cod", $codFabricante);
        $sql->execute();

        $fab = $sql->fetch(PDO::FETCH_OBJ);
        return $fab->nome;
    }

    public function alterarRemoverEstoque($produto_id, $quantidade){
        $sql = $this->con->prepare(
            "
            update produtos
            set estoque = estoque - :quantidade
            where produto_id = :produto_id
            "
        );

        $sql->bindValue(":quantidade", $quantidade);
        $sql->bindValue(":produto_id", $produto_id);
        $sql->execute();
    }
}
?>
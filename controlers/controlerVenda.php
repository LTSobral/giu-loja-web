<!-- Lucas Torres Sobral 2020204062 -->

<?php
    require_once '../classes/venda.inc.php';
    require_once '../dao/vendaDao.inc.php';
    require_once '../dao/produtoDAO.inc.php';


    $opcao = $_REQUEST['opcao'];
    if($opcao == 1){
        session_start();
        
        $cliente = $_SESSION['cliente'];
        $carrinho = $_SESSION['carrinho'];
        $total = $_SESSION['total'];

        $venda = new Venda($cliente->cpf, $total);
        $vendaDao = new VendaDao();

        $vendaDao->incluirVenda($venda, $carrinho);

        $produtoDAO = new ProdutoDAO();

        foreach($carrinho as $item){ 
            $produtoDAO->alterarRemoverEstoque($item->getProduto()->getProdutoId(), $item->getQuantidade());
        }

        if($_REQUEST['pag'] == 'boleto'){
            header("Location: ../views/boleto/meuBoleto.php");
        } else{
            echo "Pagamento por cartão realizado!";
        }
        $_SESSION['carrinho'] = array();
    }
?>
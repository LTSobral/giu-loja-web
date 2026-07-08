<!-- Lucas Torres Sobral 2020204062 -->

<?php
    function array_search2($chave, $vetor){
        $index = -1;
        for($i=0; $i<count($vetor); $i++){
            if($chave == $vetor[$i]->getProduto()->getProdutoId()){
                $index = $i;
                break;
            }
        }
        return $index;
    }

    require_once '../dao/produtoDAO.inc.php';
    require_once '../classes/produto.inc.php';
    require_once '../classes/item.inc.php';
    $opcao = $_REQUEST['opcao'];
    $cupom = $_REQUEST['pCupom'];

    if($opcao==1){ //inserir no carrinho
        $id = $_REQUEST['id'];

        $produtoDao = new ProdutoDao();
        $produto = $produtoDao->getProduto($id);

        $item = new Item($produto);

        //montagem do carrinho
        session_start();

        if(!isset($_SESSION['carrinho'])){
            $carrinho = array();
        } else{
            $carrinho = $_SESSION['carrinho'];
        }

        $key = array_search2($item->getProduto()->getProdutoId(), $carrinho);
//================================================================================================
        if($key != -1){
            $novaQtd = $carrinho[$key]->getQuantidade() + 1;
            
            $carrinho[$key]->setQuantidade($novaQtd);
            
            $carrinho[$key]->setValorItem();
//================================================================================================
        } else{
            $carrinho[] = $item;
        }

        $_SESSION['carrinho'] = $carrinho;

        header('Location: ../views/exibirCarrinho.php');

    } elseif ($opcao == 2) { // Remover/Diminuir item
    $index = $_REQUEST['index'];
    
    session_start();
    $carrinho = $_SESSION['carrinho'];

        if (isset($carrinho[$index])) {
//================================================================================================
            $novaQtd = $carrinho[$index]->getQuantidade() - 1;
            $carrinho[$index]->setQuantidade($novaQtd);

            $carrinho[$index]->setValorItem();

            if ($carrinho[$index]->getQuantidade() <= 0) {
                unset($carrinho[$index]);
                $carrinho = array_values($carrinho);
            }

            $_SESSION['carrinho'] = $carrinho;
        }
//================================================================================================
    
    header('Location: controlerCarrinho.php?opcao=4');

    } elseif($opcao == 3){ //matar o carrinho
        session_start();
        unset($_SESSION['carrinho']);
        header('Location: controlerCarrinho.php?opcao=4');

    } elseif($opcao == 4){ //carrinho vazio
        session_start();
        if(!isset($_SESSION['carrinho']) || sizeof($_SESSION['carrinho']) == 0){
            header('Location: ../views/exibirCarrinho.php?status=1');
        } else{
            header('Location: ../views/exibirCarrinho.php');
        }
//================================================================================================
    } elseif($opcao == 5){
        session_start();

        $total = $_REQUEST['total'];
        $_SESSION['total'] = $total;
        $_SESSION['cupom'] = $cupom;

        if(isset($_SESSION['cliente'])){
            header('Location: ../views/dadosCompra.php');
        } else{
            header('Location: ../views/formLogin.php?redirecionar=carrinho');
        }
//================================================================================================
        
    }
?>
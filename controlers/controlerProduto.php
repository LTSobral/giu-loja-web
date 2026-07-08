<?php
    require_once '../dao/produtoDAO.inc.php';
    require_once '../classes/produto.inc.php';
    $opcao = $_REQUEST['opcao'];

    //TESTAR UTILIZANDO SOMENTE O CONSTRUTOR COM PARAMETROS
    if($opcao == 1){ //inserir
        $produto = new Produto();
        $produto->setProduto( 
            $_REQUEST['pNome'], 
            $_REQUEST['pDataFabricacao'],
            $_REQUEST['pPreco'],
            $_REQUEST['pEstoque'],
            $_REQUEST['pDescricao'],
            $_REQUEST['pResumo'],
            $_REQUEST['pReferencia'],
            $_REQUEST['pFabricante']
        );
        //

        $produtoDao = new ProdutoDao();
        $produtoDao->inserirProduto($produto);
        uploadFotos($_REQUEST['pReferencia']);

        //header("location: ../views/exibirProdutos.php");
        header("location: controlerProduto.php?opcao=2");

    } elseif($opcao == 2 || $opcao == 6){ //selecionar todos
        $produtoDao = new ProdutoDao();
        $lista = $produtoDao->getProdutos();

        session_start();
        $_SESSION['produtos'] = $lista;
        
        if($opcao == 2){
            header('location: ../views/exibirProdutos.php'); 
        } else{
            header('location: ../views/produtosVenda.php'); 
        }
        

    } elseif($opcao == 3){
        $id = (int)$_REQUEST['id'];

        $produtoDao = new ProdutoDao();

        deletarFoto($produtoDao->getProduto($id)->getReferencia());
        $produtoDao->excluirProduto($id);

        header("location: controlerProduto.php?opcao=2");
        
    } elseif($opcao == 4){ //buscar produto
        $id = $_REQUEST['id'];

        $produtoDao = new ProdutoDao();
        $produto = $produtoDao ->getProduto($id);
        
        session_start();
        $_SESSION['produto'] = $produto;
        
        header('location: controlerFabricante.php?opcao=3');
    } elseif ($opcao == 5){ //alterar
        $produto = new Produto();
        $produto->setProduto( 
            $_REQUEST['pNome'], 
            $_REQUEST['pDataFabricacao'],
            $_REQUEST['pPreco'],
            $_REQUEST['pEstoque'],
            $_REQUEST['pDescricao'],
            $_REQUEST['pResumo'],
            $_REQUEST['pReferencia'],
            $_REQUEST['pFabricante']
        );
        $produto->setProdutoId($_REQUEST['pId']);
        $produtoDao = new ProdutoDao();
        $produtoDao->alterarProduto($produto);
        header('Location: controlerProduto.php?opcao=2');
    }

function uploadFotos($ref){
    $imagem = $_FILES["imagem"];
    $nome = $ref;

    if($imagem != NULL) {
        $nome_temporario=$_FILES["imagem"]["tmp_name"];
        copy($nome_temporario,"../views/imagens/produtos/$nome.jpg");
    }
    else {
        echo "Você não realizou o upload de forma satisfatória.";
    }
}

function deletarFoto($ref){
    $arquivo = "../views/imagens/produtos/$ref.jpg";

    if(file_exists( $arquivo )){
        if (!unlink($arquivo)){
            echo "Não foi possível deletar o arquivo!";
        }
    }
}
?>
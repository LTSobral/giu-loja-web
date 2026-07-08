<?php
    require_once '../dao/fabricanteDAO.inc.php';
    $opcao = $_REQUEST['opcao'];

    if($opcao == 1){

    }
    elseif($opcao == 2 || $opcao == 3){ //selecionar todos
        $fabricanteDao = new FabricanteDao();
        $lista = $fabricanteDao->getFabricantes();

        session_start();
        $_SESSION['fabricantes'] = $lista;
        
        if($opcao == 2){
            header("location: ../views/formProduto.php");
        } else{
            header("location: ../views/formProdutoAtualizar.php");
        }
    }
?>
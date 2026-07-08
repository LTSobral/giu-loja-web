<?php
    require_once '../dao/clienteDAO.inc.php';
    $opcao = $_REQUEST['pOpcao'];
    $pOrigem = $_REQUEST['pOrigem'];

//================================================================================================
    if($opcao == 1 || $pOrigem == 'carrinho'){ //opcao de autenticar
        $email = $_REQUEST['pEmail'];
        $senha = $_REQUEST['pSenha'];

        $clienteDao = new ClienteDao();
        $cli = $clienteDao->autenticar($email, $senha);

        if($cli != null && $pOrigem != 'carrinho'){ //achei o cara
            session_start();
            $_SESSION['cliente'] = $cli;

            header("location: controlerProduto.php?opcao=6");

        } elseif($cli != null && $pOrigem == 'carrinho'){ //achei o cara e veio do carrinho
            session_start();
            $_SESSION['cliente'] = $cli;

            header("location: ../views/dadosCompra.php");

        } else{ //não achou
            header('Location: ../views/formLogin.php?erro=1');
        }
//================================================================================================

    }else{
        if($opcao == 2){ //logout
            session_start();
            unset($_SESSION['cliente']);
            header('Location: ../views/index.php');
            session_destroy();
        }
    }
?>
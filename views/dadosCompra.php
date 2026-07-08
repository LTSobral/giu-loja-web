<!-- Lucas Torres Sobral 2020204062 -->

<?php
require_once '../classes/item.inc.php';
require_once "includes/cabecalho.inc.php";
require_once "../dao/cupomDAO.inc.php";
$carrinho = $_SESSION['carrinho'];
$cliente = $_SESSION['cliente'];
$total = $_SESSION['total'];
$codigoCupom = $_SESSION['cupom'];
$cupomDAO = new CupomDAO();
$aplicado = 0;
$desconto = 0;

if ($cliente->fl_vip == 1) {
  $desconto = 30;
}

$cupom = $cupomDAO->getCupomValido($codigoCupom);
if ($cupom) {
  $desconto = $desconto + $cupom->getValorpercentualDesconto();
}

$total = $total * (1 - $desconto / 100);
if ($aplicado = 0) {
  $_SESSION['total'] = $total;
  $aplicado = 1;
}

?>

<h1 class="text-center">Dados do cliente</h1>

<p>&nbsp;
<div style="font-size: 1.25rem;">
  <p><b>Nome:</b> <?= $cliente->nome ?>
  <p><b>CPF:</b> <?= $cliente->cpf ?>
  <p><b>Endereço Completo:</b> <?= $cliente->logradouro ?>, <?= $cliente->cidade ?> - <?= $cliente->estado ?>. CEP:
    <?= $cliente->cep ?>
  <p><b>Telefone:</b> <?= $cliente->telefone ?>
  <p><b>Email:</b> <?= $cliente->email ?>
    </font>
  <p>
    <hr>
  <p>&nbsp;
</div>

<h1 class="text-center">Dados da compra</h1>
<p>

<div class="table-responsive">
  <table class="table">
    <thead class="table-success">
      <tr class="align-middle" style="text-align: center">
        <th witdh="10%">Item</th>
        <th>Referencia</th>
        <th>Nome</th>
        <th>Fabricante</th>
        <th>Preço</th>
        <th>Qde.</th>
        <th>Valor</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php
      foreach ($carrinho as $item) {
        ?>
        <tr class="align-middle" style="text-align: center">
          <td><img src="imagens/produtos/<?= $item->getProduto()->getReferencia() ?>.jpg" width="100" height="100"
              border="0"></td>
          <td>ID <?= $item->getProduto()->getProdutoId() ?></td>
          <td><?= $item->getProduto()->getNome() ?></td>
          <td>Fabricante <?= $item->getProduto()->getCodFabricante() ?></td>
          <td>R$<?= $item->getProduto()->getPreco() ?></td>
          <td><?= $item->getQuantidade() ?></td>
          <td>R$<?= $item->getValorItem() ?></td>
        </tr>
        <?php
      }
      ?>

      <?php
      if ($codigoCupom) {
        if ($cupom) {
          echo "<tr align='right'><td colspan='7'><font face='Verdana' size='4' color='red'><b>Cupom " . $cupom->getValorpercentualDesconto() . "% " . $cupom->getCodigo() . "</b></font></td></tr>";
        } else {
          echo "<tr align='right'><td colspan='7'><font face='Verdana' size='4' color='red'><b>Cupom " . $codigoCupom . " não é válido!</b></font></td></tr>";
        }
      }
      if ($cliente->fl_vip == 1) {
        echo "<tr align='right'><td colspan='7'><font face='Verdana' size='4' color='red'><b>Você possuí um desconto de 30% VIP</b></font></td></tr>";
      }
      ?>

      <tr align="right">
        <td colspan="7">
          <font face="Verdana" size="4" color="red"><b>Valor Total = R$ <?= $total ?></b></font>
        </td>
      </tr>
  </table>
  <div class="container text-center">
    <div class="row">
      <div class="col">
        <a class="btn btn-success" role="button" href="dadosPagamento.php"><b>Efetuar o
            pagamento</b></a>
      </div>
    </div>
  </div>

  <!-- Rodape -->

  <?php require_once "includes/rodape.inc.php" ?>
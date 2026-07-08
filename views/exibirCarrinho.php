<!-- Lucas Torres Sobral 2020204062 -->

<?php
require_once '../classes/item.inc.php';
require_once 'includes/cabecalho.inc.php';
?>

<h1 class="text-center">Carrinho de compra</h1>
<p>
  <?php
  if (isset($_REQUEST['status'])) {
    require_once 'includes/carrinhoVazio.inc.php';
  } else {
    $carrinho = $_SESSION['carrinho'];
    $cont = 1;
    $soma = 0;

    ?>
  <div class="table-responsive">
    <table class="table table-ligth table-striped">
      <thead class="table-danger">
        <tr class="align-middle" style="text-align: center">
          <th witdh="10%">Item No</th>
          <th>Ref.</th>
          <th>Nome</th>
          <th>Fabricante</th>
          <th>Preço</th>
          <th>Qde.</th>
          <th>Total</th>
          <th>Remover</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php
        foreach ($carrinho as $item) {
          ?>
          <tr class="align-middle" style="text-align: center">
            <td><?= $cont ?></td>
            <td><?= $item->getProduto()->getProdutoId() ?></td>
            <td><?= $item->getProduto()->getNome() ?></td>
            <td><?= $item->getProduto()->getCodFabricante() ?></td>
            <td>R$<?= $item->getProduto()->getPreco() ?></td>
            <td><?= $item->getQuantidade() ?></td>
            <td>R$<?= $item->getValorItem() ?></td>
            <td><a href="../controlers/controlerCarrinho.php?opcao=2&index=<?= $cont - 1 ?>"
                class='btn btn-danger btn-sm'>X</a></td>
          </tr>

          <?php
          $cont++;
          $soma += $item->getValorItem();
        }
        ?>

        <tr align="right">
          <td colspan="8">
            <font face="Verdana" size="4" color="red"><b><?= $soma ?></b></font>
          </td>
        </tr>
    </table>
    <div class="container text-center">
      <div class="row">
        <div class="col">
          <a class="btn btn-warning" role="button" href="../controlers/controlerProduto.php?opcao=6"><b>Continuar
              comprando</b></a>
        </div>
        <div class="col">
          <a class="btn btn-danger" role="button" href="../controlers/controlerCarrinho.php?opcao=3"><b>Esvaziar
              carrinho</b></a>
        </div>
        <div class="col">
          <form class="row g-3" action="../controlers/controlerCarrinho.php" method="post"
            enctype="multipart/form-data">
            <div class="row">
              <label for="pCupom" class="form-label">Cupom</label>
              <input type="text" class="form-control" name="pCupom">
              <button type="submit" class="btn btn-success">Finalizar compra</button>
              <input type="hidden" name="opcao" value="5">
              <input type="hidden" name="total" value="<?= $soma ?>">
            </div>
          </form>
          <!-- <a class="btn btn-success" role="button"
            href="../controlers/controlerCarrinho.php?opcao=5&total=<?= $soma ?>"><b>Finalizar compra</b></a> -->
        </div>



      </div>
    </div>

    <?php
  }
  require_once 'includes/rodape.inc.php';
  ?>
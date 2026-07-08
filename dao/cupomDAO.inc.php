<!-- Lucas Torres Sobral 2020204062 -->

<?php
require_once 'conexao.inc.php';
require_once '../classes/cupom.inc.php';
require_once '../utils/funcoesUteis.php';


class CupomDao
{
  private $con;

  function __construct()
  {
    $conexao = new Conexao();
    $this->con = $conexao->getConexao();
  }

  public function getCupomValido($codigo)
  {
    $query = "select cupom_id, codigo, data_validade, vl_percentual_desconto from cupom where codigo = '". $codigo ."' AND data_validade <= SYSDATE()";

    $sql = $this->con->query($query);

    $row = $sql->fetch(PDO::FETCH_OBJ);

    if ($row) {
      return new Cupom($row->cupom_id, $row->codigo, $row->data_validade, $row->vl_percentual_desconto);
    }
  }
}
?>
<!-- Lucas Torres Sobral 2020204062 -->

<?php
    require_once 'produto.inc.php';

    class Cupom{
        private $cupom_id;
        private $codigo;
        private $data_validade;
        private $vl_percentual_desconto;

        function __construct($cupom_id, $codigo, $data_validade, $vl_percentual_desconto){
            $this->cupom_id = $cupom_id;
            $this->codigo = $codigo;
            $this->data_validade = $data_validade;
            $this->vl_percentual_desconto = (double)$vl_percentual_desconto;
        }

        public function getCupomId(){
            return $this->cupom_id;
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function getDataValidade(){
            return $this->data_validade;
        }
        public function getValorpercentualDesconto(){
            return $this->vl_percentual_desconto;
        }

    }
?>
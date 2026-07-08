<?php
class Venda
{
    private $id_venda;
    private $cpf;
    private $valorTotal;
    private $data;

    function __construct($cpf, $valor){
        $this->cpf = $cpf;
        $this->valorTotal = $valor;
        $this->data = time();
    }

        // Métodos para id_venda
    public function getIdVenda() {
        return $this->id_venda;
    }

    public function setIdVenda($id_venda) {
        $this->id_venda = $id_venda;
    }

    // Métodos para cpf
    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    // Métodos para valorTotal
    public function getValorTotal() {
        return $this->valorTotal;
    }

    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }

    // Métodos para data
    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }
}

?>
<!-- Lucas Torres Sobral 2020204062 -->

<?php
    class Produto{
        public $produto_id;
        public $nome;
        public $data_fabricacao;
        public $preco;
        public $estoque;
        public $descricao;
        public $resumo;
        public $referencia;
        public $cod_fabricante;

        //TESTAR UTILIZANDO SOMENTE O CONSTRUTOR COM PARAMETROS
        function __construct(){}

        public function setProduto( 
            $nome, 
            $data_fabricacao,
            $preco,
            $estoque,
            $descricao,
            $resumo,
            $referencia,
            $cod_fabricante
        ){
            $this->nome = $nome;
            $this->data_fabricacao = strtotime($data_fabricacao);
            $this->preco = $preco;
            $this->estoque = $estoque;
            $this->descricao = $descricao;
            $this->resumo = $resumo;
            $this->referencia = $referencia;
            $this->cod_fabricante = $cod_fabricante;
        }
        //
    
       // GET e SET: Produto ID
        public function getProdutoId(){
            return $this->produto_id;
        }

        public function setProdutoId($produto_id){
            $this->produto_id = $produto_id;
        }

        // GET e SET: Nome
        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        // GET e SET: Data Fabricação
        public function getDataFabricacao(){
            return $this->data_fabricacao;
        }

        public function setDataFabricacao($data_fabricacao){
            $this->data_fabricacao = strtotime($data_fabricacao);
        }

        // GET e SET: Preço
        public function getPreco(){
            return $this->preco;
        }

        public function setPreco($preco){
            $this->preco = $preco;
        }

        // GET e SET: Estoque
        public function getEstoque(){
            return $this->estoque;
        }

        public function setEstoque($estoque){
            $this->estoque = $estoque;
        }

        // GET e SET: Descrição
        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }

        // GET e SET: Resumo
        public function getResumo(){
            return $this->resumo;
        }

        public function setResumo($resumo){
            $this->resumo = $resumo;
        }

        // GET e SET: Referência
        public function getReferencia(){
            return $this->referencia;
        }

        public function setReferencia($referencia){
            $this->referencia = $referencia;
        }

        // GET e SET: Código Fabricante
        public function getCodFabricante(){
            return $this->cod_fabricante;
        }

        public function setCodFabricante($cod_fabricante){
            $this->cod_fabricante = $cod_fabricante;
        }
    }
?>
<?php

class Produto {

    private $nome;
    private $descricao;
    private $preco;
    private $idFornecedor;

    public function __construct($nome, $descricao, $preco, $idFornecedor) {

        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->idFornecedor = $idFornecedor;

    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getIdFornecedor() {
        return $this->idFornecedor;
    }

}

?>
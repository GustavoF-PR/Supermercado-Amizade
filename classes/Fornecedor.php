<?php

class Fornecedor {

    private $nome;
    private $cnpj;
    private $telefone;
    private $email;

    public function __construct($nome, $cnpj, $telefone, $email) {

        $this->nome = $nome;
        $this->cnpj = $cnpj;
        $this->telefone = $telefone;
        $this->email = $email;

    }

    public function getNome() {
        return $this->nome;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEmail() {
        return $this->email;
    }

}

?>
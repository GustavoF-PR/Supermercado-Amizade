<?php

class Carrinho {

    private $idUsuario;
    private $idProduto;

    public function __construct($idUsuario, $idProduto) {

        $this->idUsuario = $idUsuario;
        $this->idProduto = $idProduto;

    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

}

?>
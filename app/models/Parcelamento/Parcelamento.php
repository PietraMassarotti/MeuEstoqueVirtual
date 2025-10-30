<?php
namespace App\Models\Parcelamento;

class Parcelamento {

    private $id;
    private $quantidade;
    private $taxa_juros;
    private $create_at;
    private $update_at;
    private $metodos_pagamento_id; 

    // Construtor
    public function __construct($data) {
        $this->id = $data['id'];
        $this->quantidade = $data['quantidade'];
        $this->taxa_juros = $data['taxa_juros'];
        $this->create_at = $data['create_at'];
        $this->update_at = $data['update_at'];
        $this->metodos_pagamento_id = $data['metodos_pagamento_id'];

    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

     public function getTaxaJuros() {
        return $this->taxa_juros;
    }

    public function getCreatedAt() {
        return $this->create_at;
    }

    public function getUpdateAt() {
        return $this->update_at;
    }

    public function getMetodoPagamentoId() {
        return $this->metodos_pagamento_id;
    }

    // Setters
    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

      public function setTaxaJuros($taxa_juros) {
        $this->taxa_juros = $taxa_juros;
    }

    public function setUpdateAt($update_at) {
        $this->update_at = $update_at;
    }

    public function setMarcasId($metodos_pagamento_id) {
        $this->metodos_pagamento_id = $metodos_pagamento_id;
    }

}
?>
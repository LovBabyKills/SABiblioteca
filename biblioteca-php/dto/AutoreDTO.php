<?php
class AutoreDTO {
    public $nome;
    public $cognome;
    public $dataNascita;

    public function __construct($nome, $cognome, $dataNascita)
    {
        $this->nome = $nome;
        $this->cognome= $cognome;
        $this->dataNascita=$dataNascita;
    }

    function setNome($nome){
        $this->nome = $nome;
    }

    function setCognome($cognome){
        $this->cognome = $cognome;
    }

    function setDataNascita($dataNascita){
        $this->dataNascita = $dataNascita;
    }

    function getNome(){
        return $this->nome;
    }

    function getCognome(){
        return $this->cognome;
    }

    function getDataNascita(){
        return $this->dataNascita;
    }
}
?>
<?php
class Autore {
    public $id;
    public $nome;
    public $cognome;
    public $dataNascita; //data_nascita YYYY-MM-DD

    //costruttore
    public function __construct($id, $nome, $cognome, $dataNascita){
        $this->id = $id;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->dataNascita = $dataNascita;
    }

    //setter
    function setId($id){
        $this->id = $id;
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

    //getter
    function getId(){
        return $this->id;
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
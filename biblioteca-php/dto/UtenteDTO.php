<?php
class UtenteDTO {
    public $nome;
    public $cognome;
    public $email;

    public function __construct($nome = null, $cognome = null, $email = null){
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
    }

    function setNome($nome){
        $this->nome = $nome;
    }

    function setCognome($cognome){
        $this->cognome = $cognome;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function getNome(){
        return $this->nome;
    }

    function getCognome(){
        return $this->cognome;
    }

    function getEmail(){
        return $this->email;
    }
}
?>
<?php
class Utente {
    public $id;
    public $nome;
    public $cognome;
    public $email;

    public function __construct($nome, $cognome, $email, $id = null){
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->id = $id;
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

    function setEmail($email){
        $this->email = $email;
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

    function getEmail(){
        return $this->email;
    }
}
?>
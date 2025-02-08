<?php
class Libro {
    public $id;
    public $titolo;
    public $annoPubblicazione;
    //public Autore $autore;
    public $idAutore;

    public function __construct($id, $titolo, $annoPubblicazione, $idAutore){
        $this->id = $id;
        $this->titolo = $titolo;
        $this->annoPubblicazione = $annoPubblicazione;
        //$this->autore = $autore;
        $this->idAutore = $idAutore;
    }

    //setter
    function setId($id){
        $this->id = $id;
    }

    function setTitolo($titolo){
        $this->titolo = $titolo;
    }

    function setAnnoPubblicazione($annoPubblicazione){
        $this->annoPubblicazione = $annoPubblicazione;
    }

    function setIdAutore($idAutore){
        $this->idAutore = $idAutore;
    }

    //getter
    function getId(){
        return $this->id;
    }

    function getTitolo(){
        return $this->titolo;
    }

    function getAnnoPubblicazione(){
        return $this->annoPubblicazione;
    }

    function getIdAutore(){
        return $this->idAutore;
    }
}
?>
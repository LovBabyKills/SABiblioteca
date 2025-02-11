<?php
class LibroDTO {
    public $titolo;
    public $annoPubblicazione;
    public $nomeAutore;

    public function __construct($titolo, $annoPubblicazione, $nomeAutore){
        $this->titolo = $titolo;
        $this->annoPubblicazione = $annoPubblicazione;
        $this->nomeAutore = $nomeAutore;
    }

    //setter
    function setTitolo($titolo){
        $this->titolo = $titolo;
    }

    function setAnnoPubblicazione($annoPubblicazione){
        $this->annoPubblicazione = $annoPubblicazione;
    }

   // function setIdAutore($idAutore){
   //     $this->idAutore = $idAutore;
   // }

    function setNomeAutore($nomeAutore){
        $this->nomeAutore = $nomeAutore;
    }

    //getter
    function getTitolo(){
        return $this->titolo;
    }

    function getAnnoPubblicazione(){
        return $this->annoPubblicazione;
    }

   // function getIdAutore(){
    //    return $this->idAutore;
   // }

    function getNomeAutore(){
        return $this->nomeAutore;
    }
}
?>
<?php
class PrestitoDTO{
    public $nomeUtente;
    public $titoloLibro;
    public $dataPrestito;
    public $dataRestituzione;

    public function __construct($nomeUtente, $titoloLibro, $dataPrestito, $dataRestituzione = null){
        $this->nomeUtente = $nomeUtente;
        $this->titoloLibro = $titoloLibro;
        $this->dataPrestito = $dataPrestito;
        $this->dataRestituzione = $dataRestituzione;
    }

    function setNomeUtente($nomeUtente){
        $this->nomeUtente = $nomeUtente;
    }
    function setTitoloLibro($titoloLibro){
        $this->titoloLibro = $titoloLibro;
    }
    function setDataPrestito($dataPrestito){
        $this->dataPrestito = $dataPrestito;
    }
    function setDataRestituzione($dataRestituzione){
        $this->dataRestituzione = $dataRestituzione;
    }

    function getNomeUtente(){
        return $this->nomeUtente;
    }
    function getTitoloLibro(){
        return $this->titoloLibro;
    }
    function getDataPrestito(){
        return $this->dataPrestito;
    }
    function getDataRestituzione(){
        return $this->dataRestituzione;
    }
}




?>
<?php
class Prestito {
    public $id;
    public $idUtente;
    public $idLibro;
    public $dataPrestito;
    public $dataRestituzione;

    public function __construct($id, $idUtente, $idLibro, $dataPrestito, $dataRestituzione = null)
    {
        $this->id = $id;
        $this->idUtente = $idUtente;
        $this->idLibro = $idLibro;
        $this->dataPrestito = $dataPrestito;
        $this->dataRestituzione = $dataRestituzione;
    }

    //setter
    function setId($id){
        $this->id = $id;
    }

    function setIdUtente($idUtente){
        $this->idUtente = $idUtente;
    }

    function setIdLibro($idLibro){
        $this->idLibro = $idLibro;
    }

    function setDataPrestito($dataPrestito){
        $this->dataPrestito = $dataPrestito;
    }

    function setDataRestituzione($dataRestituzione){
        $this->dataRestituzione = $dataRestituzione;
    }
}

?>
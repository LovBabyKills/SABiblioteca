<?php 
include '../repository/RepoPrestito.php';
include_once '../mapper/PrestitoMapper.php';
include '../componenti/connessione.php';

class ServicePrestito{
    private $repoPrestito;
    private $prestitoMapper;

    public function __construct($conn)
    {
        $this->repoPrestito = new RepoPrestito($conn);
        $this->prestitoMapper = new PrestitoMapper;
    }

    public function getAll(){
        $listaPrestitiData = $this->repoPrestito->getAllRepoPrestiti();
        return $this->prestitoMapper->allPrestitiToPrestitiDTO($listaPrestitiData);
    }

    public function getById($id){
        $prestitoData = $this->repoPrestito->getPresitoById($id);
        return $this->prestitoMapper->prestitoToPrestitoDTO($prestitoData);
    }
    public function getPrestitiDaRestituire(){
        $listaPrestitiData = $this->repoPrestito->getPrestitoDaRestituireRepo();
        return $this->prestitoMapper->allPrestitiToPrestitiDTO($listaPrestitiData);

    }
}

?>
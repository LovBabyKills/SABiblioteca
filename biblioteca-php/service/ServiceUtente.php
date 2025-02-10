<?php
include '../repository/RepoUtente.php';
include_once '../mapper/UtenteMapper.php';
include '../componenti/connessione.php';

class ServiceUtente
{
    private $repoUtente;
    private $utenteMapper;
    
    // devo passare $conn
    public function __construct($conn)
    {
        $this->repoUtente = new RepoUtente($conn);
        $this->utenteMapper = new UtenteMapper();
    }

    public function getAll(){
        $listaUtenti = $this->repoUtente->getAllRepoUtenti();
        return $this->utenteMapper->allUtentiToUtentiDTO($listaUtenti);
    }

    public function getById($id){
        $utente = $this->repoUtente->getUtenteByIdRepo($id);
        return $this->utenteMapper->utenteToUtenteDTO($utente);
    }

    


/*
    function getUtenteByIdService($id){
        $utente = getUtenteByIdRepoUtente($id);
        return $utente;
    }

*/
}
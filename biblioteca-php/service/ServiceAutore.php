<?php
include '../repository/RepoAutore.php';
include_once '../mapper/AutoreMapper.php';
include '../componenti/connessione.php';

class ServiceAutore
{
    private $repoAutore;
    private $autoreMapper;
    
    // devo passare $conn
    public function __construct($conn)
    {
        $this->repoAutore = new RepoAutore($conn);
        $this->autoreMapper = new AutoreMapper();
    }

    public function getAll(){
        $listaAutori = $this->repoAutore->getAllRepoAutori();
        return $this->autoreMapper->allAutoreToAutoreDTO($listaAutori);
    }

    public function getById($id){
        $autore = $this->repoAutore->getAutoreById($id);
        return $this->autoreMapper->autoreToAutoreDTO($autore);
    }

/*
    function getUtenteByIdService($id){
        $utente = getUtenteByIdRepoUtente($id);
        return $utente;
    }

*/
}
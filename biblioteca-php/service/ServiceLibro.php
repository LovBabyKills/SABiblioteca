<?php
include '../repository/RepoLibro.php';
include_once '../mapper/LibroMapper.php';
include '../componenti/connessione.php';

class ServiceLibro{
    private $repoLibro;
    private $libroMapper;

    public function __construct($conn)
    {
        $this->repoLibro = new RepoLibro($conn);
        $this->libroMapper = new LibroMapper();
    }

    public function getAll(){
        $listaLibriData = $this->repoLibro->getAllRepoLibri();
        return $this->libroMapper->AllLibriToLibriDTO($listaLibriData);
    }

    public function getById($id){
        $libroData = $this->repoLibro->getLibroByIdRepo($id);
        return $this->libroMapper->libroToLibroDTO($libroData);
    }

    public function getAllLibriByAutore($id){
        $listaLibriData = $this->repoLibro->getLibriByIdAutoreRepo($id);
        return $this->libroMapper->AllLibriToLibriDTO($listaLibriData);

    }

}


?>
<?php
include '../repository/RepoUtente.php';
include_once '../mapper/UtenteMapper.php';

class ServiceUtente
{
    function getAll()
    {
        $listaUtentiDTO = allUtentiToUtentiDTO(getAllRepoUtenti());
        return $listaUtentiDTO;
    }



/*
    function getUtenteByIdService($id){
        $utente = getUtenteByIdRepoUtente($id);
        return $utente;
    }

*/
}
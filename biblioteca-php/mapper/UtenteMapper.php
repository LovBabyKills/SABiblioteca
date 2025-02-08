<?php
include_once '../entity/Utente.php';
include_once '../dto/UtenteDTO.php';

function utenteToUtenteDTO($utente){
    $UtenteDTO = new UtentedTO($utente->getNome(),$utente->getCognome(),$utente->getEmail());
    return $UtenteDTO;
}

function allUtentiToUtentiDTO($listaUtenti){
    $listaUtentiDTO = [];
    foreach($listaUtenti as $utente){
        $listaUtentiDTO[] = utenteToUtenteDTO($utente);
    }
    return $listaUtentiDTO;
}
?>
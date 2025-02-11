<?php
include_once '../entity/Utente.php';
include_once '../dto/UtenteDTO.php';
     
class UtenteMapper {

    public function utenteToUtenteDTO(Utente $utente){
        return new UtenteDTO($utente->getNome(), $utente->getCognome(), $utente->getEmail());
    }

    public function allUtentiToUtentiDTO(array $listaUtenti){
        $listaUtentiDTO = [];
        foreach($listaUtenti as $utente){
            $listaUtentiDTO[] = $this->utenteToUtenteDTO($utente);
        }
        return $listaUtentiDTO;
    }

}
?>
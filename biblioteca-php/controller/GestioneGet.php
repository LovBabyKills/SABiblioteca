<?php
require_once 'GestioneRichiesta.php';
require_once 'ValidazioneDatiController.php';
require_once '../service/ServiceUtente.php';

class GestioneGet implements GestioneRichiesta
{
    public function gestisci($input): void
    {
        var_dump($input);
        $id = null; // mi dava warning nel get all altrimenti
        if (isset($_GET['id'])) {
            $id = ValidazioneDatiController::validazioneId($_GET['id']) ?? null;
        }

        $risorsa = ValidazioneDatiController::validazioneRisorsa();

        if(isset($input['autore'])){
            $autore = ValidazioneDatiController::validazioneStringa($input['autore']);
        }



/*
        $arrayRisorse = [
            'utenti' => 'ServiceUtente',
            'libri' => 'LibroService',
            'autori' => 'AutoreService',
            'prestiti' => 'PrestitoService'
        ];

        if (isset($arrayRisorse[$risorsa])) {
            $risultato = $id ?
                ((new $arrayRisorse[$risorsa]())->getById($id)) : ((new $arrayRisorse[$risorsa]())->getAll());
            http_response_code(200);
            echo json_encode($risultato);
            exit;
        }
*/
    }
}

<?php
require_once 'GestioneRichiesta.php';
require_once 'ValidazioneDatiController.php';
require_once '../service/ServiceUtente.php';
require_once './validation/Validazione.php';
require_once './validation/Regole.php';

class GestioneGet implements GestioneRichiesta
{
    public function gestisci(array $input, string $risorsa): void
    {
        //per le richieste senza id o parametri
        $arrayMetodi = [
            'autori' => 'getAllAutori', 
            'libri' => 'getAllLibri', 
            'utenti' => 'getAllUtenti', 
            'prestiti' => 'getAllPrestiti'
        ];
        
        //
        $arraySottometodi = [
            'libri' => [
                'idAutore' => 'getAllLibriByAutore',
                'annoPubblicazione' => 'getAllLibriByAnno',
            ],
            'autore' => [
                'idAutore' => 'getAutoreById'
            ],
            'prestiti' => [
                'nonRestituiti' => 'getUtentiPrestitiNonRestituiti'
            ],
            'utenti' => [
                'id' => 'getUtenteById'
            ]
        ];

        //var_dump($input);
        exit;





/*

       // var_dump($input);
        $id = null; // mi dava warning nel get all altrimenti
        if (isset($_GET['id'])) {
            $id = ValidazioneDatiController::validazioneId($_GET['id']) ?? null;
        }

        $risorsa = $_GET['risorsa'];

        //prova regola validazione
       
        $validatore = new Validazione();
        if(!$validatore->valida($input, regolaProva())){
            http_response_code(400);
            echo json_encode(['errors' => $validatore->getErrors()]);
            exit;
        }
        http_response_code(200);
        echo json_encode(['messaggio' => "funziona!!!"]);
        


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

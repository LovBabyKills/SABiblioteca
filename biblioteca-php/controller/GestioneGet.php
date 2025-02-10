<?php
require_once '../componenti/connessione.php';
require_once 'GestioneRichiesta.php';
require_once 'ValidazioneDatiController.php';
require_once '../service/ServiceUtente.php';
require_once '../service/ServiceAutore.php';
require_once './validation/Validazione.php';
require_once './validation/Regole.php';

class GestioneGet implements GestioneRichiesta
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //per le richieste senza id o parametri
    private $arrayMetodi = [
        'autori' => ServiceAutore::class,
        'libri' => 'serviceLibri',
        'utenti' => ServiceUtente::class,
        'prestiti' => 'servicePrestiti'
    ];

    private $arraySottometodi = [
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


    public function gestisci(array $input, array $parametriInput): void
    {
        var_dump($parametriInput);
        if (
            isset($parametriInput['risorsa']) &&
            isset($parametriInput['id']) &&
            isset($parametriInput['risorsa2'])
        ) {
            $this->gestisciTutto($parametriInput);
        } elseif (
            isset($parametriInput['risorsa']) &&
            isset($parametriInput['id'])
        ) {
            $this->gestisciRisorsaEParam($parametriInput);
        } elseif (isset($parametriInput['risorsa'])) {
            $this->gestisciRisorsa($parametriInput);
        } else {
            http_response_code(400);
            echo json_encode(['errore' => 'errore nel link']);
            exit;
        }
    }


    private function gestisciRisorsa($parametriInput)
    {
        echo "sono in  1";
        $risorsa = $parametriInput['risorsa'];
        if (!isset($this->arrayMetodi[$risorsa])) {
            http_response_code(400);
            echo json_encode(['errore' => 'risorsa non valida']);
            exit;
        }

        $classeService = $this->arrayMetodi[$risorsa]; //ad esempio prendo la classe ServiceUtenti
        $istanzaService = new $classeService($this->conn);

        $valori = $istanzaService->getAll();
        http_response_code(200);
        echo json_encode($valori);
    }


    private function gestisciRisorsaEParam($parametriInput)
    {
        echo "sono in 2";
        $risorsa = $parametriInput['risorsa'];
        $id = $parametriInput['id'];
        if (!isset($this->arrayMetodi[$risorsa])) {
            http_response_code(400);
            echo json_encode(['errore' => 'risorsa non valida']);
            exit;
        }

        $classeService = $this->arrayMetodi[$risorsa];
        $istanzaService = new $classeService($this->conn);

        $utente = $istanzaService->getById($id);
        http_response_code(200);
        echo json_encode($utente);
    }

    private function gestisciTutto($parametriInput)

    {
        echo "ciao";
    }
}

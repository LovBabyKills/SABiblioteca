<?php
require_once '../componenti/connessione.php';
require_once 'GestioneRichiesta.php';
require_once 'ValidazioneDatiController.php';
require_once '../service/ServiceUtente.php';
require_once '../service/ServiceAutore.php';
require_once '../service/ServicePrestito.php';
require_once '../service/ServiceLibro.php';
require_once './validation/Validazione.php';
require_once './validation/Regole.php';

//api/v1/biblioteca/libri
//api/v1/biblioteca/libri/1
//api/v1/biblioteca/autori/5/libri    -->es libri dell'autore con id 5   risorsa/id/sottorisorsa

//api/v1/biblioteca/autori
//api/v1/biblioteca/autori/1

//api/v1/biblioteca/prestiti
//api/v1/biblioteca/prestiti/1
//api/v1/biblioteca/prestiti/azione/daRestituire

//api/v1/biblioteca/utenti
//api/v1/biblioteca/utenti/1

class GestioneGet implements GestioneRichiesta
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //per le richieste /risorsa
    private $arrayMetodi = [
        'autori' => ServiceAutore::class,
        'libri' => ServiceLibro::class,
        'utenti' => ServiceUtente::class,
        'prestiti' => ServicePrestito::class
    ];

    //per le richiesta con risorsa/id/sottorisorsa
    private $arraySottometodi = [
        'autori' => [
            'libri' => [
                'service' => ServiceLibro::class,
                'method' => 'getAllLibriByAutore'
            ]
        ]
    ];

    //per le richieste con risorsa/azione/nomeazione
    private $arrayAzioni = [
        'prestiti' => [
            'daRestituire' => 'getPrestitiDaRestituire',
            'restituiti' => 'getPrestitiRestituiti',            //esempio, non implementato
            'nonRestituiti' => 'getPrestitiNonRestituiti'       //esempio, non implementato
        ],
        'libri' => [
            'disponibili' => 'getLibriDisponibili',             //esempio, non implementato
            'prestati' => 'getLibriPrestati'                    //esempio, non implementato
        ]
    ];


    public function gestisci(array $input, array $parametriInput): void
    {
     //   var_dump($parametriInput);

        if(
            isset($parametriInput['risorsa']) &&
            isset($parametriInput['azione'])
        ){
            $this->gestisciAzione($parametriInput);
        }elseif (
            isset($parametriInput['risorsa']) &&
            isset($parametriInput['id']) &&
            isset($parametriInput['sottorisorsa'])
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
       // echo "sono in  1";
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
     //   echo "sono in 2";
        $risorsa = $parametriInput['risorsa'];
        $id = $parametriInput['id'];
        if (!isset($this->arrayMetodi[$risorsa])) { //controllo forsa inutile?
            http_response_code(400);
            echo json_encode(['errore' => 'risorsa non valida']);
            exit;
        }

        $classeService = $this->arrayMetodi[$risorsa];
        $istanzaService = new $classeService($this->conn);

        $valori = $istanzaService->getById($id);
        http_response_code(200);
        echo json_encode($valori);
    }

    private function gestisciTutto($parametriInput)

    {
       $risorsa = $parametriInput['risorsa'];
       $id = $parametriInput['id'];
       $sottorisorsa = $parametriInput['sottorisorsa']; 

       if(false){
        http_response_code(400);
        echo json_encode(['errore' => 'risorsa o azione non valide']);
        exit;
       }

       if (!isset($this->arraySottometodi[$risorsa][$sottorisorsa])) {
        http_response_code(400);
        echo json_encode(['errore' => "Sottorisorsa '{$sottorisorsa}' non trovata per la risorsa '{$risorsa}'"]);
        exit;
    }
       $classeService = $this->arraySottometodi[$risorsa][$sottorisorsa]['service'];  //creo la classe service della sottorisorsa in questo caso libri
       $metodoService = $this->arraySottometodi[$risorsa][$sottorisorsa]['method'];

       $istanzaService = new $classeService($this->conn);
       //da istanza alla response posso crearmi un metodo specifico da usare per tutti i casi credo, VEDERE
       $valori = $istanzaService->$metodoService($id);
       http_response_code(200);
       echo json_encode($valori);

    }

    private function gestisciAzione($parametriInput)

    {
       $risorsa = $parametriInput['risorsa'];
       $azione = $parametriInput['azione'];

       if(!isset($this->arrayMetodi[$risorsa]) ||
        !isset($this->arrayAzioni[$risorsa][$azione])){ //controllo forsa inutile?
        http_response_code(400);
        echo json_encode(['errore' => 'risorsa o azione non valide']);
        exit;
       }
       $classeService = $this->arrayMetodi[$risorsa];
       $metodoService = $this->arrayAzioni[$risorsa][$azione];
      // echo "metodo service" . var_dump($metodoService);
       $istanzaService = new $classeService($this->conn);
       
       $valori = $istanzaService->$metodoService();
       http_response_code(200);
       echo json_encode($valori);

    }
}

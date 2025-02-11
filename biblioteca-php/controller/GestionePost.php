<?php
require_once '../componenti/connessione.php';
require_once 'GestioneRichiesta.php';
require_once './validation/Regole.php';


//per ora metto solo NUOVI UTENTI E NUOVI LIBRI

class GestionePost implements GestioneRichiesta{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;        
    }
     
    
    private $arrayMetodi = [
        'autori' => ServiceAutore::class,
        'libri' => ServiceLibro::class,
        'utenti' => ServiceUtente::class,
        'prestiti' => ServicePrestito::class
    ];

    private array $regolePerRisorsa = [
        'libri' => 'getRegoleLibro',
        'utenti' => 'getRegoleUtente', 
        'autori' => 'getRegoleAutore',
        'prestiti' => 'getRegolePrestito'
    ];

    public function gestisci(array $input, array $parametriInput): void
    {
        if(isset($parametriInput['risorsa'])){
            $this->gestisciAzione($input, $parametriInput['risorsa']);
        } else {
        http_response_code(400);
        echo json_encode(['errore' => 'azione non disponibile']);
        exit;
        }
    }

    private function gestisciAzione(array $input, string $risorsa){

        $nomeFunzione = $this->regolePerRisorsa[$risorsa];      // esempio getRegoleLibro
        $regoleValidazione = $nomeFunzione();                      // array con le regole
    //    var_dump($regoleValidazione);

        $validatore = new Validazione();
        $esito = $validatore->valida($input, $regoleValidazione);   //passo input e array di regole
      //  var_dump($esito);
        if(!$esito){                                                    // se esito e' falso mi da errore
            $errori = $validatore->getErrori();
            http_response_code(400);
            echo json_encode($errori);
            exit;
        }
        echo "ciao";
    }


}
?>
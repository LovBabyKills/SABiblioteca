<?php
include '../componenti/connessione.php';
include '../entity/Utente.php';
require_once 'GestioneGet.php';

header("Content-Type: application/json");
$input = json_decode(file_get_contents('php://input'), true) ?? [];  //se l'input non ce credo un array vuoto perche' devo comunque passare un array
$method = $_SERVER['REQUEST_METHOD'];

var_dump($input);

$arrayMetodi = [
    'GET' => GestioneGet::class
];

$arrayRisorsa = ['autori', 'libri', 'prestiti', 'utenti'];
$arrayRisorsaDue = ['autori', 'libri'];

//verifico che il link sia giusto e mi prendo la risorsa
if (isset($_GET['risorsa']) && in_array($_GET['risorsa'], $arrayRisorsa)) {
    $risorsa = $_GET['risorsa'];  // Corretto il typo in $_GET['risorsa']
    

    if (isset($_GET['id'])) {    //il parametro non e' obbligatorio
        $id = $_GET['id'];
        
        if (isset($_GET['risorsa2'])) { //controllo se esiste, se esiste deve stare nll'array altrimenti do errore
            if (array_key_exists($_GET['risorsa2'], $arrayRisorsaDue)) {
                $risorsa2 = $_GET['risorsa2'];
            } else {
                http_response_code(400);
                echo json_encode(['errore' => 'risorsa2 non valida']);
                exit;  // Aggiunto exit dopo l'errore
            }
        }
    }
} else {
    http_response_code(400);
    echo json_encode(['errore' => 'Risorsa non valida']);  
    exit;
}
//esempio autori/1/libri per prendere i libri dell'autore con id 1
$parametriInput = [
    'risorsa' => $risorsa,
    'id' => $id ?? null,
    'risorsa2' => $risorsa2 ?? null
];


//se esiste il metodo nell'array istanzione la classe Gestionemetodo e chiamo il suo metodo gestisci passando l'input
if(isset($arrayMetodi[$method])){
    $classe = $arrayMetodi[$method];
    $gestione = new $classe($conn);
    $gestione->gestisci($input, $parametriInput);    
}else{
    http_response_code(400);
    echo json_encode(['errore' => 'Metodo errato']);
    exit;
}
?>
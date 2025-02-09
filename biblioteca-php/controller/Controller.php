<?php
include '../componenti/connessione.php';
include '../entity/Utente.php';
require_once 'GestioneGet.php';

header("Content-Type: application/json");
$input = json_decode(file_get_contents('php://input'), true);
$method = $_SERVER['REQUEST_METHOD'];

var_dump($input);

$arrayMetodi = [
    'GET' => 'GestioneGet'
];

$arrayRisorsa = ['autori', 'libri', 'prestiti', 'utenti'];

//verifico che il link sia giusto e mi prendo la risorsa
if(isset($_GET['risorsa']) && array_key_exists($_GET['risorsa'], $arrayRisorsa)) {
    $risorsa = $_GET($rirosa);
} else {
    http_response_code(400);
    echo json_encode(['errore' => 'Metodo errato']);
    exit;
}


//se esiste il metodo nell'array istanzione la classe Gestionemetodo e chiamo il suo metodo gestisci passando l'input
if(isset($arrayMetodi[$method])){
    (new $arrayMetodi[$method]())->gestisci($input, $risorsa);
}else{
    http_response_code(400);
    echo json_encode(['errore' => 'Metodo errato']);
    exit;
}
?>
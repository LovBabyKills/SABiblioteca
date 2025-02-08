<?php
include '../componenti/connessione.php';
include '../entity/Utente.php';
require_once 'GestioneGet.php';

header("Content-Type: application/json");
$input = json_decode(file_get_contents('php://input'), true);
$method = $_SERVER['REQUEST_METHOD'];


$arrayMetodi = [
    'GET' => 'GestioneGet'
];

//se esiste il metodo nell'array istanzione la classe Gestionemetodo e chiamo il suo metodo gestisci passando l'input
if(isset($arrayMetodi[$method])){
    (new $arrayMetodi[$method]())->gestisci($input);
}else{
    http_response_code(400);
    echo json_encode(['errore' => 'Metodo errato']);
    exit;
}
?>
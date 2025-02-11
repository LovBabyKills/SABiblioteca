<?php
include '../componenti/connessione.php';
include '../entity/Utente.php';
require_once 'GestioneGet.php';
require_once 'GestionePost.php';

header("Content-Type: application/json");
$input = json_decode(file_get_contents('php://input'), true) ?? [];  //se l'input non ce credo un array vuoto perche' devo comunque passare un array
$method = $_SERVER['REQUEST_METHOD'];

//var_dump($input);

$arrayMetodi = [
    'GET' => GestioneGet::class,
    'POST' => GestionePost::class
];

$risorsa = $_GET['risorsa'] ?? null;
$azione = $_GET['azione'] ?? null;
$id = $_GET['id'] ?? null;
$sottorisorsa = $_GET['sottorisorsa'] ?? null;

// Controllo validità dei parametri
$arrayRisorsa = ['autori', 'libri', 'prestiti', 'utenti'];
$arrayAzioni = ['daRestituire'];
$arraySottorisorsa = ['autori', 'libri'];

if (!in_array($risorsa, $arrayRisorsa)) {
    http_response_code(400);
    echo json_encode(['errore' => 'Entità non valida']);
    exit;
}

if ($azione !== null && !in_array($azione, $arrayAzioni)) {
    http_response_code(400);
    echo json_encode(['errore' => 'Azione non valida']);
    exit;
}

if ($id !== null && (!is_numeric($id) || $id <= 0)) {
    http_response_code(400);
    echo json_encode(['errore' => 'ID non valido']);
    exit;
}

if ($sottorisorsa !== null && !in_array($sottorisorsa, $arraySottorisorsa)) {
    http_response_code(400);
    echo json_encode(['errore' => 'Sottoentità non valida']);
    exit;
}

// Parametri finali pronti per essere usati nel service
$parametriInput = [
    'risorsa' => $risorsa,
    'azione' => $azione ?: null,
    'id' => $id !== null ? (int) $id : null,
    'sottorisorsa' => $sottorisorsa ?: null
];



//se esiste il metodo nell'array istanzione la classe Gestionemetodo e chiamo il suo metodo gestisci passando l'input
if (isset($arrayMetodi[$method])) {
    $classe = $arrayMetodi[$method];
    $gestione = new $classe($conn);
    $gestione->gestisci($input, $parametriInput);
} else {
    http_response_code(400);
    echo json_encode(['errore' => 'Metodo errato']);
    exit;
}

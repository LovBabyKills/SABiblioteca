<?php
include_once '../entity/Utente.php';

function getAllRepoUtenti(){
    global $conn;
    $query = "SELECT * FROM utenti";
    $result = mysqli_query($conn, $query);
    $arrayUtenti = [];
    while($row = mysqli_fetch_assoc($result)){
        $utente = new Utente(
         //   $row['id'],
            $row['nome'],
            $row['cognome'],
            $row['email']
        );
        $arrayUtenti[] = $utente;
    }
    mysqli_free_result($result);
    return $arrayUtenti;
}
?>
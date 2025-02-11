<?php
include '../entity/Prestito.php';

class RepoPrestito
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllRepoPrestiti()
    {
        $query = "SELECT p.*,
        l.titolo as titolo_libro,
        u.nome as nome_utente,
        u.cognome as cognome_utente
        FROM prestiti p
        JOIN utenti u on p.id_utente = u.id
        JOIN libri l on p.id_libro = l.id";

        $result = mysqli_query($this->conn, $query);
        $prestitiData = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $prestito = new Prestito(
                $row['id'],
                $row['id_utente'],
                $row['id_libro'],
                $row['data_prestito'],
                $row['data_restituzione']
            );
            $prestitiData[] = [
                $prestito,
                $row['nome_utente'],
                $row['cognome_utente'],
                $row['titolo_libro']
            ];
        }
        mysqli_free_result($result);
        return $prestitiData;
    }

    public function getPresitoById($id)
    {
        $query = "SELECT p.*,
        u.nome as nome_utente,
        u.cognome as cognome_utente,
        l.titolo as titolo_libro
        FROM prestiti p
        JOIN utenti u on p.id_utente = u.id
        JOIN libri l on p.id_libro = l.id
        WHERE p.id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $prestito = new Prestito(
                $row['id'],
                $row['id_utente'],
                $row['id_libro'],
                $row['data_prestito'],
                $row['data_restituzione']
            );
            $prestitoData = [$prestito, $row['nome_utente'], $row['cognome_utente'], $row['titolo_libro']];
        }
        mysqli_free_result($result);
        return $prestitoData;
    }

    public function getPrestitoDaRestituireRepo()
    {
        $query = "SELECT p.*,
        u.nome as nome_utente,
        u.cognome as cognome_utente,
        l.titolo as titolo_libro
        FROM prestiti p
        JOIN utenti u on p.id_utente = u.id
        JOIN libri l on p.id_libro = l.id
        WHERE p.data_restituzione IS NULL"; //non serve bind param tanto glielo sto passando io


        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $prestitiData = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $prestito = new Prestito(
                $row['id'],
                $row['id_utente'],
                $row['id_libro'],
                $row['data_prestito'],
                $row['data_restituzione']
            );
            $prestitiData[] = [
                $prestito, 
                $row['nome_utente'], 
                $row['cognome_utente'], 
                $row['titolo_libro']];
        }
        mysqli_free_result($result);
        return $prestitiData;
    }
}

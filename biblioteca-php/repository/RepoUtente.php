<?php
include_once '../entity/Utente.php';

class RepoUtente
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllRepoUtenti()
    {
        $query = "SELECT * FROM utenti";
        $result = mysqli_query($this->conn, $query);
        $arrayUtenti = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $utente = new Utente(
                $row['id'],
                $row['nome'],
                $row['cognome'],
                $row['email']
            );
            $arrayUtenti[] = $utente;
        }
        mysqli_free_result($result);
        return $arrayUtenti;
    }

    public function getUtenteByIdRepo($id)
    {
        $query = "SELECT * FROM utenti WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $utente = null;
        if ($row = mysqli_fetch_assoc($result)) {
            $utente = new Utente(
                $row['id'],
                $row['nome'],
                $row['cognome'],
                $row['email']
            );
        }
        mysqli_stmt_close($stmt);
        mysqli_free_result($result);
        return $utente;
    }
}
?>

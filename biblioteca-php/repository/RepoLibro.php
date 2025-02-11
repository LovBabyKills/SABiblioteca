<?php
include '../entity/Libro.php';

class RepoLibro
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllRepoLibri()
    {
        $query = "SELECT lib.*,
        aut.nome as nome_autore,
        aut.cognome as cognome_autore
        FROM libri lib
        JOIN autori aut on aut.id = lib.id_autore";

        $result = mysqli_query($this->conn, $query);
        $libriData = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $libro = new Libro(
                $row['id'],
                $row['titolo'],
                $row['anno_pubblicazione'],
                $row['id_autore']
            );
            $libriData[] = [$libro, $row['nome_autore'], $row['cognome_autore']];
            //var_dump($libri);
        }
        mysqli_free_result($result);
        return $libriData;
    }

    public function getLibroByIdRepo($id)
    {
        $query = "SELECT lib.*,
        aut.nome as nome_autore,
        aut.cognome as cognome_autore
        FROM libri lib
        JOIN autori aut on aut.id = lib.id_autore
        WHERE lib.id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $libro = new Libro(
                $row['id'],
                $row['titolo'],
                $row['anno_pubblicazione'],
                $row['id_autore']
            );
            $libroData = [$libro, $row['nome_autore'], $row['cognome_autore']];
        }
        mysqli_free_result($result);
        return $libroData;
    }


    public function getLibriByIdAutoreRepo($id)
    {
        $query = "SELECT lib.*,
        aut.nome as nome_autore,
        aut.cognome as cognome_autore
        FROM libri lib
        JOIN autori aut on aut.id = lib.id_autore
        WHERE aut.id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $libriData = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $libro = new Libro(
                $row['id'],
                $row['titolo'],
                $row['anno_pubblicazione'],
                $row['id_autore']
            );
            $libriData[] = [$libro, $row['nome_autore'], $row['cognome_autore']];
        }
        mysqli_free_result($result);
        return $libriData;
    }
}

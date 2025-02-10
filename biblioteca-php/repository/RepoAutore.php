<?php
include '../entity/Autore.php';

class RepoAutore{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllRepoAutori(){
        $query = "SELECT * FROM autori";
        $result = mysqli_query($this->conn, $query);
        $arrayAutori = [];

        while($row = mysqli_fetch_assoc($result)){
            $autore = new Autore(
                $row['id'],
                $row['nome'],
                $row['cognome'],
                $row['data_nascita']
            );
            $arrayAutori[] = $autore;
        }
        mysqli_free_result($result);
        return $arrayAutori;
    }
}

?>
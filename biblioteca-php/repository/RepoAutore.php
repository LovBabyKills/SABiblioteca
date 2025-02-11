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

    public function getAutoreById($id){
        $query = "SELECT * FROM autori WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $autore = new Autore(
                $row['id'],
                $row['nome'],
                $row['cognome'],
                $row['data_nascita']
            );
        }
        mysqli_stmt_close($stmt);
        mysqli_free_result($result);
        return $autore;


    }
}

?>
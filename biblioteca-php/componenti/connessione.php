<?php
$host = "maria_container";
$username = "root";
$password = "test";
$dbname = "biblioteca";

try {
    $conn = new mysqli($host, $username, $password, $dbname);

    if($conn->connect_error){
        throw new Exception("connessione fallita" . $conn->connect_error);
    }
    //echo "connesso nice!";
} catch (mysqli_sql_exception $e){
    die("connessione fallita" . $e->getMessage());
}

?>
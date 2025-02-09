<?php
//namespace
class ValidazioneDatiController{
    //creo i metodi statici per poterli chiamare senza istnziare la classe?
    public static function validazioneId($id){
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id == false || $id == null){
            http_response_code(400);
            echo json_encode(['errore' => 'id non valido']);
            exit;
        }
        return $id;
    }

    //risorsa e' quella mandata tramite link tipo api/v1/biblioteca/autori ... autori e' la risorsa
    public static function validazioneRisorsa(){
        $risorseValide = ['utenti', 'libri', 'prestiti', 'autori'];
        $risorsa = isset($_GET['risorsa']) ? $_GET['risorsa'] : null;
        if(in_array($risorsa, $risorseValide)){
            return $risorsa;
        }
        http_response_code(400);
        echo json_encode(['errore' => 'link errato']);
        exit;
    }

    //mi devo passare $input e le regole per l'input
    //le regole me le devo fare in diversi file a seconda dei form
    //poi applico le regole all'input
    public static function validazioneInput($input,){
        
    }

    //validazione stringa
    //validazione int
    //validazione data etc...
}
?>

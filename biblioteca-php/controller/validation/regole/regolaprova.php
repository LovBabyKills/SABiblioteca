<?php
include_once('/var/www/html/controller/validation/RegoleValidazione.php');

function regolaProva(): array{
    //campo - regole - messaggio
    return [
        new RegoleValidazione('nome',
        [
            'tipo' => 'stringa',
            'lunghezzaMassima' => 8
        ],
            'errore in validazione nome' )
        ];
}

//quindi devo passare in 
?>
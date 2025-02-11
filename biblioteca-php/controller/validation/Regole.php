<?php
include_once('/var/www/html/controller/validation/RegoleValidazione.php');


function regolaProva(): array {
    //campo - regole - messaggio
    return [
        new RegoleValidazione('nome',
        [
            'tipo' => 'stringa',
            'lunghezzaMassima' => 5
        ],
            'errore in validazione nome' )
        ];
}

//quindi devo passare in 

function getRegoleLibro(): array {
    return [
        new RegoleValidazione('titolo', [
            'required' => true,
            'tipo' => 'stringa',
            'minLength' => 1,
            'maxLength' => 100
        ], 'Errore nella validazione del titolo'),
        new RegoleValidazione('idAutore', [
            'required' => true,
            'tipo' => 'intero'
        ], 'Errore nella validazione del nome autore'),
        new RegoleValidazione('annoPubblicazione', [
            'required' => true,
            'tipo' => 'intero'
        ], 'Errore nella validazione dell\'anno di pubblicazione')
    ];
}
?>
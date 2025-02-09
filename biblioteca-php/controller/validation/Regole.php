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

function getBookRules(): array {
    return [
        new RegoleValidazione('titolo', [
            'required' => true,
            'type' => 'string',
            'minLength' => 1,
            'maxLength' => 100
        ], 'Errore nella validazione del titolo'),
        new RegoleValidazione('nome_autore', [
            'required' => true,
            'type' => 'string',
            'minLength' => 3,
            'maxLength' => 20
        ], 'Errore nella validazione del nome autore'),
        new RegoleValidazione('anno_pubblicazione', [
            'required' => true,
            'type' => 'integer'
        ], 'Errore nella validazione dell\'anno di pubblicazione')
    ];
}
?>
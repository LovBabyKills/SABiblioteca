<?php
interface GestioneRichiesta{
    public function gestisci(array $input, string $risorsa): void;
}
?>
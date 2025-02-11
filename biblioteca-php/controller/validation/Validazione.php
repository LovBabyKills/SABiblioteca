<?php

class Validazione
{
    private array $errori = [];

    public function valida(array $input, array $regole)
    {
        $this->errori = []; // Per resettare gli errori

        foreach ($regole as $regola) {
            $campo = $regola->getCampo();
            $regolaCampo = $regola->getRegole();

            // Controlla se il campo è presente nell'input
            $valore = $input[$campo] ?? null;

            foreach ($regolaCampo as $nomeRegola => $valoreRegola) {
                switch ($nomeRegola) {
                    case 'required':
                        if (empty($valore) && $valore !== '0') { // Accetta il valore "0" ma non stringhe vuote o null
                            $this->errori[$campo][] = "Il campo $campo è obbligatorio";
                        }
                        break;

                    case 'tipo':
                        if ($valoreRegola == 'stringa' && !is_string($valore)) {
                            $this->errori[$campo][] = "Il campo $campo deve essere una stringa";
                        } elseif ($valoreRegola == 'intero' && !is_int($valore)) {
                            // Usa ctype_digit per validare stringhe numeriche ("123" è valido)
                            $this->errori[$campo][] = "Il campo $campo deve essere un numero intero";
                        }
                        break;

                    case 'maxLength':
                        if (is_string($valore) && strlen($valore) > $valoreRegola) {
                            $this->errori[$campo][] = "Il campo $campo deve avere massimo $valoreRegola caratteri";
                        }
                        break;

                    case 'minLength':
                        if (is_string($valore) && strlen($valore) < $valoreRegola) {
                            $this->errori[$campo][] = "Il campo $campo deve avere minimo $valoreRegola caratteri";
                        }
                        break;

                    default:
                        $this->errori[$campo][] = "Errore sconosciuto nella validazione di $campo";
                        break;
                }
            }
        }

        // Debug 
   //     if (!empty($this->errori)) {
     //       echo "errori";
       //     print_r($this->errori);
        //    echo "errori";
        //}

        return empty($this->errori); // Torna `true` se non ci sono errori, `false` se ci sono
    }

    public function getErrori(): array
    {
        return $this->errori;
    }
}
?>
<?php
class Validazione
{
    private array $errors = [];

    public function valida(array $input, array $regole)
    {
        $this->errors = []; //per resettare gli errori

        foreach ($regole as $regola) {
            $campo = $regola->getCampo();
            $regolaCampo = $regola->getRegole();


            if (isset($input[$campo])) {
                $valore = $input[$campo];

                foreach ($regolaCampo as $nomeRegola => $valoreRegola) {
                    switch ($nomeRegola) {
                        case 'tipo':
                            if ($valoreRegola == 'stringa' && !is_string($valore)) {
                                $this->errors[$campo][] = "il campo $campo deve essere una stringa";
                            } elseif ($valoreRegola == 'intero' && !is_int($valore)) {
                                $this->errors[$campo][] = "il campo $campo deve essere un intero";
                            }
                            break;
                        case 'lunghezzaMassima':
                            if(strlen($valore) > $valoreRegola){
                                $this->errors[$campo][] = "troppo lungo";
                            }
                            break;
                        default :
                            $this->errors[$campo][] = "qualcosa non va";
                            break;
                    }
                }
            }
        }

        return empty($this->errors); //torno vero o falso
    }

    public function getErrors(): array {
        return $this->errors;
    }
}

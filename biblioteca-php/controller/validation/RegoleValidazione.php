<?php
class RegoleValidazione{
    private string $campo;
    private array $regole;
    private string $messaggio;

    public function __construct($campo, $regole, $messaggio){
        $this->campo = $campo;
        $this->regole = $regole;
        $this->messaggio = $messaggio;
    }

    //getter
    public function getCampo(): string {
        return $this->campo;
    }
    public function getRegole(): array {
        return $this->regole;
    }
    public function getMessaggio(): string {
        return $this->messaggio;
    }   

}

?>
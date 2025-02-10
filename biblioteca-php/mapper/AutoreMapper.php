<?php
include_once '../entity/Autore.php';
include_once '../dto/AutoreDTO.php';

class AutoreMapper {
    public function autoreToAutoreDTO(Autore $autore){
        return new AutoreDTO($autore->getNome(), $autore->getCognome(), $autore->getDataNascita());
    }

    public function allAutoreToAutoreDTO(array $listaAutori) {
        $listaAutoriDTO = [];
        foreach($listaAutori as $autore){
            $listaAutoriDTO[] = $this->autoreToAutoreDTO($autore);
        }
        return $listaAutoriDTO;
    }
}


?>
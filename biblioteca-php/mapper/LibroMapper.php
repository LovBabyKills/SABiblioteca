<?php
include_once '../entity/Libro.php';
include_once '../dto/LibroDTO.php';

class LibroMapper{
    public function libroToLibroDTO(array $libroData){
        //array destructuring
        //prende primo elemento dell'array e lo mette nella variabile libro
        //secondo in nomeautore e terzo in cognomeautore
        [$libro, $nomeAutore, $cognomeAutore] = $libroData;
        return new LibroDTO(
            $libro->getTitolo(),
            $libro->getAnnoPubblicazione(),
            $nomeAutore . ' ' . $cognomeAutore
        );
    }

    public function AllLibriToLibriDTO(array $listaLibriData){
        $listaLibriDTO = [];
        foreach($listaLibriData as $libroData){
            $libroDTO = $this->libroToLibroDTO($libroData);
            $listaLibriDTO[] = $libroDTO;
        }
        return $listaLibriDTO;
    }
}
?>
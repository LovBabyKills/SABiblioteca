<?php
include_once '../entity/Prestito.php';
include_once '../dto/PrestitoDto.php';

class PrestitoMapper {
    public function prestitoToPrestitoDTO(array $prestitoData){
        [$prestito, $nomeUtente, $cognomeUtente, $titoloLibro] = $prestitoData;
        return new PrestitoDTO(
            $nomeUtente . ' ' . $cognomeUtente,
            $titoloLibro,
            $prestito->getDataPrestito(),
            $prestito->getDataRestituzione()
        );
    }

    public function allPrestitiToPrestitiDTO(array $listaPrestitiData){
        $listaPrestitiDTO = [];
        foreach($listaPrestitiData as $prestitoData){
            $prestitoDTO = $this->prestitoToPrestitoDTO($prestitoData);
            $listaPrestitiDTO[] = $prestitoDTO;
        }
        return $listaPrestitiDTO;
    }
}

?>
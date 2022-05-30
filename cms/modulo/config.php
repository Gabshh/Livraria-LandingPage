<?php
    /**************************************************************************************
     * Objetivo: Arquivo responsavel pela criação de variaveis e constantes do projeto
     * Dev: Gabriel Gomes
     * Data: 13/05/2022
     * Versão: 1.0
    ****************************************************************************************/

    /******************** VARIÁVEIS E CONSTANTES GLOBAIS DO PROJETO *********************/
    const MAX_FILE_UPLOAD = 5120; // Limitação de 5MB para uploads de imagens
    const EXT_FILE_UPLOAD = array("image/jpg", "image/png", "image/jpeg", "image/gif");
    const DIRETORIO_FILE_UPLOAD = "arquivos/";

    /************************** FUNÇÕES GLOBAIS PARA O PROJETO ***************************/

    //  Função para converter um array em um formato JSON
    function createJSON ($arrayDados) {

        // Validação para tratar array sem dados
        if (!empty($arrayDados)) {
            // configura o padrão da conversão para o formato JSON
            header('Content-Type: application/json');
            $dadosJSON = json_encode($arrayDados);

            //json_encode(); - converte um array para JSON
            //json_decode(); - converte um JSON para array

            return $dadosJSON; 
        } else {
            return false;
        }
    }

?>
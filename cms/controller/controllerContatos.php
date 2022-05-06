<?php
    /*************************************************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de categorias
     * Obs (Este arquivo fará a ponte entre a View e a Model)
     * Dev: Gabriel Gomes
     * Data: 07/04/2022
     * Versão: 2.0
     ************************************************************************************/

    //Função para buscar um contato através do id do registro
    function buscarContato($id) {
        //Validação para verificar se id contém um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {
            
            //Import do arquivo de contato
            require_once('model/bd/contato.php');

            //Chama a função na model que vai buscar no BD
            $dados = selectByIdContato($id);

            //Valida se existem dados para serem devolvidos
            if(!empty($dados)) {
                return $dados;
            }else{
                return false;
            }

        } else {
            return array('idErro' => 4,
                        'message' => 'Não é possível buscar o registro sem informar um id válido.');
        }
    }

    //Função para receber dados da View e encaminhar para a Model (Atualizar)
    function atualizarContato() {
        
    }

    //Função para realizar a exclusão de um contato
    function excluirContato($id) {
        //Validação para verificar se id contém um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

            //Import do arquivo de contato
            require_once('model/bd/model-contatos.php');
            
            //Chama a função da model e valida se o retorno foi verdadeiro ou falso
            if(deleteContato($id)){
                return true;
            }else{
                return array('idErro' => 3,
                            'message' => 'O banco de dados não pode excluir o registro.');
            }
        }else{
            return array('idErro' => 4,
                        'message' => 'Não é possível excluir o registro sem informar um id válido.');
        }
    }

    //Função para solicitar os dados da Model e encamminhar a lista de contatos para a View
    function listarContato() {
        //Import do arquivo que vai buscar os dados
        require_once('./model/bd/model-contatos.php');

        //Chama a função que vai buscar os dados no BD
        $dados = selectAllContatos();

        if(!empty($dados)){
            return $dados;
        }else{
            return false;
        }
    }

?>
<?php 
    /*************************************************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de categorias
     * Obs (Este arquivo fará a ponte entre a View e a Model)
     * Dev: Gabriel Gomes
     * Data: 14/04/2022
     * Versão: 1.0
    ************************************************************************************/

    // Função para receber dados da View e encaminhar para a Model (Inserir)
    function inserirCategoria($dadosContato) {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-categorias.php');

        // Validação para verificar se  o objeto esta vazio
        if(!empty($dadosCategoria)){
            /*
             Validação de caixa vazia do elemento nome,
             pois é obrigatóris no BD
            */
            if(!empty($dadosCategoria['txtNome'])){ 
                /* 
                Criação do array de dados que será encaminhado a model para inserir no BD,
                é importante criar esse array conforme as necessidades de manipulação do BD
                OBS: criar as chaves do array conforme os nomes dos atributos do BD
                */
                $arrayDados = array(
                    "nome"      => $dadosContato['txtNome'],
                    "icone"      => $dadosContato['txtIcone']
                );

                
                //Chama a função que fará o insert no BD (esta função está na model)
                if(insertCategoria($arrayDados))
                    return true;
                else
                    return array('idErro' => 1,
                                'message' => 'Não foi possível inserir os dados no banco de dados.');

            }
            else
                return array('idErro' => 2,
                            'message' => 'Existem campos obrigatórios que não foram preenchidos.');
        }
        

    
    }

    //Função para buscar uma categora através do id do registro
    function buscarCategoria($id) {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-categorias.php');

        //Validação para verificar se id contém um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

            //Chama a função na model que vai buscar no BD
            $dados = selectByIdCategoria($id);

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
    function atualizarCategoria() {
        
    }

    //Função para realizar a exclusão de um contato
    function excluirCategoria($id) {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-categorias.php');

        //Validação para verificar se id contém um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {
            
            //Chama a função da model e valida se o retorno foi verdadeiro ou falso
            if(deleteCategoria($id)){
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

    //Função para solicitar os dados da Model e encamminhar a lista de categorias para a View
    function listarCategoria() {

        //import do arquivo de modelagem para manipular o BD
        require_once('../model/bd/model-categorias.php');

        //Chama a função que vai buscar os dados no BD
        $dados = selectAllCategorias();

        if(!empty($dados)){
            return $dados;
        }else{
            return false;
        }
    }

?>
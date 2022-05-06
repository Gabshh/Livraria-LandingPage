<?php 
    /*************************************************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de usuarios
     * Obs (Este arquivo fará a ponte entre a View e a Model)
     * Dev: Gabriel Gomes
     * Data: 14/04/2022
     * Versão: 1.0
    ************************************************************************************/

    // Função para receber dados da View e encaminhar para a Model (Inserir)
    function inserirUsuario($dadosUsuario) {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-usuarios.php');

        // Validação para verificar se  o objeto esta vazio
        if(!empty($dadosUsuario)){
            /*
             Validação de caixa vazia do elemento nome,
             pois é obrigatóris no BD
            */
            if(!empty($dadosUsuario['txtNome']) && !empty($dadosUsuario['txtEmail'])) { 

                /* 
                Criação do array de dados que será encaminhado a model para inserir no BD,
                é importante criar esse array conforme as necessidades de manipulação do BD
                OBS: criar as chaves do array conforme os nomes dos atributos do BD
                */
                $arrayDados = array(
                    "nome"  => $dadosUsuario['txtNome'],
                    "email" => $dadosUsuario['txtEmail'],
                    "senha" => $dadosUsuario['txtSenha']
                );

                
                //Chama a função que fará o insert no BD (esta função está na model)
                if(insertUsuario($arrayDados))
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
    function buscarUsuario($id) {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-usuarios.php');

        //Validação para verificar se id contém um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

            //Chama a função na model que vai buscar no BD
            $dados = selectByIdUsuario($id);

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
    function atualizarUsuario($dadosUsuario, $id) {
        // Validação para verificar se  o objeto esta vazio
        if(!empty($dadosUsuario)){
            /*
             Validação de caixa vazia dos elementos nome celular e email,
             pois são obrigatórios no BD
            */
            if(!empty($dadosUsuario['txtNome']) && !empty($dadosUsuario['txtEmail'])){ 

                //Validação para garantir que o id seja válido
                if(!empty($id) && $id != 0 && is_numeric($id) ){
                    
                    /* 
                    Criação do array de dados que será encaminhado a model para inserir no BD,
                    é importante criar esse array conforme as necessidades de manipulação do BD
                    OBS: criar as chaves do array conforme os nomes dos atributos do BD
                    */
                    $arrayDados = array(
                        "id"        => $id,
                        "nome"      => $dadosUsuario['txtNome'],
                        "email"     => $dadosUsuario['txtEmail'],
                        "senha"     => $dadosUsuario['txtSenha']
                    );

                    //import do arquivo de modelagem para manipular o BD
                    require_once('model/bd/model-usuarios.php');
                    //Chama a função que fará o update no BD (esta função está na model)
                    if(updateUsuario($arrayDados)) {
                        return true;
                    }else{
                        return array(
                                    'idErro' => 1,
                                    'message' => 'Não foi possível atualizar os dados no banco de dados.'
                                    );
                    }

                }else{
                    return array(
                                'idErro' => 4,
                                'message' => 'Não é possível editar o registro sem informar um id válido.'
                                );
                } 

            } else
                return array('idErro' => 2,
                            'message' => 'Existem campos obrigatórios que não foram preenchidos.');
        }
    }

    //Função para realizar a exclusão de uma usuario
    function excluirUsuario($id) {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-usuarios.php');

        //Validação para verificar se id contém um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {
            
            //Chama a função da model e valida se o retorno foi verdadeiro ou falso
            if(deleteUsuario($id)){
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

    //Função para solicitar os dados da Model e encamminhar a lista de usuarios para a View
    function listarUsuario() {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-usuarios.php');

        //Chama a função que vai buscar os dados no BD
        $dados = selectAllUsuarios();

        if(!empty($dados)){
            return $dados;
        }else{
            return false;
        }
    }

?>
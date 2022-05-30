<?php 
    /*************************************************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de categorias
     * Obs (Este arquivo fará a ponte entre a View e a Model)
     * Dev: Gabriel Gomes
     * Data: 14/04/2022
     * Versão: 1.0
    ************************************************************************************/

    // Função para receber dados da View e encaminhar para a Model (Inserir)
    function inserirCategoria($dadosCategoria) {

        $nomeIcone = (string) null;

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-categorias.php');

        // Validação para verificar se  o objeto esta vazio
        if(!empty($dadosCategoria)){

            // Recebe o objeto imagem que foi encaminhado dentro do array
            $file = $dadosCategoria['file'];

            /*
             Validação de caixa vazia do elemento nome,
             pois é obrigatóris no BD
            */
            if(!empty($dadosCategoria[0]['txtNome'])) { 

                // Validação para identificar se chegou um arquivo para upload
                if ($file['icone']['name'] != null) {

                    // import da função de upload
                    require_once(SRC.'modulo/upload.php');

                    // chama a função de upload
                    $novoIcone = uploadFile($file['icone']);
                    
                    if (is_array($nomeIcone)) {
                        /* Caso aconteça algum erro no processo de upload, 
                        a função irá retornar um array com a possível mensagem de erro. 
                        Esse array será retornado para a router e ela irá exibir a mensagem para o usuário */
                        return $nomeIcone;
                    }

                }

                /* 
                Criação do array de dados que será encaminhado a model para inserir no BD,
                é importante criar esse array conforme as necessidades de manipulação do BD
                OBS: criar as chaves do array conforme os nomes dos atributos do BD
                */
                $arrayDados = array(
                    "nome"  => $dadosCategoria[0]['txtNome'],
                    "icone" => $novoIcone,
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
    function atualizarCategoria($dadosCategoria, $id) {

        $statusUpload = (boolean) false;

        require_once('model/bd/model-categorias.php');

        // Recebe o id enviado pelo arrayDados
        $id = $arrayDados['id'];

        // Recebe a foto enviada pelo arrayDados (Nome da foto que ja existe no BD)
        $icone = $arrayDados['icone'];

        // Recebe o objeto de array referente a nova foto que poderá ser enviada ao servidor
        $file = $arrayDados['file'];

        // Validação para verificar se  o objeto esta vazio
        if(!empty($dadosCategoria)){

            /*
             Validação de caixa vazia dos elementos nome celular e email,
             pois são obrigatórios no BD
            */
            if(!empty($dadosCategoria['txtNome']) && !empty($dadosCategoria['txtIcone'])){ 

                //Validação para garantir que o id seja válido
                if(!empty($id) && $id != 0 && is_numeric($id) ){
                    
                    // Validação para identificar se será enviado ao servidor uma nova foto
                    if($file['icone']['name'] != null) {

                        // import da função de upload
                        require_once('modulo/upload.php');


                        // chama a função de upload para enviar a nova foto ao servidor
                        $novoIcone = uploadFile($file['icone']);
                        $statusUpload = true;

                    } else {
                        //permanece a mesma foto no BD
                        $novoIcone = $icone;
                    }

                    /* 
                    Criação do array de dados que será encaminhado a model para inserir no BD,
                    é importante criar esse array conforme as necessidades de manipulação do BD
                    OBS: criar as chaves do array conforme os nomes dos atributos do BD
                    */
                    $arrayDados = array(
                        "id"        => $id,
                        "nome"      => $dadosCategoria['txtNome'],
                        "icone"     => $novoIcone,
                    );

                    //import do arquivo de modelagem para manipular o BD
                    require_once('model/bd/model-categorias.php');

                    //Chama a função que fará o update no BD (esta função está na model)
                    if(updateCategoria($arrayDados)) {
                        
                        // Validação para verificar se será necessário apagar a foto antiga
                        // está variável foi ativada em true na linha 138 quando realizamos o upload de uma nova foto para o servidor
                        if ($statusUpload) {
                            // apaga a foto antiga da pasta do servidor
                            unlink(DIRETORIO_FILE_UPLOAD.$icone);
                        }
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

    //Função para realizar a exclusão de uma categoria
    function excluirCategoria($arrayDados) {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-categorias.php');

        // Recebe o id do registro que será excluído
        $id = $arrayDados['id'];
        
        // Recebe o nome da foto que será excluída da pasta do servidor
        $icone = $arrayDados['icone'];

        //Validação para verificar se id contém um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {
            
            //Chama a função da model e valida se o retorno foi verdadeiro ou falso
            if(deleteCategoria($id)){
                
                // Validação para caso a foto não exista com o registro
                if ($icone != null) {
                    
                    // unlink() - função para apagar um arquivo de um diretório
                    // Permite apagar a foto fisicamente do diretório no servidor
                    if(unlink(SRC.DIRETORIO_FILE_UPLOAD.$icone)) {
                        return true;
                    }else {    
                        return array('idErro' => 5,
                        'message' => 'O registro do banco de dados foi excluído com sucesso, 
                                    porém a imagem não foi excluída do diretório do servidor.');
                    }
                } else {
                    return true;
                }
                
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
        require_once('./model/bd/model-categorias.php');

        //Chama a função que vai buscar os dados no BD
        $dados = selectAllCategorias();

        if(!empty($dados)){
            return $dados;
        }else{
            return false;
        }
    }

?>
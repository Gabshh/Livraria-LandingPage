<?php 
    /*************************************************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de produtos
     * Obs (Este arquivo fará a ponte entre a View e a Model)
     * Dev: Gabriel Gomes
     * Data: 13/05/2022
     * Versão: 1.0
    ************************************************************************************/

    // Função para receber dados da View e encaminhar para a Model (Inserir)
    function inserirProduto($dadosProduto) {

        $nomeFoto = (string) null;

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-produtos.php');

        // Validação para verificar se  o objeto esta vazio
        if(!empty($dadosProduto)){
            /*
             Validação de caixa vazia do elemento nome,
             pois é obrigatóris no BD
            */
            if(!empty($dadosProduto['txtDescricao']) && !empty($dadosProduto['txtPreco']) !empty($dadosProduto[0]['categoria'])) { 

                //Validação para identificar se chegou um arquivo para upload
                if ($file['fileFoto']['name'] != null)
                {
                    //import da função de upload
                    require_once('modulo/upload.php');
                    
                    //Chama a função de upload
                    $nomeFoto = uploadFile($file['fileFoto']);

                    if(is_array($nomeFoto))
                    {
                        //Caso aconteça algum erro no processo de upload, a função irá retornar
                        //um array com a possivel mensagem de erro. Esse array será retornado para
                        //a router e ela irá exibir a mensagem para o usuário
                        return $novaFoto;
                    }

                }

                /* 
                Criação do array de dados que será encaminhado a model para inserir no BD,
                é importante criar esse array conforme as necessidades de manipulação do BD
                OBS: criar as chaves do array conforme os nomes dos atributos do BD
                */
                $arrayDados = array(
                    "descricao"  => $dadosProduto['txtDescricao'],
                    "destaque"   => $dadosProduto['checkboxDestaque'],
                    "preco"      => $dadosProduto['txtPreco'],
                    "avaliacao"  => $dadosProduto['txtAvaliacao'],
                    "desconto"   => $dadosProduto['txtDesconto'],
                    "sinopse"    => $dadosProduto['txtSinopse'],
                    "foto"       => $novaFoto,
                    "id_categoria"    => $dadosProduto['categoria'],
                );

                
                //Chama a função que fará o insert no BD (esta função está na model)
                if(insertProduto($arrayDados))
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

    //Função para buscar um produto através do id do registro
    function buscarProduto($id) {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-produtos.php');

        //Validação para verificar se id contém um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

            //Chama a função na model que vai buscar no BD
            $dados = selectByIdProduto($id);

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
    function atualizarProduto($dadosProduto, $arrayDados) {

        $statusUpload = (boolean) false;

        //Recebe o id enviado pelo arrayDados
        $id = $arrayDados['id'];

        //Recebe a foto enviada pelo arrayDados (Nome da foto que já existe no BD)
        $foto = $arrayDados['foto'];

        //Recebe o objeto de array referente a nova foto que poderá ser enviada ao servidor
        $file = $arrayDados['file'];

        // Validação para verificar se  o objeto esta vazio
        if(!empty($dadosProduto)){
            /*
             Validação de caixa vazia dos elementos descricao e preco,
             pois são obrigatórios no BD
            */
            if(!empty($dadosProduto['txtDescricao']) && !empty($dadosProduto['txtPreco'])){ 

                //Validação para garantir que o id seja válido
                if(!empty($id) && $id != 0 && is_numeric($id) ){
                    
                    //Validação para identificar se será enviado ao servidor uma nova foto
                    if($file['fileFoto']['name'] != null) {
                        //import da função de upload
                        require_once('modulo/upload.php');
                    
                        //Chama a função de upload para enviar a nova foto ao servidor
                        $novaFoto = uploadFile($file['fileFoto']);
                        $statusUpload = true;
                    } else {
                        //Permance a mesma foto no BD
                        $novaFoto = $foto;
                    }

                    /* 
                    Criação do array de dados que será encaminhado a model para inserir no BD,
                    é importante criar esse array conforme as necessidades de manipulação do BD
                    OBS: criar as chaves do array conforme os nomes dos atributos do BD
                    */
                    $arrayDados = array(
                        "descricao"  => $dadosProduto['txtDescricao'],
                        "destaque"   => $dadosProduto['checkboxDestaque'],
                        "preco"      => $dadosProduto['txtPreco'],
                        "avaliacao"  => $dadosProduto['txtAvaliacao'],
                        "desconto"   => $dadosProduto['txtDesconto'],
                        "sinopse"    => $dadosProduto['txtSinopse'],
                        "id_categoria" => $dadosContato['categoria']
                        "foto"       => $novaFoto
                    );

                    //import do arquivo de modelagem para manipular o BD
                    require_once('model/bd/model-produtos.php');

                    //Chama a função que fará o update no BD (esta função está na model)
                    if(updateProduto($arrayDados)) {

                        //validação para verificar se será necessário apagar a foto antiga
                        //Esta variavel foi ativada em true na linha 105, quando realizamos
                        //o upload de uma nova foto para o servidor 
                        if($statusUpload)
                        {
                            //Apaga a foto antiga da pasta do servidor
                            unlink(DIRETORIO_FILE_UPLOAD.$foto);
                        }
                        return true;

                    }else {
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

    //Função para realizar a exclusão de um produto
    function excluirProduto($arrayDados) {

        //Recebe o id do registro que será excluído
        $id = $arrayDados['id'];

        //Recebe o nome da foto que será excluída da pasta do servidor
        $foto = $arrayDados['foto'];

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-produtos.php');

        //Validação para verificar se id contém um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

            //import do arquivo de configurações do projeto
            require_once('modulo/config.php');
            
            //Chama a função da model e valida se o retorno foi verdadeiro ou falso
            if(deleteProduto($id)){

                //Validação para caso a foto não exista com o registro
                if($foto!=null)
                {
                    //unlink() - função para apagar um arquivo de um diretório
                    //Permite apagar a foto fisicamente do diretório no servidor
                    if(unlink(DIRETORIO_FILE_UPLOAD.$foto))
                        return true;
                    else
                        return array('idErro'   => 5,
                            'message'  => 'O registro do Banco de Dados foi excluído com sucesso, 
                                        porém a imagem não foi excluída do diretório do servidor!'
                            );
                }else {
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

    //Função para solicitar os dados da Model e encamminhar a lista de produtos para a View
    function listarProduto() {

        //import do arquivo de modelagem para manipular o BD
        require_once('./model/bd/model-produtos.php');

        //Chama a função que vai buscar os dados no BD
        $dados = selectAllProdutos();

        if(!empty($dados)){
            return $dados;
        }else{
            return false;
        }

    }

?>
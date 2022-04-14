<?php 

    /*************************************************************************************
     * Objetivo: Arquivo de rota, para segmentar as ações encaminhadas pela View
     *      (dados de um form, listagem de dados, uma ação de excluir ou atualizar)
     *      Esse arquivo será responsável por encaminhar as solicitações para a Controller
     * Dev: Gabriel Gomes
     * Versão: 2.0
     * Data: 01/04/2022
     ************************************************************************************/

    $action = (string) null;
    $component = (string) null;

    //Validação para verificar se a requisição é um POST de um formulário
    if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){

        //Recebendo dados via URL para saber quem esta solicitando e qual ação será 
        //realizada
        $component = strtoupper($_GET['component']);
        $action = strtoupper($_GET['action']);


        //Estrutura condicional para validar quem esta solicitando algo para o Router
        switch($component){
            case 'CONTATOS':
                
                //Import da controller Contatos
                require_once('./controller/controllerContatos.php');

                //Validação para identificar o tipo de ação que será realizado
                if($action == 'DELETAR') {
                    /*Recebe o id do registro que deverpa ser exlcuido, que foi enviado pela url
                     no link da imagem do excluir que foi acionado na index*/
                    $idContato = $_GET["id"];

                    //Chama a função de excluir na controller
                    $resposta = excluirContato($idContato);

                    if (is_bool($resposta) && $resposta) {
                        echo("<script>
                                alert('Registro excluído com sucesso'); 
                                window.location.href = 'pages/contatos.php';
                            </script>");
                    } elseif (is_array($resposta)){
                        echo("<script>
                                    alert('".$resposta['message']."'); 
                                    window.history.back();
                            </script>");
                    }

                }elseif($action == 'BUSCAR') {
                    /*Recebe o id do registro que deverpa ser editado, 
                    que foi enviado pela url no link da imagem do editar
                    que foi acionado no contatos.php*/
                     $idContato = $_GET["id"];

                    //Chama a função de buscar na controller
                     $dados = buscarContato($idContato);

                    //Ativa a utilização de variáveis de sessão no servidor
                     session_start();

                    //Guarda em uma variável de sessão os dados que o BD retornou para a busca do id
                    /*
                    OBS (essa variável de sessão será utilizada na index, 
                    para colocar os dados nas caixas e texto)
                    */
                     $_SESSION['dadosContato'] = $dados;

                    /* Utilizando o header também poderemos chamar a index.php 
                    porém haverá um delay de carregamento no navegador (piscando a tela)
                    
                    header('location: index.php');
                    */

                    /*Utilizando o require iremos apenas importar a tela da index, 
                    assim não havendo um novo carregamento da página*/
                     require_once('index.php');

                }
                break; 
        }

        
    }

?>
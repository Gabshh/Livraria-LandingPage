<?php
    /*************************************************************************************\
     * Objetivo: Arquivo responsável por manipular os dados dentro do BD
     * (update, select e delete)
     * Dev: Gabriel Gomes
     * Data: 13/05/2022
     * Versão: 1.0
     /************************************************************************************/

    //Import do arquivo que estabelece a conexão com o BD
    require_once('conexaoMysql.php');

     //Função para realizar o insert no BD
    function insertProduto($dadosProduto){
        
        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o BD 
        $conexao = conexaoMysql();
        
        //Monta o script para enviar para o BD
        $sql = "insert into tbl_produtos 
                    (
                    descricao,
                    destaque,
                    preco,
                    avaliacao,
                    desconto,
                    sinopse,
                    foto,
                    id_categoria
                    ) 
                values 
                    (
                    '".$dadosProduto['descricao']."',
                    '".$dadosProduto['destaque']."',
                    '".$dadosProduto['preco']."',
                    '".$dadosProduto['avaliacao']."',
                    '".$dadosProduto['desconto']."',
                    '".$dadosProduto['sinopse']."',
                    '".$dadosProduto['foto']."',
                    '".$dadosProduto['id_categoria']."'
                    );";
        
        //echo($sql);

        //Executa o script no BD
        //Validação para verificar se o script sql está correto
        if (mysqli_query($conexao, $sql)) {

            //Validação para verificar se uma linha foi acrescentada no BD
            if(mysqli_affected_rows($conexao)) { 
                $statusResposta = true;
            } 
            
        } 

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);
        
        return $statusResposta;
        
    }

    //Função para buscar um produto no BD através do id do registro
    function selectByIdProduto($id){

        //Abre a conexão com o BD
        $conexao = conexaoMysql();

        //Script para listar todos os dados do BD
        $sql = "select * from tbl_produtos where id_produto = ".$id;
        
        //Executa o script sql no BD e guarda o retorno dos dados, se houver
        $result = mysqli_query($conexao, $sql);

        //Valida se o BD retornou registros
        if($result){

            /* mysqli_fetch_assoc() - permite converter os dados do BD 
            em um array para manipulação no PHP
            Nesta repetição estamos convertendo os dados do BD em um array ($rsDados),
            além de o próprio while conseguir gerenciar a qtde de vezes que deverá ser
            feita a repetição*/

            $arrayDados = null;

            if ($rsDados = mysqli_fetch_assoc($result)) {

                //Cria um array com os dados do BD
                $arrayDados = array(
                    "id"           => $rsDados['id_produto'],
                    "descricao"    => $rsDados['descricao'],
                    "destaque"     => $rsDados['destaque'],
                    "preco"        => $rsDados['preco'],
                    "avaliacao"    => $rsDados['avaliacao'],
                    "desconto"     => $rsDados['desconto'],
                    "sinopse"      => $rsDados['sinopse'],
                    "id_categoria"      => $rsDados['id_categoria'],
                    "foto"         => $rsDados['foto'] 
                );

            }
        }

            //Solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);

            return $arrayDados;
    }

    //Função para realizar o update no BD
    function updateProduto($dadosProduto){

         //Declaração de variável para utilizar no return desta função
         $statusResposta = (boolean) false;

         //Abre a conexão com o BD 
         $conexao = conexaoMysql();
         
         //Monta o script para enviar para o BD
         $sql = "update tbl_produtos set
                     
                     descricao      = '".$dadosProduto['descricao']."',
                     destaque       = '".$dadosProduto['destaque']."',
                     preco          = '".$dadosProduto['preco']."',
                     avaliacao      = '".$dadosProduto['avaliacao']."',
                     desconto       = '".$dadosProduto['desconto']."',
                     sinopse        = '".$dadosProduto['sinopse']."',
                     id_categoria        = '".$dadosProduto['id_categoria']."',
                     foto           = '".$dadosProduto['foto']."'

                     where id_produto = ".$dadosProduto['id'];
                      
         //echo($sql);
 
         //Executa o script no BD
             //Validação para verificar se o script sql está correto
         if (mysqli_query($conexao, $sql)) {
             
             //Validação para verificar se uma linha foi acrescentada no BD
             if(mysqli_affected_rows($conexao)) { 
                 $statusResposta = true;
             }
             
         }
 
         //Solicita o fechamento da conexão com o BD
         fecharConexaoMysql($conexao);
         
         return $statusResposta;
    }

    //Função para excluir no BD
    function deleteProduto($id){

        ////Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o BD
        $conexao = conexaoMysql();

        $sql = "delete from tbl_produtos where id_produto = ".$id;

        //Valida se o script eta correto, sem erro de sintaxe e executa no BD
        if(mysqli_query($conexao, $sql)) {

            //Valida se o BD teve sucesso na execução do script
            if(mysqli_affected_rows($conexao)){
                $statusResposta = true;
            }

        }

        fecharConexaoMysql($conexao);
        return $statusResposta;

    }

    //Função para listar todos os produtos no BD
    function selectAllProdutos(){
        //Abre a conexão com o BD
        $conexao = conexaoMysql();

        //Script para listar todos os dados do BD
        $sql = "select * from tbl_produtos order by id_produto desc";
        
        //Executa o script sql no BD e guarda o retorno dos dados, se houver
        $result = mysqli_query($conexao, $sql);

        //Valida se o BD retornou registros
        if($result){

            /* mysqli_fetch_assoc() - permite converter os dados do BD 
            em um array para manipulação no PHP
            Nesta repetição estamos convertendo os dados do BD em um array ($rsDados),
            além de o próprio while conseguir gerenciar a qtde de vezes que deverá ser
            feita a repetição*/

            $cont = 0;
            $arrayDados = null;

            while($rsDados = mysqli_fetch_assoc($result)) {

                //Cria um array com os dados do BD
                $arrayDados[$cont] = array(
                    "id"         => $rsDados['id_produto'],
                    "descricao"  => $rsDados['descricao'],
                    "destaque"   => $rsDados['destaque'],
                    "preco"      => $rsDados['preco'],
                    "avaliacao"  => $rsDados['avaliacao'],
                    "desconto"   => $rsDados['desconto'],
                    "sinopse"    => $rsDados['sinopse'],
                    "id_categoria"    => $rsDados['id_categoria'],
                    "foto"       => $rsDados['foto']
                );
                $cont++;

            }

            //Solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);

            if(isset($arrayDados)) {
                return $arrayDados;
            }else {
                return false;
            }

        }
    }
?>
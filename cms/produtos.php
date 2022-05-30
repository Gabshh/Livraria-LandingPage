<?php 

    //import do arquivo de configurações do projeto
    require_once('modulo/config.php');

    //Essa variavel foi criada para diferenciar no action do formulário
    //qual ação deveria ser levada para a router (inserir ou editar).
    //Nas condições abaixo, mudamos o action dessa variavel para a ação de
    //editar
    $form = (string) "router.php?component=produtos&action=inserir";
    
    $descricao = (string) null;

    $id_categoria = (int) null;

    //Variavel para carregar o nome da foto do banco de dados
    $foto = (string) null;

    //Valida se a utilização de variáveis de 
    //sessão esta ativa no servidor
    if(session_status())
    {
        //Valida se a variável de sessão dadosProduto 
        //não esta vázia
        if(!empty($_SESSION['dadosProduto']))
        {
            $id         = $_SESSION['dadosProduto']['id'];
            $foto  = $_SESSION['dadosCategoria']['foto'];
            $descricao = $_SESSION['dadosCategoria']['descricao'];
            $destaque = $_SESSION['dadosCategoria']['destaque'];
            $preco = $_SESSION['dadosCategoria']['preco'];
            $avaliacao = $_SESSION['dadosCategoria']['avaliacao'];
            $desconto = $_SESSION['dadosCategoria']['desconto'];
            $sinopse = $_SESSION['dadosCategoria']['sinopse'];
            $id_categoria = $_SESSION['dadosCategoria']['id_categoria'];

            //Mudamos a ação do form para editar o registro no click do botão salvar
            $form = "router.php?component=produtos&action=editar&id=".$id."&foto=".$foto;

            //Destroi uma variavel da memória do servidor 
            unset($_SESSION['dadosProduto']);
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" type="x-icon" href="./img/settingsIcon.svg">

        <link rel="stylesheet" type="text/css" href="./../css/reset.css">
        <link rel="stylesheet" type="text/css" href="./css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="./css/cms-background.css">
        <link rel="stylesheet" type="text/css" href="./css/categorias.css">
        <link rel="stylesheet" type="text/css" href="./css/produtos.css">


        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <title>Produtos - Mybrary</title>
    </head>
    <body>
        <div class="estrelas"></div>
        <div class="efeito-brilho"></div>
        <header> 

            <div class="header-conteudo">

                <div id="cms-vulgo">
                    <h1>CMS <img src="../img/vulgo.svg" alt=""></h1>
                    <h3>Gerenciamento de Conteúdo do Site</h3>
                </div>
                
            </div>

            <div class="imagem-header">
                <a href="dashboard.php">
                    <img src="./img/settingsIcon.svg" alt="">
                </a>
            </div>

        </header>

        <section class="ancoras">

            <!--<div class="ondas-container">
                <div class="transicao-ondas">
                    <div class="onda onda-ancora"></div>
                </div>
            </div>-->

            <div class="conteudo-ancoras">

                <nav>
                    <ul class="ancora-itens">
                        <div class="itens-link">
                            
                            <div class="itens-box">
                                <a href="#">
                                    <div class="icons"><i class='bx bx-cart-add'></i></div>
                                </a>
                                <li>Adm. de Produtos</li>
                            </div>

                            <div class="itens-box">
                                <a href="./categorias.php">
                                    <div class="icons"><i class='bx bx-category-alt'></i></div>
                                </a>
                                <li>Adm. de Categorias</li>
                            </div>

                            <div class="itens-box">
                                <a href="./contatos.php">
                                    <div class="icons"><i class='bx bx-comment-dots'></i></div>
                                </a>
                                <li>Contatos</li>
                            </div>

                            <div class="itens-box">
                                <a href="./usuarios.php">
                                    <div class="icons"><i class='bx bx-user-plus'></i></div>
                                </a>
                                <li>Usuários</li>
                                
                            </div>
                        </div>
                    </ul>

                    <ul class="logout-item">
                        <div class="logout-box">
                            <h3>Bem-vindo, 'Nome Usuário'</h3>
                            <div class="logout">
                                <a href="login.php">
                                    <div class="logout-icons">
                                        <span class="logout-dica">Logout</span>
                                        <img id="logout-icon" src="./img/logout-icon.svg" alt="">
                                        <img id="logout-hover" src="./img/logout-person-icon.svg" alt="">
                                    </div>
                                    <li>Logout</li>
                                </a>
                            </div>
                        </div>
                    </ul>
                </nav>

                <div class="ondas-container">
                    <div class="transicao-ondas">
                        <div class="onda onda1"></div>
                    </div>
                </div>

            </div>

        </section>

        <section class="secao">
            <div class="secao-produtos">
                <div id="cadastro"> 
                    <div id="cadastroTitulo"> 
                        <h1> Cadastro de Produtos </h1>
                        
                    </div>
                    <div id="cadastroInformacoes">
                        <form  action="router.php?component=produtos&action=inserir" name="frmCadastro" method="post" >
                        
                        <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Imagem: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="file" name="fileFoto" accept="image/*">
                                </div>
                            </div>
                        
                        <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Descrição: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="text" name="txtDescricao" value="<?=$descricao?>" placeholder="Adicione uma descrição..." maxlength="100">
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Preço: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input id="preco" type="number" min="0.00" max="10000.00" step="0.01" name="txtPreco" value="<?= isset($preco)?$preco:null ?>">
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Categoria: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                <select name="categoria" id="" required>
                                <option value="">Selecione um item:</option>
                                <?php 

                                    // import da controller de estados
                                    require_once('./controller/controllerCategorias.php');

                                    // chama a função para carregar todos os estados no BD
                                    $listCategorias = listarCategoria();
                                    foreach($listCategorias as $item) {
                                        ?>
                                            <option <?=$id_categoria==$item['id_categoria']?'selected':null?> value="<?=$item['id_categoria']?>"><?=$item['nome']?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Avaliação: </label>
                                </div>

                                <div class="cadastroEntradaDeDados">
                                    <input type="number" min="0" max="5" step="any" name="txtAvaliacao" value="<?= isset($avaliacao)?$avaliacao:null ?>">
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Desconto: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input id="desconto" type="number" min="0" max="100" step="any" name="txtDesconto" value="<?= isset($desconto)?$desconto:null ?>">
                                    <span>%</span>
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Destaque: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="checkbox" id="destaque" name="checkboxDestaque">
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Sinopse: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <textarea name="txtSinopse" cols="50" rows="7"><?= isset($sinopse)?$sinopse:null ?></textarea>
                                </div>
                            </div>
                                            
                            <div class="enviar">
                                    <input type="submit" name="btnEnviar" value="Salvar">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Consulta de Dados -->

                <div id="consultaDeDados">
                    <table id="tblConsulta" >
                        <tr>
                            <td id="tblTitulo" colspan="6">
                                <h1> Consulta de Dados.</h1>
                            </td>
                        </tr>
                        <tr id="tblLinhas">
                            <td class="tblColunas destaque"> Descrição </td>
                            <td class="tblColunas destaque"> Preço </td>
                            <td class="tblColunas destaque"> Avaliação </td>
                            <td class="tblColunas destaque"> Desconto </td>
                            <td class="tblColunas destaque"> Sinopse </td>
                            <td class="tblColunas destaque"> Opções </td>
                        </tr>
                        
                    <?php
                    

                            //Import do arquivo da controller para solicitar a listagem dos dados
                            require_once('./controller/controllerProdutos.php');


                            //Chama a função que vai retornar os dados de produtos
                            $listProduto = listarProduto();

                            //Estrutura de repetição para retirar os dados do array e printar na tela
                            if(!empty($listProduto)) {
                                foreach($listProduto as $item) {

                    ?>

                            <tr id="tblLinhas">
                                <td class="tblColunas registros"><?=$item['descricao']?></td>
                                <td class="tblColunas registros"><?=$item['preco']?></td>
                                <td class="tblColunas registros"><?=$item['avaliacao']?></td>
                                <td class="tblColunas registros"><?=$item['desconto']?></td>
                                <td class="tblColunas registros"><?=$item['sinopse']?></td>
                            
                                <td class="tblColunas registros">
                                    <a href="router.php?component=produtos&action=buscar&id=<?=$item['id']?>">
                                        <img src="./img/edit.png" alt="Editar" title="Editar" class="editar">
                                    </a>

                                    <a onclick="return confirm('Deseja realmente excluir esse item?');" href="router.php?component=produtos&action=deletar&id=<?=$item['id']?>">
                                        <img src="./img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                                    </a>

                                </td>
                            </tr>

                        <?php
                                }
                            }
                        ?>

                    </table>
                </div>
            </div>
        </section>

        <footer>
            
            <div class="vulgo-footer">
                <img src="../img/vulgo.svg" alt="">
            </div>

            <div class="copyright">
                <h3>© Copyright 2022</h3>
                <h3>Todos os direitos reservados - Política de Privacidade</h3>
            </div>
            <div class="versao">
                <span>Desenvolvido por: Gabriel Gomes</span>
                <span>Versão 1.0</span>
            </div>
        </footer>

    </body>
</html>
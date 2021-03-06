<?php 

    $id    = (int) null;
    $nome  = (string) null;
    $email = (string) null;
    $senha = (string) null;

    /*Essa variável foi criada para diferenciar no action do formulário
    qual ação deveria ser levada para a router (inserir ou editar).
    Nas condções abaixo, mudamos o action dessa variável para a ação de editar*/
    $actionForm = (string) "router.php?component=usuarios&action=inserir";

    //Valida se a utilização de variáveis de sessão está ativa no servidor
    if (session_status()) {

        //Valida se a variável de sessão dadosUsuario não está vazia
        if (!empty($_SESSION['dadosUsuario'])) {
            $id    = $_SESSION['dadosUsuario']['id'];
            $nome  = $_SESSION['dadosUsuario']['nome'];
            $email = $_SESSION['dadosUsuario']['email'];
            $senha = $_SESSION['dadosUsuario']['senha'];
        
            /*Mudamos a ação do form para editar o registro no click do botão salvar */
            $actionForm = "router.php?component=usuarios&action=editar&id=".$id;

            //Destrói uma variável da memoria do servidor
            unset($_SESSION['dadosUsuario']);
        
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
        <link rel="stylesheet" type="text/css" href="./css/usuarios.css">

        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <title>Usuários - Mybrary</title>
    </head>
    <body>
        <div class="estrelas"></div>
        <div class="efeito-brilho"></div>
        <header> 

            <div class="header-conteudo">

                <div id="cms-vulgo">
                    <h1>CMS <img src="./../img/vulgo.svg" alt=""></h1>
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
                                <a href="./produtos.php">
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
                                <a href="#">
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
                                <a href="./login.php">
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
            <div class="secao-usuarios">
                <div id="cadastro"> 
                    <div id="cadastroTitulo"> 
                        <h1> Cadastro de Usuários </h1>
                        
                    </div>
                    <div id="cadastroInformacoes">
                        <form  action="<?=$actionForm?>" name="frmCadastro" method="post" >
                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Nome: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Adicione um usuário..." maxlength="100">
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Email: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="text" name="txtEmail" value="<?=$email?>" placeholder="..." maxlength="100">
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Senha: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="text" name="txtSenha" value="<?=$senha?>" placeholder="..." maxlength="100">
                                </div>
                            </div>
                                            
                            <div class="enviar">
                                    <input type="submit" name="btnEnviar" value="Cadastrar">
                            </div>
                        </form>
                    </div>
                </div>

                

                <div id="consultaDeDados">
                    <table id="tblConsulta" >
                        <tr>
                            <td id="tblTitulo" colspan="6">
                                <h1> Consulta de Dados.</h1>
                            </td>
                        </tr>
                        <tr id="tblLinhas">
                            <td class="tblColunas destaque"> Nome </td>
                            <td class="tblColunas destaque"> Email </td>
                            <td class="tblColunas destaque"> Opções </td>
                        </tr>
                        
                    <?php
                    

                            //Import do arquivo da controller para solicitar a listagem dos dados
                            require_once('./controller/controllerUsuarios.php');


                            //Chama a função que vai retornar os dados de usuarios
                            $listUsuario = listarUsuario();

                            //Estrutura de repetição para retirar os dados do array e printar na tela
                            if(!empty($listUsuario)) {
                                foreach($listUsuario as $item) {

                    ?>

                            <tr id="tblLinhas">
                                <td class="tblColunas registros"><?=$item['nome']?></td>
                                <td class="tblColunas registros"><?=$item['email']?></td>
                            
                                <td class="tblColunas registros">
                                    <a href="router.php?component=usuarios&action=buscar&id=<?=$item['id']?>">
                                        <img src="./img/edit.png" alt="Editar" title="Editar" class="editar">
                                    </a>

                                    <a onclick="return confirm('Deseja realmente excluir esse item?');" href="router.php?component=usuarios&action=deletar&id=<?=$item['id']?>">
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
                <img src="./../img/vulgo.svg" alt="">
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
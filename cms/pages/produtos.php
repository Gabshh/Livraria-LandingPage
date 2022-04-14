<?php 

    $nome = (string) null;

    //Valida se a utilização de variáveis de sessão está ativa no servidor
    if (session_status()) {

        //Valida se a variável de sessão dadosContato não está vazia
        if (!empty($_SESSION['dadosContato'])) {
            $id         = $_SESSION['dadosContato']['id'];
            $nome       = $_SESSION['dadosContato']['nome'];
            $telefone   = $_SESSION['dadosContato']['telefone'];
            $celular    = $_SESSION['dadosContato']['celular'];
            $email      = $_SESSION['dadosContato']['email'];
            $obs      = $_SESSION['dadosContato']['obs'];
        }
    }
    

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" type="x-icon" href="../img/settingsIcon.svg">

        <link rel="stylesheet" type="text/css" href="../../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="../css/cms-background.css">
        <link rel="stylesheet" type="text/css" href="../css/categorias.css">
        <link rel="stylesheet" type="text/css" href="../css/produtos.css">


        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <title>Produtos - Mybrary</title>
    </head>
    <body>
        <div class="estrelas"></div>
        <div class="efeito-brilho"></div>
        <header> 

            <div class="header-conteudo">

                <div id="cms-vulgo">
                    <h1>CMS <img src="../../img/vulgo.svg" alt=""></h1>
                    <h3>Gerenciamento de Conteúdo do Site</h3>
                </div>
                
            </div>

            <div class="imagem-header">
                <a href="../pages/dashboard.php">
                    <img src="../img/settingsIcon.svg" alt="">
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
                                <a href="#secao-usuarios">
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
                                <a href="../login.php">
                                    <div class="logout-icons">
                                        <span class="logout-dica">Logout</span>
                                        <img id="logout-icon" src="../img/logout-icon.svg" alt="">
                                        <img id="logout-hover" src="../img/logout-person-icon.svg" alt="">
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
                        <form  action="router.php?component=contatos&action=inserir" name="frmCadastro" method="post" >
                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Descrição: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="text" name="txtNome" value="<?=$nome?>" placeholder="Adicione uma descrição..." maxlength="100">
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Avaliação: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="text" name="txtTelefone" value="<?= isset($telefone)?$telefone:null ?>">
                                </div>
                            </div>

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Preço: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="text" name="txtCelular" value="<?= isset($celular)?$celular:null ?>">
                                </div>
                            </div>
                        

                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Desconto: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <input type="text" name="txtEmail" value="<?= isset($email)?$email:null ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <div class="cadastroInformacoesPessoais">
                                    <label> Observações: </label>
                                </div>
                                <div class="cadastroEntradaDeDados">
                                    <textarea name="txtObs" cols="50" rows="7"><?= isset($obs)?$obs:null ?></textarea>
                                </div>
                            </div>
                                            
                            <div class="enviar">
                                    <input type="submit" name="btnEnviar" value="Salvar">
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
                            <td class="tblColunas destaque"> Descrição </td>
                            <td class="tblColunas destaque"> Preço </td>
                            <td class="tblColunas destaque"> Opções </td>
                        </tr>
                        
                    <?php
                    
                            //Import do arquivo da controller para solicitar a listagem dos dados
                            require_once('controller/controllerContatos.php');
                            //Chama a função que vai retornar os dados de contatos
                            $listContato = listarContato();

                            //Estrutura de repetição para retirar os dados do array e printar na tela
                            foreach($listContato as $item) {

                    ?>

                            <tr id="tblLinhas">
                                <td class="tblColunas registros"><?=$item['nome']?></td>
                                <td class="tblColunas registros"><?=$item['celular']?></td>
                                <td class="tblColunas registros"><?=$item['email']?></td>
                            
                                <td class="tblColunas registros">
                                    <a href="router.php?component=contatos&action=buscar&id=<?=$item['id']?>">
                                        <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                                    </a>

                                    <a onclick="return confirm('Deseja realmente excluir esse item?');" href="router.php?component=contatos&action=deletar&id=<?=$item['id']?>">
                                        <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                                    </a>

                                    <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                                </td>
                            </tr>

                        <?php
                            }
                        ?>

                    </table>
                </div>
            </div>
        </section>

        <footer>
            
            <div class="vulgo-footer">
                <img src="../../img/vulgo.svg" alt="">
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
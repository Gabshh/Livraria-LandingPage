<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="x-icon" href="./img/key-browser-icon.png">

    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link rel="stylesheet" type="text/css" href="./css/login-background.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="./js/senha.js" defer></script>

    <title>Login de Admin - Mybrary</title>
</head>
<body>

    <section id="login-cms">
        <div class="estrelas"></div>
        <div class="efeito-brilho"></div> 

        <div class="login-container">

            <div class="planetas" style="--i:0;">
                <img src="./img/planeta-azu.svg" alt="">
            </div>
            <div class="planetas" style="--i:1;">
                <img src="./img/planeta-vermeio.svg" alt="">
            </div>
            <div class="planetas" style="--i:2;">
                <img src="./img/planeta-pinko.svg" alt="">
            </div>
            <div class="planetas" style="--i:3;">
                <img src="./img/planeta-marelo.svg" alt="">
            </div>

            <div class="ondas-container">
                <section class="transicao-ondas">
                    <div class="onda onda1"></div>
                    <div class="onda onda2"></div>
                </section>
            </div>

            <div class="dados-container">

                <img src="../img/vulgo.svg" alt="">
                <h1>Autenticação para o CMS</h1>

                <div class="dados-box">
                    <form>
                        <div class="input-box">
                            <input type="text" placeholder="Login" name="username" required>  
                            <i class="fa fa-user-circle" aria-hidden="true" id="user-icon"></i>
                        </div>
                        <div class="input-box">
                            <input type="password" placeholder="Senha" name="password" id="senha-input" required>
                            <i class="fa fa-eye" aria-hidden="true" id="olho-icon" onclick="toggle()"></i>
                        </div>
                        <div class="input-box">
                            <input id="login-btn" type="submit" value="Login">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>

    </section>

</body>
</html>
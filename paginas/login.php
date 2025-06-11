<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tela de login</title>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/cadastro.css">
        <link rel="stylesheet" href="/css/login.css">
        <script src="/js/base.js" defer></script>
    </head>

</body>

</html>
    <div id="divprincipal" >
        <div class="bordadiv">
            <form action="/action_page.php" method="get" class="montserrat" >
                
            <div class="inputForm" c>
                    <h1>Login</h1>
                <p><label for="idEmail"></label></p>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail" class="mb"><br>
            </div>
            <div class= "inputForm">

                <label for="idSenha"></label>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" class="mb"><br>

                
                <button type="button" onclick="goTela()">Entrar</button>
            </div>
                
            <p>Não tem uma conta? <a href="/paginas/cadastro.php">Cadastre-se</a></p>

            </form>
        </div>
        <aside>
            <img src="/img/logoMundoDaLua.jpeg" alt="">
        </aside>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tela de login</title>
        <link rel="stylesheet" href="/MundoDaLua/css/style.css">
        <link rel="stylesheet" href="/MundoDaLua/css/cadastro.css">
        <script src="js/base.js" defer></script>

    </head>

</body>

</html>
    <div id="divprincipal" >
        <div class="bordadiv">
            <form action="/action_page.php" method="get" class="montserrat">
                
            <div class="inputForm">
                    <h1>Cadastro</h1>
                <p><label for="idEmail"></label></p>
                <input type="text" name="nome" id="nome" placeholder="Nome completo" class="mb"><br>
            </div>

            <div class= "inputForm">

                <label for="idTelefone"></label>
                <input type="tel" name="telefone" id="telefone" placeholder="Telefone" pattern="(\([0-9]{2}\))\s([0-9]{4})-([0-9]{4})" class="mb"><br>
            </div>

            <div class= "inputForm">

                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="Digite seu E-mail" class="mb"><br>
            </div>


                <div class= "inputForm">

                    <label for="idSenha"></label>
                    <input type="password" name="senha" id="senha" placeholder="Crie uma senha" class="mb"><br>
                </div>

                    <div class= "inputForm">

                        <label for="idConfirmação"></label>
                        <input type="password" name="confirmação" id="confirmação" placeholder="Confirme sua senha" class="mb"><br>
                        
                    
                <button type="button" onclick="goTelaLogin()">Entrar</button>
            </div>
        
                
            </form>
        </div>
        <aside class="bordadiv">
        <img src="/MundoDaLua/img/logoMundoDaLua.jpeg" alt="">
       
        </div>
    </div>

</body>

</html>
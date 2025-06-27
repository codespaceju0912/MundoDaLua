<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tela de login</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/cadastro.css">
        <script src="../js/base.js" defer></script>
        <script src="../js/input_num.js" defer></script>


    </head>

</body>

</html>
    <div id="divprincipal" >
        <div class="bordadiv">
            <form action="cadastro_usuario.php" method="post" class="montserrat">
                
                <div class="inputForm">
                        <h1>Cadastro</h1>
                    <input type="text" name="nome" id="nome" placeholder="Nome completo" class="mb"><br>
                </div>

                <div class= "inputForm">  
                    <input type="tel" name="telefone" id="telefone" placeholder="Telefone"  class="mb"><br>

                    

                </div>

                <div class= "inputForm">  
                    <input type="text" name="cpf" id="cpf" placeholder="CPF"  class="mb"><br>

                                        
                </div>

                <div class= "inputForm">  
                    
                    <input type="text" name="nascimento" id="nascimento" placeholder="Data de nascimento"  class="mb"><br>
                </div>


                <div class= "inputForm">
                    <input type="email" name="email" id="email" placeholder="Digite seu E-mail" class="mb"><br>
                </div>

                <div class= "inputForm">

                        
                <input type="password" name="senha" id="senha" placeholder="Crie uma senha" class="mb"><br>
                </div>

                <div class= "inputForm">

                            
                <input type="password" name="confirmacao" id="confirmação" placeholder="Confirme sua senha" class="mb"><br>

                
                        
                    
                <button type="submit" >Entrar</button>
                </div>
                <script>
                const telInput = document.getElementById('telefone');

                telInput.addEventListener('input', () => {
                    let value = telInput.value.replace(/\D/g, ''); // Remove tudo que não for número

                    if (value.length > 11) value = value.slice(0, 11); // Limita a 11 dígitos

                    // Aplica a máscara: (99) 99999-9999
                    if (value.length > 6) {
                    value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
                    } else if (value.length > 2) {
                    value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
                    } else {
                    value = value.replace(/(\d{0,2})/, '($1');
                    }

                    telInput.value = value;
                });
                </script>
                
                <script>
                const cpfInput = document.getElementById('cpf');

                cpfInput.addEventListener('input', () => {
                    let value = cpfInput.value.replace(/\D/g, ''); // remove tudo que não for dígito

                    if (value.length > 11) value = value.slice(0, 11); // limita a 11 dígitos

                    // aplica a máscara: 000.000.000-00
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

                    cpfInput.value = value;
                });
                </script>

                <script>
                const input = document.getElementById('nascimento');

                input.addEventListener('input', () => {
                    let value = input.value.replace(/\D/g, ''); // remove não números

                    if (value.length > 8) value = value.slice(0, 8);

                    if (value.length >= 5) {
                    value = value.replace(/(\d{2})(\d{2})(\d{1,4})/, '$1/$2/$3');
                    } else if (value.length >= 3) {
                    value = value.replace(/(\d{2})(\d{1,2})/, '$1/$2');
                    }

                    input.value = value;
                });
                </script>
            </form>
        </div>
        <aside class="bordadiv">
        <img src="../img/logoMundoDaLua.jpeg" alt="">
       
        </div>
    </div>

</body>

</html>
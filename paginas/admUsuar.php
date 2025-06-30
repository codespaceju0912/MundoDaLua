<?php
require '../paginas/auth_admin.php';

include("conexao.php");

if(isset($_GET['editar'])) {
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE idUsu = ?");
    $stmt->execute([$_GET['editar']]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($usuario) {
        // Preencherá os campos do formulário automaticamente
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="../css/admUsuar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="../js/base.js" defer></script>
</head>
<body>
<header>
        <section id="bloco_mundoDaLua">
            <h1 id="grafica">Gráfica</h1>
            <h1 id="mundodalua">MUNDO DA LUA</h1>
        </section>
    </header>

    <nav>
        <div class="admin-nav">
            <ul>
                <li><a href="/MundoDaLua/paginas/admVisaoGeral.php">Início</a></li>
                <li><a href="/MundoDaLua/paginas/admProd.php">Produtos</a></li>
                <li><a href="/MundoDaLua/paginas/admUsuar.php">Usuários</a></li>
                <li><a href="/MundoDaLua/paginas/admPedid.php">Pedidos</a></li>
                <li><a href="/MundoDaLua/paginas/logout.php" >Sair</a></li>
            </ul>
        </div>
        
    </nav>

    <main>
        <div id="">
            <h1>Painel de Produtos</h1>

            <?php echo $mensagem; ?>
            
            <section class="form-usu">
                <form id="form-CadUsu" method="POST" action="cadastro_admin.php">
                    <h2><?= isset($_GET['editar']) ? 'Editar Usuário' : 'Cadastrar Novo Usuário' ?></h2>
                    <input type="hidden" name="idUsu" value="<?=isset($_GET['editar']) ? $_GET['editar'] : '' ?>">


                    <div class="form-group">
                        <div>
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" required>
                        </div>
                        
                        <div>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <label for="telefone">Telefone:</label>
                            <input type="tel" id="telefone" name="telefone" required>
                        </div>
                        
                        <div>
                            <label for="cpf">CPF:</label>
                            <input type="text" id="cpf" name="cpf" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <label for="nascimento">Nascimento:</label>
                            <input type="date" id="nascimento" name="nascimento" required>
                        </div>
                        
                        <div>
                            <label for="tipo_usuario">Tipo de Usuário:</label>
                            <select id="tipo_usuario" name="tipo_usuario" required>
                                <option value="usuario">Usuário</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div>
                            <label for="senha">Senha:</label>
                            <input type="password" id="senha" name="senha" <?= !isset($_GET['editar']) ? 'required' : '' ?>>
                        </div>
                        
                        <div>
                            <label for="confirmacao">Confirmar Senha:</label>
                            <input type="password" id="confirmacao" name="confirmacao" <?= !isset($_GET['editar']) ? 'required' : '' ?>>
                        </div>
                    </div>
                    
                    <div class="btn-group">
                        <button type="submit" class="btnCad"><?= isset($_GET['editar']) ? 'Atualizar' : 'Cadastrar' ?></button>
                        <a href="admUsuar.php" class="btnExc">Cancelar</a>
                    </div>
                </form>
            </section>
        </div>

        <section class="list-Usu">
            <h2>Usuários Cadastrados</h2>
            <div id="tabelaUsu">
                <?php include("listar_usuar.php"); ?>
            </div>
        </section>
    </main>

    <!-- Navegação -->
    <script src="../js/nav.js" defer></script>

    <!--js para excluir e cadastrar usuários-->
    <script src="../js/admUsuar.js" defer></script>

    
</body>
</html>
if (window.location.pathname.endsWith('admUsuar.php')) {
    document.addEventListener('DOMContentLoaded', function() {
        const formCadastro = document.getElementById('form-cadUsu');
        const tabelaUsu = document.getElementById('tabelaUsu');
        
        // Se não encontrar os elementos específicos, não continua
        if (!formCadastro || !tabelaUsu) return;
        
        // Restante do seu código de manipulação de usuários...
        formCadastro.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nome = document.getElementById('nomeUsu').value.trim();
            const email = document.getElementById('emailUsu').value.trim();
            const senha = document.getElementById('senha').value.trim();
            
            if (!nome || !email || !senha) {
                alert('Preencha todos os campos!');
                return;
            }
        });
  
        function adicionarUsuario(nome, email, senha) {
        const usuario = {
            id: Date.now(),
            nome,
            email,
            senha,
        };
    
        usuarios.push(usuario);
        atualizarTabela();
        salvarUsuarios();
        }
    
        function atualizarTabela() {
        tabelaUsu.innerHTML = '';
    
        usuarios.forEach((usuario) => {
            const tr = document.createElement('tr');
    
            tr.innerHTML = `
            <td>${usuario.nome}</td>
            <td>${usuario.email}</td>
            <td>
                <button class="btn-excluir" data-id="${usuario.id}">Excluir</button>
            </td>
            `;
    
            tabelaUsu.appendChild(tr);
        });
    
        document.querySelectorAll('.btn-excluir').forEach((btn) => {
            btn.addEventListener('click', function () {
            const id = parseInt(this.getAttribute('data-id'));
            excluirUsuario(id);
            });
        });
        }
    
        function excluirUsuario(id) {
        usuarios = usuarios.filter((usuario) => usuario.id !== id);
        atualizarTabela();
        salvarUsuarios();
        }
    
        function salvarUsuarios() {
        localStorage.setItem('usuarios', JSON.stringify(usuarios));
        }
    
        function carregarUsuarios() {
        const usuariosSalvos = localStorage.getItem('usuarios');
        if (usuariosSalvos) {
            usuarios = JSON.parse(usuariosSalvos);
            atualizarTabela();
        }
        }
    
        const botaoExcluir = document.querySelector('.exc');
        if (botaoExcluir) {
        botaoExcluir.remove();
        }
    });
};
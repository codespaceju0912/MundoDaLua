document.getElementById('form-cadUsu').addEventListener('submit', function(e) {
    e.preventDefault();

    if(document.getElementById('senha').value !== document.getElementById('confirmacao').value) {
        alert('As senhas não coincidem!');
        return;
    }
    
    const formData = new FormData(this);
    
    fetch('../paginas/cadastro_admin.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            alert(data.message);
            // Atualiza a lista de usuários após cadastro
            carregarUsuarios();
            // Limpa o formulário
            this.reset();
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Erro:', error));
});

// Função para carregar usuários 
function carregarUsuarios() {
    fetch('../paginas/listar_usuar.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('.list-Usu').innerHTML = `
                <h2>Usuários Cadastrados</h2>
                ${html}
            `;
            
            // Adiciona os event listeners para os novos botões
            addEventListener();

            // Adiciona responsividade para mobile
            configurarResponsividade();
        })
        .catch(error => console.error('Erro', error))
}

// Função para adicionar event listeners aos botões
function adicionarEventListeners() {
    document.querySelectorAll('.btn-excluir').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if(!confirm('Tem certeza que deseja excluir este usuário?')) {
                e.preventDefault();
            }
        });
    });
}

// Função para configurar responsividade
function configurarResponsividade() {
    // Adiciona labels para as células em mobile
    if (window.innerWidth < 992) {
        const cells = document.querySelectorAll('.table td');
        const headers = document.querySelectorAll('.table th');

        cells.forEach((cell, index) => {
            const headerIndex = index % headers.length;
            if (headers[headerIndex]) {
                cell.setAttribute('data-label', headers[headerIndex].textContent);
            }
        });
    }
}

// Carrega os usuários quando a página é aberta
document.addEventListener('DOMContentLoaded', function() {
    carregarUsuarios();

    // Configura o redimensionamento da janela para mobile
    window.addEventListener('resize', configurarResponsividade);
}); 
    
// Função para abrir modal de edição

function abrirModalEdicao(idUsuario){
    
}
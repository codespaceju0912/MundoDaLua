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
    
document.addEventListener('DOMContentLoaded', function() {
    // Busca em tempo real
    const buscaInput = document.getElementById('buscaUsuario');
    if (buscaInput) {
        buscaInput.addEventListener('input', function() {
            const termo = this.value.trim();
            fetch(`listar_usuar.php?busca=${encodeURIComponent(termo)}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tabelaUsu').innerHTML = html;
                });
        });
    }

    // Formatação automática de CPF e Telefone
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');

    if (cpfInput) {
        cpfInput.addEventListener('input', function() {
            this.value = formatarCPF(this.value);
        });
    }

    if (telefoneInput) {
        telefoneInput.addEventListener('input', function() {
            this.value = formatarTelefone(this.value);
        });
    }
});

function formatarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    if (cpf.length > 11) cpf = cpf.substring(0, 11);
    
    if (cpf.length > 9) {
        cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    } else if (cpf.length > 6) {
        cpf = cpf.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
    } else if (cpf.length > 3) {
        cpf = cpf.replace(/(\d{3})(\d{1,3})/, '$1.$2');
    }
    
    return cpf;
}

function formatarTelefone(telefone) {
    telefone = telefone.replace(/\D/g, '');
    if (telefone.length > 11) telefone = telefone.substring(0, 11);
    
    if (telefone.length > 10) {
        telefone = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    } else if (telefone.length > 6) {
        telefone = telefone.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
    } else if (telefone.length > 2) {
        telefone = telefone.replace(/(\d{2})(\d{0,5})/, '($1) $2');
    }
    
    return telefone;
}
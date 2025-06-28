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

// Função para carregar usuários (já existente no seu código)
function carregarUsuarios() {
    fetch('../paginas/listar_usuarios.php')
        .then(response => response.json())
        .then(data => {
            const tabela = document.getElementById('tabelaUsu');
            tabela.innerHTML = '';
            data.forEach(usuario => {
                tabela.innerHTML += `
                    <tr>
                        <td>${usuario.nomUsu}</td>
                        <td>${usuario.dscEmailUsu}</td>
                        <td>
                            <button class="editar" data-id="${usuario.id}">Editar</button>
                            <button class="excluir" data-id="${usuario.id}">Excluir</button>
                        </td>
                    </tr>
                `;
            });
        });
}

// Carrega os usuários quando a página é aberta
document.addEventListener('DOMContentLoaded', carregarUsuarios);
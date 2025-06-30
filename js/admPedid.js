document.addEventListener('DOMContentLoaded', function() {
    const modalEditar = new bootstrap.Modal(document.getElementById('modalEditarPedido'));
    
    // Botões de edição
    document.querySelectorAll('.btn-editar').forEach(btn => {
        btn.addEventListener('click', function() {
            const idPedido = this.getAttribute('data-id');
            carregarDadosPedido(idPedido);
        });
    });

    // Carrega os dados do pedido
    async function carregarDadosPedido(idPedido) {
        try {
            const response = await fetch(`buscar_pedido.php?id=${idPedido}`);
            const pedido = await response.json();
            
            document.getElementById('pedidoId').textContent = idPedido;
            document.getElementById('pedidoIdHidden').value = idPedido;
            document.getElementById('pedidoStatus').value = pedido.dscStatusPedido;
            document.getElementById('pedidoQuantidade').value = pedido.qtdProdt;
            
            modalEditar.show();
        } catch (error) {
            console.error('Erro ao carregar pedido:', error);
            alert('Erro ao carregar dados do pedido');
        }
    }

    // Salva as alterações
    document.getElementById('btnSalvarPedido').addEventListener('click', async function() {
        const formData = new FormData(document.getElementById('formEditarPedido'));
        
        try {
            const response = await fetch('atualizar_pedido.php', {
                method: 'POST',
                body: formData
            });
            
            const resultado = await response.json();
            
            if (resultado.success) {
                alert('Pedido atualizado com sucesso!');
                modalEditar.hide();
                location.reload(); // Recarrega a página para ver as alterações
            } else {
                alert('Erro ao atualizar: ' + resultado.message);
            }
        } catch (error) {
            console.error('Erro ao salvar:', error);
            alert('Erro ao salvar alterações');
        }
    });
    
    // Filtro de status
    document.getElementById('filtroStatus').addEventListener('change', function() {
        const status = this.value;
        const rows = document.querySelectorAll('#tabelaPedidos tbody tr');
        
        rows.forEach(row => {
            const rowStatus = row.querySelector('td:nth-child(5)').textContent.trim();
            if (status === '' || rowStatus === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Busca por cliente/produto
    document.getElementById('buscarPedido').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tabelaPedidos tbody tr');
        
        rows.forEach(row => {
            const cliente = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const produto = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            
            if (cliente.includes(searchTerm) || produto.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Botões de edição
    document.querySelectorAll('.btn-editar').forEach(btn => {
        btn.addEventListener('click', function() {
            const idPedido = this.getAttribute('data-id');
            // Aqui você pode implementar a lógica para editar o pedido
            // Exemplo: abrir um modal com Bootstrap
            alert(`Editar pedido ID: ${idPedido}`);
            
            // Para implementar um modal real:
            // 1. Crie um modal no HTML
            // 2. Faça uma requisição AJAX para buscar os dados do pedido
            // 3. Preencha o modal com os dados
            // 4. Mostre o modal: new bootstrap.Modal(document.getElementById('modalEditar')).show();
        });
    });
});
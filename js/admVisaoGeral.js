document.addEventListener("DOMContentLoaded", () => {

    // Atualizar números (exemplo)
    document.getElementById("totalUsuarios").textContent = 15;
    document.getElementById("totalProdutos").textContent = 42;
    document.getElementById("totalPedidos").textContent = 27;


    // Gráfico de Vendas (Barra)
    const ctxVendas = document.getElementById('graficoVendas').getContext('2d');
    const graficoVendas = new Chart(ctxVendas, {
        type: 'bar',
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            datasets: [{
                label: 'Vendas (R$)',
                data: [1200, 1900, 3000, 5000, 2200, 3400],
                backgroundColor: '#8a2be2'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfico de Produtos mais vendidos (pizza)
    const ctxProdutos = document.getElementById('graficoProdutos').getContext('2d');
    const graficoProdutos  = new Chart(ctxProdutos, {
        type: 'pie',
        data: {
            labels: ['Marca Página', 'Quadro MDF', 'Caixinhas Personalizadas', 'Fotos Impressas'],
            datasets: [{
                data: [10, 15, 5, 20],
                backgroundColor: [
                    '#8a2be2',
                    '#ff6384',
                    '#36a2eb',
                    '#ffce56'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });
});
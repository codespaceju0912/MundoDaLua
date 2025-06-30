document.addEventListener("DOMContentLoaded", () => {

    // Preenche os cards com dados reais
    document.getElementById("totalUsuarios").textContent = dadosDashboard.totalUsuarios;
    document.getElementById("totalProdutos").textContent = dadosDashboard.totalProdutos;
    document.getElementById("totalPedidos").textContent = dadosDashboard.totalPedidos;



    // Prepara dados para gráfico de vendas mensais
    const meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    const dadosVendas = Array(12).fill(0);
    
    dadosDashboard.vendasMensais.forEach(venda => {
        dadosVendas[venda.mes - 1] = venda.total || 0;
    });

    // Gráfico de Vendas (Barra)
    const ctxVendas = document.getElementById('graficoVendas').getContext('2d');
    new Chart(ctxVendas, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Vendas (R$)',
                data: dadosVendas,
                backgroundColor: '#8a2be2'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    title: { display: true, text: 'Valor (R$)' }
                },
                x: {
                    title: { display: true, text: 'Meses' }
                }
            }
        }
    });

    // Gráfico de Produtos mais vendidos (pizza)
    const ctxProdutos = document.getElementById('graficoProdutos').getContext('2d');
    new Chart(ctxProdutos, {
        type: 'doughnut', // Alterado para rosca para melhor visualização
        data: {
            labels: dadosDashboard.produtosMaisVendidos.map(p => p.nomeProduto),
            datasets: [{
                data: dadosDashboard.produtosMaisVendidos.map(p => p.total_vendido),
                backgroundColor: [
                    '#8a2be2', '#6c1fb8', '#bfff00', '#e28a2b', '#1379bd'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { 
                    position: 'right',
                    labels: {
                        font: { size: 14 }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} unidades`;
                        }
                    }
                }
            }
        }
    });

    // Atualizar os dados periodicamente
    setInterval(() => {
        location.reload();
    }, 300000);

    // Adicione verificação para quando não houver dados
    if (dadosDashboard.vendasMensais.length === 0) {
        document.getElementById('graficoVendas').innerHTML = '<p>Nenhuma venda registrada este ano.</p>';
    }
});
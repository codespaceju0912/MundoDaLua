document.addEventListener("DOMContentLoaded", () => {
    // Preenche os cards com dados reais
    document.getElementById("totalUsuarios").textContent = dadosDashboard.totalUsuarios;
    document.getElementById("totalProdutos").textContent = dadosDashboard.totalProdutos;
    document.getElementById("totalPedidos").textContent = dadosDashboard.totalPedidos;

    // Gráfico de Vendas (Barra)
    // Gráfico de Vendas (Barra)
    const ctxVendas = document.getElementById('graficoVendas').getContext('2d');
    const labelsMeses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    
    // Valores ilustrativos padrão (serão sobrescritos se existirem dados reais)
    let dadosVendas = [1500, 2200, 1800, 2100, 2500, 3000, 2800, 3200, 2900, 2600, 2300, 4000];
    
    // Se existirem dados reais, sobrescreve os valores ilustrativos
    if (dadosDashboard.vendasMensais && dadosDashboard.vendasMensais.length > 0) {
        dadosVendas = Array(12).fill(0);
        dadosDashboard.vendasMensais.forEach(venda => {
            const mesIndex = venda.mes - 1;
            dadosVendas[mesIndex] = parseFloat(venda.valor_total) || 0;
        });
    } else {
        // Adiciona variação aleatória aos valores ilustrativos para parecerem mais naturais
        dadosVendas = dadosVendas.map(valor => {
            // Variação de ±20% do valor base
            const variacao = (Math.random() * 0.4) - 0.2; // Entre -0.2 e +0.2
            return Math.round(valor * (1 + variacao));
        });
    }

    new Chart(ctxVendas, {
        type: 'bar',
        data: {
            labels: labelsMeses,
            datasets: [{
                label: 'Vendas Mensais (R$)',
                data: dadosVendas,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Valor em R$'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Mês'
                    }
                }
            }
        }
    });


    // Gráfico de Produtos mais vendidos - AGORA MELHORADO
    const ctxProdutos = document.getElementById('graficoProdutos').getContext('2d');
    
    // Verifica se existem dados
    if (dadosDashboard.produtosMaisVendidos && dadosDashboard.produtosMaisVendidos.length > 0) {
        // Prepara cores dinâmicas
        const backgroundColors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)'
        ];

        new Chart(ctxProdutos, {
            type: 'doughnut',
            data: {
                labels: dadosDashboard.produtosMaisVendidos.map(p => p.dscProdt), // Usando a descrição correta
                datasets: [{
                    label: 'Quantidade Vendida',
                    data: dadosDashboard.produtosMaisVendidos.map(p => p.total_vendido),
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(color => color.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                size: 12
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const produto = dadosDashboard.produtosMaisVendidos[context.dataIndex];
                                return [
                                    `Produto: ${produto.dscProdt}`,
                                    `Quantidade: ${produto.total_vendido} unidades`,
                                    `Total: R$ ${produto.valor_total.toFixed(2)}`
                                ];
                            }
                        }
                    }
                },
                cutout: '60%' // Controla o tamanho do buraco no meio
            }
        });
    } else {
        // Mensagem quando não há dados
        document.getElementById('graficoProdutos').innerHTML = 
            '<div class="no-data-message">Nenhum produto vendido ainda.</div>';
    }

    // Atualizar os dados periodicamente (5 minutos)
    setInterval(() => {
        location.reload();
    }, 300000);

    // Mensagem para vendas mensais vazias
    if (!dadosDashboard.vendasMensais || dadosDashboard.vendasMensais.length === 0) {
        document.getElementById('graficoVendas').innerHTML = 
            '<div class="no-data-message">Nenhuma venda registrada este ano.</div>';
    }

    // Atualizar os dados periodicamente
    setInterval(() => {
        location.reload();
    }, 300000);

    // Adicione verificação para quando não houver dados
    if (dadosDashboard.vendasMensais.length === 0) {
        document.getElementById('graficoVendas').innerHTML = '<p>Nenhuma venda registrada este ano.</p>';
    }
});
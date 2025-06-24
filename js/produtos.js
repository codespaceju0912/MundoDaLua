function buscarProduto(nome){
    fetch('buscarProduto.php?nome=${encodeURIComponent(nome)}')
        .then(Response => Response.json())
        .then(produto => {
            const container = document.getElementById("listaProdutos");
            container.innerHTML = "";

            produto.forEach(prod => {
                const div = document.createElement("div");
                div.classListadd("prod-item");
                div.innerHTML = `
                <img src="${prod.urlImagemProdt}" alt="${prod.dscProdt}">
                <div class="prod-info">
                    <h4>${prod.dscProdt}</h4>
                    <p>${prod.dscDetailProdt}</p>
                    <p><strong>R$ ${parseFloat(prod.valProdt).toFixed(2)}</strong></p>
                </div>
                `;
                container.appendChild(div);
                
            });
        })
}
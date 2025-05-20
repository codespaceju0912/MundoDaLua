// adicionar e exibir os produtos na parte de produtos cadastrados

/*document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-prod");
    const lista = document.getElementById("listaProdutos");
    const botaoCadastrar = document.querySelector('input[name="botCad"]');
  
    botaoCadastrar.addEventListener("click", () => {
      const nome = document.getElementById("nomeProd").value;
      const preco = document.querySelector('input[name="precoProd"]').value;
      const descricao = document.getElementById("dscProd").value;
      const imagemInput = document.getElementById("imgProd");
      const categoria = form.categoria.value;
  
      if (!nome || !preco || !descricao || !categoria) {
        alert("Preencha todos os campos obrigatórios!");
        return;
      }
  
      const imagemURL = imagemInput.files[0]
        ? URL.createObjectURL(imagemInput.files[0])
        : "/img/placeholder.png"; // caso não tenha imagem
  
      const novoProduto = document.createElement("div");
      novoProduto.innerHTML = `
        <img src="${imagemURL}" alt="${nome}">
        <div>
          <h4>${nome}</h4>
          <p>${descricao}</p>
          <p><strong>R$ ${parseFloat(preco).toFixed(2)}</strong></p>
          <button class="edit">Editar</button>
          <button class="exc">Excluir</button>
        </div>
      `;
      novoProduto.classList.add("produto-item");
  
      lista.appendChild(novoProduto);
  
      // Limpar formulário após cadastro
      form.reset();
    });
  });*/

  document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const form = document.getElementById('formProduto');
    const produtosContainer = document.getElementById('produtosContainer');
    const btnCadastrar = document.getElementById('btnCadastrar');
    const btnAlterar = document.getElementById('btnAlterar');
    const btnExcluir = document.getElementById('btnExcluir');
    
    // Variáveis de estado
    let produtos = [];
    let produtoEditando = null;
    
    // Carregar produtos ao iniciar
    carregarProdutos();
    
    // Eventos
    btnCadastrar.addEventListener('click', cadastrarProduto);
    btnAlterar.addEventListener('click', alterarProduto);
    btnExcluir.addEventListener('click', excluirProduto);
    
    // Funções
    function carregarProdutos() {
        const produtosSalvos = localStorage.getItem('produtos');
        if (produtosSalvos) {
            produtos = JSON.parse(produtosSalvos);
            exibirProdutos();
        }
    }
    
    function salvarProdutos() {
        localStorage.setItem('produtos', JSON.stringify(produtos));
    }
    
    function cadastrarProduto() {
        if (!validarFormulario()) return;
        
        const produto = {
            id: Date.now(),
            nome: document.getElementById('nomeProd').value,
            preco: parseFloat(document.getElementById('precoProd').value).toFixed(2),
            descricao: document.getElementById('descricaoProd').value,
            categoria: document.getElementById('categoriaProd').value,
            estoque: document.getElementById('estoqueProd').value,
            imagem: obterImagem()
        };
        
        produtos.push(produto);
        salvarProdutos();
        exibirProdutos();
        form.reset();
    }
    
    function alterarProduto() {
        if (!produtoEditando) return;
        if (!validarFormulario()) return;
        
        const produtoIndex = produtos.findIndex(p => p.id === produtoEditando);
        
        produtos[produtoIndex] = {
            id: produtoEditando,
            nome: document.getElementById('nomeProd').value,
            preco: parseFloat(document.getElementById('precoProd').value).toFixed(2),
            descricao: document.getElementById('descricaoProd').value,
            categoria: document.getElementById('categoriaProd').value,
            estoque: document.getElementById('estoqueProd').value,
            imagem: document.getElementById('imagemProd').files.length > 0 ? 
                   obterImagem() : 
                   produtos[produtoIndex].imagem
        };
        
        salvarProdutos();
        exibirProdutos();
        cancelarEdicao();
    }
    
    function excluirProduto() {
        if (!produtoEditando) return;
        
        if (confirm('Tem certeza que deseja excluir este produto?')) {
            produtos = produtos.filter(p => p.id !== produtoEditando);
            salvarProdutos();
            exibirProdutos();
            cancelarEdicao();
        }
    }
    
    function exibirProdutos() {
        produtosContainer.innerHTML = '';
        
        if (produtos.length === 0) {
            produtosContainer.innerHTML = '<p>Nenhum produto cadastrado.</p>';
            return;
        }
        
        produtos.forEach(produto => {
            const produtoElement = document.createElement('div');
            produtoElement.className = 'produto-item';
            produtoElement.dataset.id = produto.id;
            
            produtoElement.innerHTML = `
                <img src="${produto.imagem || 'https://via.placeholder.com/150'}" alt="${produto.nome}">
                <div class="produto-info">
                    <h3>${produto.nome}</h3>
                    <p>${produto.descricao}</p>
                    <p><strong>Preço: R$ ${produto.preco}</strong></p>
                    <p>Categoria: ${produto.categoria}</p>
                    <p>Estoque: ${produto.estoque} unidades</p>
                    <div class="produto-acoes">
                        <button class="btn-editar" data-id="${produto.id}">Editar</button>
                        <button class="btn-excluir" data-id="${produto.id}">Excluir</button>
                    </div>
                </div>
            `;
            
            produtosContainer.appendChild(produtoElement);
        });
        
        // Adicionar eventos aos botões de editar e excluir
        document.querySelectorAll('.btn-editar').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.dataset.id);
                iniciarEdicao(id);
            });
        });
        
        document.querySelectorAll('.btn-excluir').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.dataset.id);
                if (confirm('Tem certeza que deseja excluir este produto?')) {
                    produtos = produtos.filter(p => p.id !== id);
                    salvarProdutos();
                    exibirProdutos();
                    
                    // Se estava editando o produto excluído, cancela a edição
                    if (produtoEditando === id) {
                        cancelarEdicao();
                    }
                }
            });
        });
    }
    
    function iniciarEdicao(id) {
        const produto = produtos.find(p => p.id === id);
        if (!produto) return;
        
        document.getElementById('nomeProd').value = produto.nome;
        document.getElementById('precoProd').value = produto.preco;
        document.getElementById('descricaoProd').value = produto.descricao;
        document.getElementById('categoriaProd').value = produto.categoria;
        document.getElementById('estoqueProd').value = produto.estoque;
        
        produtoEditando = id;
        btnCadastrar.style.display = 'none';
        btnAlterar.style.display = 'inline-block';
        btnExcluir.style.display = 'inline-block';
    }
    
    function cancelarEdicao() {
        form.reset();
        produtoEditando = null;
        btnCadastrar.style.display = 'inline-block';
        btnAlterar.style.display = 'none';
        btnExcluir.style.display = 'none';
    }
    
    function validarFormulario() {
        const nome = document.getElementById('nomeProd').value.trim();
        const preco = document.getElementById('precoProd').value;
        const categoria = document.getElementById('categoriaProd').value;
        
        if (!nome || !preco || isNaN(preco) || !categoria) {
            alert('Preencha todos os campos corretamente!');
            return false;
        }
        
        return true;
    }
    
    function obterImagem() {
        const inputImagem = document.getElementById('imagemProd');
        if (inputImagem.files && inputImagem.files[0]) {
            return URL.createObjectURL(inputImagem.files[0]);
        }
        return 'https://via.placeholder.com/150';
    }
});
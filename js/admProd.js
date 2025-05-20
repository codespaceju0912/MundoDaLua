// adicionar e exibir os produtos na parte de produtos cadastrados

document.addEventListener("DOMContentLoaded", () => {
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
  });
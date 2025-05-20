//cadastrar e excluir usuarios

/*document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formUsuario");
    const nomeInput = document.getElementById("nomeUsuario");
    const emailInput = document.getElementById("emailUsuario");
    const tabela = document.getElementById("tabelaUsuarios");
  
    form.addEventListener("submit", function (e) {
      e.preventDefault();
  
      const nome = nomeInput.value.trim();
      const email = emailInput.value.trim();
  
      if (nome === "" || email === "") {
        alert("Preencha todos os campos.");
        return;
      }
  
      const linha = document.createElement("tr");
  
      linha.innerHTML = `
        <td>${nome}</td>
        <td>${email}</td>
        <td><button class="btn-excluir">Excluir</button></td>
      `;
  
      tabela.appendChild(linha);
  
      // Limpa os campos
      nomeInput.value = "";
      emailInput.value = "";
  
      // Adiciona o evento de excluir
      linha.querySelector(".btn-excluir").addEventListener("click", () => {
        const confirmar = confirm("Deseja realmente excluir este usuário?");
        if (confirmar) {
          linha.remove();
        }
      });
    });
  });
*/

document.addEventListener('DOMContentLoaded', function() {
  // Array para armazenar usuários
  let usuarios = [];
  
  // Elementos do DOM
  const formCadastro = document.getElementById('form-cadUsu');
  const tabelaUsu = document.getElementById('tabelaUsu');
  
  // Carregar usuários salvos (se houver)
  carregarUsuarios();
  
  // Evento de submit do formulário
  formCadastro.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const nome = document.getElementById('nomeUsu').value;
      const email = document.getElementById('emailUsu').value;
      const senha = document.getElementById('senha').value;
      
      // Validar campos
      if (!nome || !email || !senha) {
          alert('Preencha todos os campos!');
          return;
      }
      
      // Adicionar usuário
      adicionarUsuario(nome, email, senha);
      
      // Limpar formulário
      formCadastro.reset();
  });
  
  // Função para adicionar usuário
  function adicionarUsuario(nome, email, senha) {
      const usuario = {
          id: Date.now(), // ID único baseado no timestamp
          nome,
          email,
          senha
      };
      
      usuarios.push(usuario);
      atualizarTabela();
      salvarUsuarios();
  }
  
  // Função para atualizar a tabela
  function atualizarTabela() {
      tabelaUsu.innerHTML = '';
      
      usuarios.forEach(usuario => {
          const tr = document.createElement('tr');
          
          tr.innerHTML = `
              <td>${usuario.nome}</td>
              <td>${usuario.email}</td>
              <td>
                  <button class="btn-excluir" data-id="${usuario.id}">Excluir</button>
              </td>
          `;
          
          tabelaUsu.appendChild(tr);
      });
      
      // Adicionar eventos aos botões de excluir
      document.querySelectorAll('.btn-excluir').forEach(btn => {
          btn.addEventListener('click', function() {
              const id = parseInt(this.getAttribute('data-id'));
              excluirUsuario(id);
          });
      });
  }
  
  // Função para excluir usuário
  function excluirUsuario(id) {
      usuarios = usuarios.filter(usuario => usuario.id !== id);
      atualizarTabela();
      salvarUsuarios();
  }
  
  // Salvar usuários no localStorage
  function salvarUsuarios() {
      localStorage.setItem('usuarios', JSON.stringify(usuarios));
  }
  
  // Carregar usuários do localStorage
  function carregarUsuarios() {
      const usuariosSalvos = localStorage.getItem('usuarios');
      if (usuariosSalvos) {
          usuarios = JSON.parse(usuariosSalvos);
          atualizarTabela();
      }
  }
  
  // Remover o botão Excluir do formulário (opcional)
  document.querySelector('.exc').remove();
});
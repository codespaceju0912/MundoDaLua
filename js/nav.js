document.addEventListener('DOMContentLoaded', function() {
    // Seleciona apenas os links de navegação do menu administrativo
    const navLinks = document.querySelectorAll('nav.admin-nav a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Verifica se é o mesmo link da página atual
            if (this.href === window.location.href) {
                e.preventDefault();
                return;
            }
            
            // Adiciona tratamento especial para links de administração
            if (this.getAttribute('href').includes('adm')) {
                // Garante que o evento não propague para outros listeners
                e.stopImmediatePropagation();
                
                // Opcional: adicionar classe ativa ao link clicado
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            }
        });
    }, true); // Usando capture phase para maior prioridade
});
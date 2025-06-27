document.addEventListener('DOMContentLoaded', function() {
    // Previne comportamentos padrão de links
    document.querySelectorAll('nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            // Verifica se o link é para a mesma página
            if (this.href === window.location.href) {
                e.preventDefault();
            }
        });
    });
});
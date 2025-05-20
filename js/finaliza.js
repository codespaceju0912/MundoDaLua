function goTelaPg(){
    window.location.href = '/paginas/opcaopg.html';
}
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.preco-btn').addEventListener('click', function () {
        const escolhaMontag = document.getElementsByName('escolha');
        let escolha = '';

        escolhaMontag.forEach(method => {
            if (method.checked) {
                escolha = method.value;
            }
        });

        if (escolha === 'sMontagem') {
        } else if (escolha === 'cMontagem') {
            window.location.href = '/paginas/pagamentoLocal.html';
        } else {
            alert('Por favor, selecione se quer com montagem ou não');
        }
    });
});


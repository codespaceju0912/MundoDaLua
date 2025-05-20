document.addEventListener('DOMContentLoaded', function () {
//chama classe .submit-btn e ao se clicada
document.querySelector('.submit-btn').addEventListener('click', function () {
        const paymentMethods = document.getElementsByName('payment');
        let selectedPayment = '';
            //verifica se o radio foi acessado
        paymentMethods.forEach(method => {
            if (method.checked) {
                selectedPayment = method.value;
            }
        });
        //envia pra tela que foi a opção de pagamento escolhido
        if (selectedPayment === 'pix') {
            window.location.href = '/paginas/pagamentoPix.html';
        } else if (selectedPayment === 'local') {
            window.location.href = '/paginas/pagamentoLocal.html';
        } else {//caso nn tenha escolido uma opçao
            alert('Por favor, selecione um método de pagamento.');
        }
    });
});
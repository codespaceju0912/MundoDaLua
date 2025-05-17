document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('btVoltaPVisaoGTopper').addEventListener('click', function () {
        window.location.href = "visaoGTopper.html";
    });

    document.querySelector('.submit-btn').addEventListener('click', function () {
        const paymentMethods = document.getElementsByName('payment');
        let selectedPayment = '';

        paymentMethods.forEach(method => {
            if (method.checked) {
                selectedPayment = method.value;
            }
        });

        if (selectedPayment === 'pix') {
            window.location.href = '/paginas/pagamentoPix.html';
        } else if (selectedPayment === 'local') {
            window.location.href = '/paginas/pagamentoLocal.html';
        } else {
            alert('Por favor, selecione um método de pagamento.');
        }
    });
});


function goTelaPg(){
    window.location.href = '/paginas/opcaopg.html';
}

const escolhas = document.querySelectorAll('input[name="escolha"]');
const myElement = document.getElementById("meuInput");
const valorText = document.getElementById("textvalor");

document.querySelector(".preco-btn").addEventListener("click", () => {
    let valor = 0;
    let alertar = true;
    escolhas.forEach((e) => {
        if (e.checked) {
            alertar = false;
            valor = parseFloat(e.value);
        }
    });

    if (alertar) {
        alert('Por favor, selecione se quer com montagem ou não');
    } else {
        valor = valor * parseInt(myElement.value);
        valorText.textContent = "R$" + valor.toFixed(2);
    }
})



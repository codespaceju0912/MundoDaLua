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
        alert('Por favor, selecione uma opção');
    } else {
        if (parseInt(myElement.value) < 0 && Number.isInteger(parseFloat(myElement.value))){ //Tratar entrada pra valores diferentes de inteiros e menores que 0
            valor = valor * 0;
            alert('Por favor, escolha uma quantidade de numero inteiro e maior que zero!');
        }
        else{
            valor = valor * parseInt(myElement.value);
        }
        valorText.textContent = "R$" + valor.toFixed(2);
    }
})



const myElement = document.getElementById("meuInput");
const valorText = document.getElementById("textvalor");

document.querySelector(".preco-btn").addEventListener("click", () => {
    let valor = 60;
    if (parseInt(myElement.value) < 0 && Number.isInteger(parseFloat(myElement.value))){ //Tratar entrada pra valores diferentes de inteiros e menores que 0
        valor = valor * 0;
        alert('Por favor, escolha uma quantidade de numero inteiro e maior que zero!');
    }
    else{
        valor = valor * parseInt(myElement.value);
    }
    
    valorText.textContent = "R$" + valor.toFixed(2);
    
})


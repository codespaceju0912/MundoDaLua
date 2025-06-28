//declara as costantes
const escolhas = document.querySelectorAll('input[name="escolha"]');
const myElement = document.getElementById("meuInput");
const valorText = document.getElementById("textvalor");
//chama classe .preco-btn e ao se clicada
document.querySelector(".preco-btn").addEventListener("click", () => {
    let valor = 0;
    let alertar = true;
    //verifica se o radio foi acessado
    escolhas.forEach((e) => {
        if (e.checked) {
            alertar = false;
            valor = parseFloat(e.value);
        }
    });
    //caso nn tenha escolido uma opçao
    
        
        valor = valor * parseInt(myElement.value);
        
        valorText.textContent = "R$" + valor.toFixed(2);
    
})



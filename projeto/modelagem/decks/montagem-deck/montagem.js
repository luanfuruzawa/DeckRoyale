/* https://www.youtube.com/watch?v=4AHot187Lj0 - link do video que ensina a arrastar e trazer elementos */
let cartas = document.getElementsByClassName("carta");
let deck = document.querySelector(".deck");
let selecao = document.querySelector(".selecao-cartas");
// Selecionando o botão pelo ID, como definido no HTML:
let botaoSalvar = document.getElementById("botao-salvar"); 

let selected = null; 

// Função para verificar o número de cartas e atualizar o botão
function atualizarBotaoSalvar() {
    const numCartas = deck.children.length;

    if (numCartas < 8) {
        botaoSalvar.disabled = true; // Define como desabilitado
        botaoSalvar.innerText = `Salvar (${numCartas}/8)`;
    } else {
        botaoSalvar.disabled = false;  
        botaoSalvar.innerText = "Salvar Deck";
    }
}

for (let carta of cartas) { 
    carta.addEventListener("dragstart", function (e) {
        selected = e.target;
    });
}
 
deck.addEventListener("dragover", function (e) {
    e.preventDefault();
});
 
deck.addEventListener("drop", function (e) {
    e.preventDefault();
    if (!selected) return;

    if (deck.children.length < 8) {
        deck.appendChild(selected);
        // Após adicionar, atualiza o estado do botão
        atualizarBotaoSalvar(); 
    } else {
        alert("O deck já está cheio!");
    }

    // Mostrar os valores de elixir das cartas no deck
    var cartasNoDeck = deck.querySelectorAll('.carta');
    let custoTotal = 0;
    console.log("Deck:"); 

    for (var i = 0; i < cartasNoDeck.length; i++) { 
        var carta = cartasNoDeck[i]; 
        var nome = carta.dataset.id; 
        var custo = Number(carta.dataset.custo);
        custoTotal = Number(custoTotal + custo); 
        console.log("Nome: " + nome + " | Custo: " + custo); 
        document.getElementById("custo-elixir").innerText = (custoTotal / (i + 1)).toFixed(1);
    } 
    selected = null;
});  

// Permitir soltar sobre a seleção original
selecao.addEventListener("dragover", function (e) {
    e.preventDefault();
});

// Soltar carta de volta na seleção
selecao.addEventListener("drop", function (e) {
    e.preventDefault();
    if (!selected) return;

    selecao.querySelector(".todas-cartas").appendChild(selected);
    // Após remover, atualiza o estado do botão
    atualizarBotaoSalvar(); 

    selected = null;
});

//velocidade que sobe com a carta segurando
document.addEventListener('dragover', function (e) {
    const velocidadeScroll = 20;
    const buffer = 100;

    const altura = e.clientY;
    const tamanhoJanela = window.innerHeight;

    if (altura < buffer) {
        window.scrollBy(0, -velocidadeScroll);
    } else if (altura > tamanhoJanela - buffer) {
        window.scrollBy(0, velocidadeScroll);
    }
});

document.addEventListener('DOMContentLoaded', function () { 
    atualizarBotaoSalvar(); 
 
    const btn = document.getElementById('botao-salvar');
    const menu = document.querySelector('.menu-salvar');

    if (!btn || !menu) return;

    btn.addEventListener('click', function (e) { 
        if (btn.disabled) return; 
        menu.classList.toggle('show');
    });

    // opcional: fechar ao clicar fora
    document.addEventListener('click', function (e) {
        if (!menu.classList.contains('show')) return;
        if (e.target === btn || menu.contains(e.target)) return;
        menu.classList.remove('show');
    });
    
    // opcional: fechar com ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') menu.classList.remove('show');
    });
}); 


// Função para obter IDs (melhorada, sem depender de uma variável 'ids' global)
function getDeckCardIds() {  
    const deck = document.querySelector(".deck");
    var cartasNoDeck = deck.querySelectorAll('.carta');
    const ids = []; // Define o vetor aqui dentro, para ser limpo a cada chamada

    for (var i = 0; i < cartasNoDeck.length; i++) {
        var carta = cartasNoDeck[i];
        var nome = carta.dataset.id;
        ids.push(nome);
    }
    console.log(ids);
    return ids;
}
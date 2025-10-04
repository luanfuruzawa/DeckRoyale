/*https://www.youtube.com/watch?v=4AHot187Lj0 - link do video que ensina a arrastar e trazer elementos*/let cartas = document.getElementsByClassName("carta");
let deck = document.querySelector(".deck");
let selecao = document.querySelector(".selecao-cartas");

let selected = null;

for (let carta of cartas) {
    // Quando começa a arrastar
    carta.addEventListener("dragstart", function (e) {
        selected = e.target;
    });
}

// Permitir soltar sobre o DECK
deck.addEventListener("dragover", function (e) {
    e.preventDefault();
});

// Soltar carta no DECK (limite 8 cartas)
deck.addEventListener("drop", function (e) {
    e.preventDefault();
    if (!selected) return;

    if (deck.children.length < 8) {
        deck.appendChild(selected);
    } else {
        alert("O deck já está cheio!");
    }

    // Mostrar os valores de elixir das cartas no deck
    var cartasNoDeck = deck.querySelectorAll('.carta');
    let custoTotal = 0;
    for (var i = 0; i < cartasNoDeck.length; i++) {
        var carta = cartasNoDeck[i];
        var nome = carta.dataset.id;
        var custo = Number(carta.dataset.custo);
        custoTotal = Number(custoTotal + custo);
        console.log("Nome: " + nome + " | Custo: " + custo);
        document.getElementById("custo-elixir").innerText = (custoTotal/(i+1)).toFixed(1);
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
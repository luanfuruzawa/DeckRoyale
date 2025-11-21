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

function salvarDeck(nome, ids) {
    // 1. Cria o objeto para enviar os dados
    const formData = new FormData();
    formData.append('nome-deck', nome);
    
    ids.forEach(id => {
        formData.append('cartas-ids[]', id); 
    });

    // 3. Envia a requisição POST para o script PHP
    fetch('inserirDeck.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {

            throw new Error(`Erro HTTP! Status: ${response.status}`);
        }
        
        console.log('Requisição enviada e resposta recebida com sucesso.');
        
        if (menuSalvar) menuSalvar.classList.remove('show');
        
    })
    .catch(error => {
        console.error('Erro ao enviar dados:', error);
        alert('Erro de conexão ao servidor. Tente novamente.');
    });
}


document.addEventListener('DOMContentLoaded', function () { 
    formSalvar = document.getElementById('form-salvar-deck');
    inputNomeDeck = document.getElementById('nome-deck'); 
    menuSalvar = document.querySelector('.menu-salvar');
    

    const btn = document.getElementById('botao-salvar');
    
    if (!btn || !menuSalvar || !formSalvar || !inputNomeDeck) return;

    atualizarBotaoSalvar();

    btn.addEventListener('click', function (e) {
        if (btn.disabled) return; 
        menuSalvar.classList.toggle('show');
        inputNomeDeck.focus();
    });

    // opcional: fechar ao clicar fora
    document.addEventListener('click', function (e) {
        if (!menuSalvar.classList.contains('show')) return;
        if (e.target === btn || menuSalvar.contains(e.target)) return;
        menuSalvar.classList.remove('show');
    });
    
    // opcional: fechar com ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') menuSalvar.classList.remove('show');
    });

    // 2. Manipulador de Submissão do Formulário
    formSalvar.addEventListener('submit', function(e) {
        e.preventDefault(); 

        const nomeDeck = inputNomeDeck.value.trim();
        const cartasIds = getDeckCardIds(); 

        if (nomeDeck.length < 3) {
            alert('O nome do deck deve ter pelo menos 3 caracteres.');
            return;
        }

        if (cartasIds.length !== 8) {
            alert('O deck deve conter exatamente 8 cartas.');
            return;
        }

        // 3. Chama a função de envio
        salvarDeck(nomeDeck, cartasIds);
    });
    
});


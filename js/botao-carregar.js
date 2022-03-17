'use strict'

let boxCard = document.querySelectorAll('.card-box');
const botao = document.getElementById('carregar-mais');
var qtdeCardsAtual = 8;


const carregarMais = () => {
    for (let i = qtdeCardsAtual; i < qtdeCardsAtual+2; i++) {
        if (boxCard[i]) {
            boxCard[i].style.display = 'block';
        }
    }
    qtdeCardsAtual += 8;
    if (qtdeCardsAtual >= boxCard.length) {
        event.target.style.display = 'none';
    }
}

botao.addEventListener('click', carregarMais());
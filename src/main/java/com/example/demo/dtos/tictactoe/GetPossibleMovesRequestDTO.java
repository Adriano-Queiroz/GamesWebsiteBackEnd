package com.example.demo.dtos.tictactoe;

public record GetPossibleMovesRequestDTO(
        char player,
        char[][] board
        //adicionar battle
        //pegar tipo do game da battle, passando a saber que board que é suposto usarmos
) {
}

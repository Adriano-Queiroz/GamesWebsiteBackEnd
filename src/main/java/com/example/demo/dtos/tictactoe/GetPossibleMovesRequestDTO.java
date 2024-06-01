package com.example.demo.dtos.tictactoe;

public record GetPossibleMovesRequestDTO(
        char player,
        String[][] board
        //adicionar battle
        //pegar tipo do game da battle, passando a saber que board que é suposto usarmos
) {
}

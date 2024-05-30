package com.example.demo.dtos.tictactoe;

public record MakeMoveDTO(
        char player,
        char[][] board,
        long battleId,
        long userId
) {
}

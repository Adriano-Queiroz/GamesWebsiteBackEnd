package com.example.demo.dtos.tictactoe;

public record MakeMoveRequestDTO(
        String player,
        String board,
        long codBattle,
        long codUser,
        long waitTime
) {
}

package com.example.demo.dtos.tictactoe;

public record MakeMoveResponseDTO(
        String board,
        String possibleMoves,
        long codBattle,
        String status
) {
}

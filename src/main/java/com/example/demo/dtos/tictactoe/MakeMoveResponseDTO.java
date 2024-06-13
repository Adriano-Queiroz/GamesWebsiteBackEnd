package com.example.demo.dtos.tictactoe;

import lombok.Setter;

public record MakeMoveResponseDTO(
        String board,
        String possibleMoves,
        long codBattle,
        String status
)
{}

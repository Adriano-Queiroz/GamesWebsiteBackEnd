package com.example.demo.dtos.tictactoe;

import com.example.demo.models.battle.Status;

public record MakeMoveResponseDTO(
        String board,
        String possibleMoves,
        long codBattle,
        String status
) {
}

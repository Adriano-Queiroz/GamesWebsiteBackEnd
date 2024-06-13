package com.example.demo.dtos.rest_battle;

public record RestBattleMoveResponseDTO(
        String board,
        String possibleMoves,
        long codBattle,
        String status
) {
}

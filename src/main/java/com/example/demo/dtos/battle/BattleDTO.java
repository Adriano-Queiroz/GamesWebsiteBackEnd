package com.example.demo.dtos.battle;

public record BattleDTO(
        String board,
        String possibleMoves,
        long codBattle,
        String status
) {
}

package com.example.demo.dtos.FE.Battle;

public record BattleRequestDTO(
        long codRoom,
        long codBattle,
        boolean isPlayer1,
        String status,
        String board,
        boolean hasReturned
) {
}

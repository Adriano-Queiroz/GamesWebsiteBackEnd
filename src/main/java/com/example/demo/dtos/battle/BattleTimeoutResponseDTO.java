package com.example.demo.dtos.battle;

public record BattleTimeoutResponseDTO(
        boolean hasTimedOut,
        String status,
        long codBattle
) {
}

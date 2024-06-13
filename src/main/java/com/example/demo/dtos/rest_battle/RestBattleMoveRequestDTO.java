package com.example.demo.dtos.rest_battle;

public record RestBattleMoveRequestDTO(
        String player,
        String board,
        long codBattle,
        long codUser
) {
}

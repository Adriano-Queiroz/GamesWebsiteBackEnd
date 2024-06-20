package com.example.demo.dtos.rest_battle;

public record CreateBattleRequestDTO(
        long codUser,
        boolean isPlayer1,
        long codLobby
) {
}

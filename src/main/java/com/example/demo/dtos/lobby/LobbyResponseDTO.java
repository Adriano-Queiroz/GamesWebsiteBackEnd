package com.example.demo.dtos.lobby;

import com.example.demo.models.battle.Status;

public record LobbyResponseDTO(
        String message,
        boolean isSecondPlayer,
        long codLobby,
        boolean isPlayer1,
        String board,
        String status,
        long codBattle
) {
    public LobbyResponseDTO(String message, boolean isSecondPlayer, long codLobby, boolean isPlayer1, String board, long codBattle) {
        this(message, isSecondPlayer, codLobby, isPlayer1, board, String.valueOf(Status.P1_TURN), codBattle);
    }
}

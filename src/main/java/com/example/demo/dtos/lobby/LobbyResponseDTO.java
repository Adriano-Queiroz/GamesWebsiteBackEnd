package com.example.demo.dtos.lobby;

public record LobbyResponseDTO(
    String message,
    boolean isSecondPlayer,
    long codLobby,
    boolean isPlayer1
) {
}

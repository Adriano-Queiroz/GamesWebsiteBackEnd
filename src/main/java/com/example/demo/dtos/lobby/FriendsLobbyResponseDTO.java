package com.example.demo.dtos.lobby;

public record FriendsLobbyResponseDTO(
        String message,
        boolean isSecondPlayer,
        long codLobby,
        boolean isPlayer1
) {
}

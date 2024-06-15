package com.example.demo.dtos.friendship_battle;

public record AcceptInviteRequestDTO(
        long codUser,
        String friendUsername,
        long codLobby,
        long codRoom
) {
}

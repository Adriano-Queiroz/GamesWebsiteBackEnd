package com.example.demo.dtos.invites;

public record SendNewInviteRequestDTO(
        long codUser,
        long codRoom,
        long codLobby
) {
}

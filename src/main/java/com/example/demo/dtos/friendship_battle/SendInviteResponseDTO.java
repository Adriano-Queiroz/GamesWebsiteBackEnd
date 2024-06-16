package com.example.demo.dtos.friendship_battle;

import com.example.demo.InviteType;

public record SendInviteResponseDTO(
        long codInvite,
        String friendUsername,
        long codLobby,
        double bet,
        String game,
        InviteType inviteType,
        String message
) {
}

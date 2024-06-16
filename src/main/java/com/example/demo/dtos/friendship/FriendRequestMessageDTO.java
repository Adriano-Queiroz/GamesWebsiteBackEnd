package com.example.demo.dtos.friendship;

import com.example.demo.InviteType;

public record FriendRequestMessageDTO(
        String friendUsername,
        InviteType inviteType,
        String message
) {
}

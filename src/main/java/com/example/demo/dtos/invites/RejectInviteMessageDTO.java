package com.example.demo.dtos.invites;

public record RejectInviteMessageDTO(
        boolean wasRejected,
        String friendUsername
) {
}

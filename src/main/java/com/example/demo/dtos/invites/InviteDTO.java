package com.example.demo.dtos.invites;

public record InviteDTO(
        long codInvite,
        String friendUsername,
        double bet,
        String game

) {
}

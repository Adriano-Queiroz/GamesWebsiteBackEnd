package com.example.demo.dtos.lobby;

public record FriendsLobbyRequestDTO(
        long codUser,
        long codFriend,
        long codRoom,
        long codLobby
) {}

package com.example.demo.dtos.lobby;

import com.example.demo.models.game.GameType;
import com.example.demo.models.room.RoomModel;

public record LobbyRequestDTO(
        long codUser,
        long codRoom
) {
}

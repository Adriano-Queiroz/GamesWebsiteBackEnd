package com.example.demo.dtos.rooms;

import java.util.List;

public record GetRoomsResponseDTO(
        List<RoomDTO> roomList
) {
}

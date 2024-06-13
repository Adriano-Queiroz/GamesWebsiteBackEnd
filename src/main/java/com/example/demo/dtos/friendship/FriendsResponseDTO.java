package com.example.demo.dtos.friendship;

import com.example.demo.dtos.user.UserDTO;

import java.util.List;

public record FriendsResponseDTO(
        List<UserDTO> friendsList
) {
}

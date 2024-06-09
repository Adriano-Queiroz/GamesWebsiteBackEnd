package com.example.demo.dtos.games;

import java.util.List;

public record GetGamesResponseDTO(
        List<GameDTO> gamesList
) {
}

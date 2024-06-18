package com.example.demo.dtos.history;

public record HistoryDTO(
        String board,
        long codBattle,
        String status,
        boolean isPlayer1
) {
}

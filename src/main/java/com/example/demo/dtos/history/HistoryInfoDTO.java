package com.example.demo.dtos.history;

import java.time.LocalDateTime;

public record HistoryInfoDTO(
        String status,
        long codBattle,
        String gameType,
        String player1Username,
        String player2Username,
        double betAmount,
        LocalDateTime createdAt
) {
}

package com.example.demo.dtos.deposits;

import java.time.LocalDate;

public record DepositDTO(
        LocalDate date,
        String username,
        double value,
        String status,
        String type
) {
}

package com.example.demo.dtos.user;

import java.time.LocalDateTime;

public record FeUserDTO(
        String username,
        String email,
        String phone,
        long cpf,
        double balance,
        double bonusBalance,
        LocalDateTime joinDateTime
) {
}

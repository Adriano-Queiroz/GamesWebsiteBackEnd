package com.example.demo.dtos.user;

public record UserInfoOutputDTO (
        long userId,
        String username,
        String email,
        double balance
){}

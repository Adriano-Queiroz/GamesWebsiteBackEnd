package com.example.demo.dtos.user;

public record CreateUserOutputDTO (
        long id,
        String username,
        String email
){}

package com.example.demo.dtos.user;

public record CreateUserInputDTO (
        String username,
        String email,
        String password,
        Long cpf,
        String phoneNumber

){}
package com.example.demo.models.user;


import java.util.UUID;

public record AuthenticatedUser(UserModel user, String token) {
}
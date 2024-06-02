package com.example.demo.models.user;


public record AuthenticatedUser(UserModel user, String token) {
}
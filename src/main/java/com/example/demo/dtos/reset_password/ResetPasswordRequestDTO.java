package com.example.demo.dtos.reset_password;

public record ResetPasswordRequestDTO(
        String email,
        String forgotPasswordCode,
        String newPassword,
        String newPasswordRepeat
) {
}

package com.example.demo.dtos.reset_password;

public record ResetPasswordRequestDTO(
        String email,
        String code,
        String newPassword,
        String newPasswordRepeat
) {
}

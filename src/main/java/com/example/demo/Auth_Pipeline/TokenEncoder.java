package com.example.demo.Auth_Pipeline;

import com.example.demo.models.user.TokenValidationInfo;

public interface TokenEncoder {
    TokenValidationInfo createValidationInformation(String token);
}

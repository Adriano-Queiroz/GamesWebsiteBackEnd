package com.example.demo.Auth_Pipeline;

import com.example.demo.models.user.TokenValidationInfo;

import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.Base64;

public class Sha256TokenEncoder implements TokenEncoder {

    @Override
    public TokenValidationInfo createValidationInformation(String token) {
        return new TokenValidationInfo(hash(token));
    }

    private String hash(String input) {
        try {
            MessageDigest messageDigest = MessageDigest.getInstance("SHA-256");
            byte[] encodedHash = messageDigest.digest(input.getBytes(java.nio.charset.StandardCharsets.UTF_8));
            return Base64.getUrlEncoder().encodeToString(encodedHash);
        } catch (NoSuchAlgorithmException e) {
            throw new RuntimeException("Error creating SHA-256 MessageDigest instance", e);
        }
    }
}
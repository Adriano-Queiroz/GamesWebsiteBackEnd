package com.example.demo.Auth_Pipeline;

import com.example.demo.config.users.UsersDomainConfig;
import com.example.demo.models.token.TokenModel;
import com.example.demo.models.user.PasswordValidationInfo;
import com.example.demo.models.user.TokenValidationInfo;
import com.example.demo.services.exceptions.InternalErrorException;
import org.springframework.stereotype.Component;
import org.springframework.security.crypto.password.PasswordEncoder;

import java.security.NoSuchAlgorithmException;
import java.security.SecureRandom;
import java.time.Clock;
import java.time.Duration;
import java.time.Instant;
import java.util.Base64;

@Component
public class UsersDomain {

    private final PasswordEncoder passwordEncoder;
    private final TokenEncoder tokenEncoder;
    private final UsersDomainConfig config;

    private static UsersDomain instance;


    private UsersDomain(PasswordEncoder passwordEncoder, TokenEncoder tokenEncoder, UsersDomainConfig config) {
        this.passwordEncoder = passwordEncoder;
        this.tokenEncoder = tokenEncoder;
        this.config = config;
    }

    public static synchronized UsersDomain getInstance(PasswordEncoder passwordEncoder, TokenEncoder tokenEncoder, UsersDomainConfig config) {
        if (instance == null) {
            instance = new UsersDomain(passwordEncoder, tokenEncoder, config);
        }
        return instance;
    }

    public String generateTokenValue() throws InternalErrorException {
        try {
            byte[] byteArray = new byte[config.tokenSizeInBytes()];
            SecureRandom.getInstanceStrong().nextBytes(byteArray);
            return Base64.getUrlEncoder().encodeToString(byteArray);
        }
        catch (NoSuchAlgorithmException ex) {
            throw new InternalErrorException("Error generating token");
        }

    }

    public boolean canBeToken(String token) {
        try {
            return Base64.getUrlDecoder().decode(token).length == config.tokenSizeInBytes();
        } catch (IllegalArgumentException ex) {
            return false;
        }
    }

    public boolean validatePassword(String password, PasswordValidationInfo validationInfo) {
        return passwordEncoder.matches(password, validationInfo.validationInfo());
    }

    public PasswordValidationInfo createPasswordValidationInformation(String password) {
        return new PasswordValidationInfo(passwordEncoder.encode(password));
    }

    public boolean isTokenTimeValid(Clock clock, TokenModel token) {
        Instant now = clock.instant();
        return token.getCreatedAt().compareTo(now) <= 0 &&
                Duration.between(now,token.getCreatedAt()).compareTo(config.tokenTtl()) <= 0 &&
                Duration.between(now,token.getLastUsedAt()).compareTo(config.tokenRollingTtl()) <= 0;
    }

    public Instant getTokenExpiration(TokenModel token) {
        Instant absoluteExpiration = token.getCreatedAt().plus(config.tokenTtl());
        Instant rollingExpiration = token.getLastUsedAt().plus(config.tokenRollingTtl());
        return absoluteExpiration.compareTo(rollingExpiration) < 0 ? absoluteExpiration : rollingExpiration;
    }

    public TokenValidationInfo createTokenValidationInformation(String token) {
        return tokenEncoder.createValidationInformation(token);
    }

    public boolean isSafePassword(String password) {
        return password.length() > 4 && password.matches(".*\\d.*");
    }

    public int getMaxNumberOfTokensPerUser() {
        return config.maxTokensPerUser();
    }
}

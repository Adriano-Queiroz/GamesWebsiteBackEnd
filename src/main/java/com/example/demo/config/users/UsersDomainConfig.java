package com.example.demo.config.users;

import lombok.Getter;

import java.time.Duration;

public record UsersDomainConfig(int tokenSizeInBytes, Duration tokenTtl, Duration tokenRollingTtl,
                                int maxTokensPerUser) {

    public UsersDomainConfig {
        if (tokenSizeInBytes <= 0) {
            throw new IllegalArgumentException("tokenSizeInBytes must be greater than 0");
        }
        if (!tokenTtl.isPositive()) {
            throw new IllegalArgumentException("tokenTtl must be positive");
        }
        if (!tokenRollingTtl.isPositive()) {
            throw new IllegalArgumentException("tokenRollingTtl must be positive");
        }
        if (maxTokensPerUser <= 0) {
            throw new IllegalArgumentException("maxTokensPerUser must be greater than 0");
        }
    }
}
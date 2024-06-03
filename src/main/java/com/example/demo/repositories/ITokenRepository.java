package com.example.demo.repositories;

import com.example.demo.models.token.TokenModel;
import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;
import java.util.UUID;

public interface ITokenRepository extends JpaRepository<TokenModel, String> {
}

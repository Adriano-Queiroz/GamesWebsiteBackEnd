package com.example.demo.repositories;

import com.example.demo.models.token.TokenModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ITokenRepository extends JpaRepository<TokenModel,Long> {
}

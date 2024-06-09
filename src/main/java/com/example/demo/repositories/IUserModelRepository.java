package com.example.demo.repositories;

import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface IUserModelRepository extends JpaRepository<UserModel,Long> {
    Optional<UserModel> findByUsername(String username);
}

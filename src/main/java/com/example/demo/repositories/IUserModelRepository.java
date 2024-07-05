package com.example.demo.repositories;

import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
import java.util.Optional;

public interface IUserModelRepository extends JpaRepository<UserModel,Long> {
    Optional<UserModel> findByUsername(String username);
    List<UserModel> findByEmail(String email);
    @Transactional
    @Modifying
    @Query("UPDATE UserModel u SET u.emailsSentInTheLastHour = 0")
    void resetEmailsSentInTheLastHour();
}

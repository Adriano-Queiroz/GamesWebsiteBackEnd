package com.example.demo.repositories;

import com.example.demo.models.global.SocialMediaModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface ISocialMediaRepository extends JpaRepository<SocialMediaModel, Long> {
    Optional<SocialMediaModel> findByName(String name);
}

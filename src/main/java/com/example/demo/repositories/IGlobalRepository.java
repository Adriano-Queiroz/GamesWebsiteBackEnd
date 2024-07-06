package com.example.demo.repositories;

import com.example.demo.models.global.GlobalModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface IGlobalRepository extends JpaRepository<GlobalModel,Long> {
    Optional<GlobalModel> findByName(String name);
}

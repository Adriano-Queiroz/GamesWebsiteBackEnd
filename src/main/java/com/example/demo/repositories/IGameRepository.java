package com.example.demo.repositories;

import com.example.demo.models.game.GameModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IGameRepository extends JpaRepository<GameModel,Long> {
}

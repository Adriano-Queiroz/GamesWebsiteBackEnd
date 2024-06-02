package com.example.demo.repositories;

import com.example.demo.models.game.GameModel;
import com.example.demo.models.game.GameType;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;
import java.util.Optional;

public interface IGameRepository extends JpaRepository<GameModel,Long> {
    Optional<GameModel> findFirstByGameTypeOrderByCodGameDesc(GameType gameType);
}

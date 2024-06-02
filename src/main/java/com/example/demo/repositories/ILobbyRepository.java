package com.example.demo.repositories;

import com.example.demo.models.game.GameModel;
import com.example.demo.models.lobby.LobbyModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;
import java.util.Optional;

public interface ILobbyRepository extends JpaRepository<LobbyModel,Long> {
    Optional<LobbyModel> findFirstByGameOrderByCodLobbyDesc(GameModel game);
}

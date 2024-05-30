package com.example.demo.repositories;

import com.example.demo.models.lobby.LobbyModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ILobbyRepository extends JpaRepository<LobbyModel,Long> {
}

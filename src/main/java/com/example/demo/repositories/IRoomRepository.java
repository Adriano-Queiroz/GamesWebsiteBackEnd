package com.example.demo.repositories;

import com.example.demo.models.game.GameModel;
import com.example.demo.models.room.RoomModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface IRoomRepository extends JpaRepository<RoomModel,Long> {
    List<RoomModel> findAllByGame(GameModel game);
}

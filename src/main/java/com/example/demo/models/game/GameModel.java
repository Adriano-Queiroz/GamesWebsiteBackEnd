package com.example.demo.models.game;

import com.example.demo.dtos.games.GameDTO;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

@Setter
@Getter
@Entity
@Table(name = "game")
public class GameModel {

    @Id
    @GeneratedValue
    private Long codGame;

    @Enumerated(EnumType.STRING)
    private GameType gameType;

    private double housePercentage;

    public GameDTO gameModelToDTO(){
        return new GameDTO(codGame,gameType.name());
    }
}


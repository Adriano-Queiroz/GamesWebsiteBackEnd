package com.example.demo.models.game;

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

}

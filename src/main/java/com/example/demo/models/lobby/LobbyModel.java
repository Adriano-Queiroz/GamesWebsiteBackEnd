package com.example.demo.models.lobby;

import com.example.demo.models.game.GameModel;
import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

@Entity
@Table(name = "lobby")
@Getter
@Setter
public class LobbyModel {
    @Id
    private Long codLobby;

    @ManyToOne
    @JoinColumn(name = "cod_user")
    private UserModel user;

    @ManyToOne
    @JoinColumn(name = "cod_game")
    private GameModel game;
}

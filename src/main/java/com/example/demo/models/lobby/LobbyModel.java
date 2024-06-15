package com.example.demo.models.lobby;

import com.example.demo.models.game.GameModel;
import com.example.demo.models.invite.InviteModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.util.Set;

@Entity
@Table(name = "lobby")
@Getter
@Setter
public class LobbyModel {
    @Id
    @GeneratedValue
    private Long codLobby;

    @ManyToOne
    @JoinColumn(name = "cod_user")
    private UserModel user;
    @ManyToOne
    @JoinColumn(name = "friend_invited")
    private UserModel friendInvited;

    private long inviteId;

    @ManyToOne
    @JoinColumn(name = "cod_game")
    private GameModel game;

    @ManyToOne
    @JoinColumn(name = "cod_room")
    private RoomModel room;

    @OneToMany(mappedBy = "lobby", cascade = CascadeType.REMOVE, orphanRemoval = true)
    private Set<InviteModel> invites;

}

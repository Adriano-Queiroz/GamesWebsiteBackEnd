package com.example.demo.models.lobby;

import com.example.demo.models.game.GameModel;
import com.example.demo.models.invite.InviteModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.fasterxml.jackson.annotation.JsonIgnore;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.Set;

@Entity
@Table(name = "lobby")
@Getter
@Setter
public class LobbyModel {
    @Id
    @GeneratedValue
    private Long codLobby;
    @JsonIgnore
    private String firstMoveBoard;
    @ManyToOne
    @JoinColumn(name = "cod_user")
    private UserModel user;
    @ManyToOne
    @JoinColumn(name = "friend_invited")
    private UserModel friendInvited;
    private boolean isFriendsLobby;

    private long inviteId;

    private String inviteCode;

    @ManyToOne
    @JoinColumn(name = "cod_game")
    private GameModel game;

    @ManyToOne
    @JoinColumn(name = "cod_room")
    private RoomModel room;

    @OneToMany(mappedBy = "lobby", cascade = CascadeType.REMOVE, orphanRemoval = true)
    private Set<InviteModel> invites;

    private LocalDateTime creationDate;
    @PrePersist
    protected void onCreate() {
        creationDate = LocalDateTime.now();
    }
}

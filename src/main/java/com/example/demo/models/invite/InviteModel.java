package com.example.demo.models.invite;

import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

@Entity
@Getter
@Table(name = "Invite")
@Setter
public class InviteModel {

    @Id
    @GeneratedValue
    private long codInvite;

    @ManyToOne
    @JoinColumn(name = "cod_user_request")
    private UserModel userRequest; // who sent invite

    @ManyToOne
    @JoinColumn(name = "cod_user_accept")
    private UserModel userAccept; // who accepted invite

    private Boolean isAccepted;

    @ManyToOne
    @JoinColumn(name = "cod_room")
    private RoomModel room;

    @ManyToOne
    @JoinColumn(name = "cod_lobby")
    private LobbyModel lobby;
    @PreRemove
    private void preRemove() {
        this.lobby = null; // Remove reference to prevent constraints violation
    }
}

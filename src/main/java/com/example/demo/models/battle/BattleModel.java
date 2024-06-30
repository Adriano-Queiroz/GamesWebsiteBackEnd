package com.example.demo.models.battle;

import com.example.demo.models.game.GameModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.fasterxml.jackson.annotation.JsonIgnore;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.time.LocalDateTime;
import java.util.HashSet;
import java.util.Set;
import java.util.Timer;

@Entity
@Table(name = "battle")
@Getter
@Setter
public class BattleModel {

    @Id
    @GeneratedValue
    private Long codBattle;
    @JsonIgnore
    private String board; // fiz isto assim para ser escalável, sabemos o tipo de board através do tipo de game

    @Enumerated(EnumType.STRING)
    @Column(columnDefinition = "ENUM('P1_TURN', 'P2_TURN','P1_WON','P2_WON', 'DRAW')")
    private Status status = Status.P1_TURN;
    /*
    @ManyToMany
    @JoinTable(
            name = "user_battle", // Creating a join table
            joinColumns = @JoinColumn(name = "cod_battle"),
            inverseJoinColumns = @JoinColumn(name = "cod_user")
    )
    private Set<UserModel> users = new HashSet<>();


     */
    @Version
    private Long version;
    @ManyToOne
    @JoinColumn(name = "cod_player1" , referencedColumnName = "codUser")
    private UserModel player1;

    @ManyToOne
    @JoinColumn(name = "cod_player2", referencedColumnName = "codUser")
    private UserModel player2;
/*
    @ManyToOne
    @JoinColumn(name = "cod_game")
    private GameModel game;


 */
    // Changed game to be inside room
    @ManyToOne
    @JoinColumn(name = "cod_room")
    private RoomModel room;

    private LocalDateTime lastMoveDateTime;
    @Transient
    private Timer timer;

    public Status swapStatus(){
        if(status.equals(Status.P1_TURN))
            status = Status.P2_TURN;
        else
            status = Status.P1_TURN;
        return status;
    }

    @PreUpdate
    @PrePersist
    public void updateLastMoveDateTime() {
        this.lastMoveDateTime = LocalDateTime.now(); // Update with current date/time
    }
}

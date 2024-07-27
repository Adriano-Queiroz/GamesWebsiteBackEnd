package com.example.demo.models.history;

import com.example.demo.models.battle.Status;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.fasterxml.jackson.annotation.JsonIgnore;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

import java.time.LocalDateTime;

@Entity
@Table(name = "history")
@Getter
@Setter
public class HistoryModel {

    @Id
    @GeneratedValue()
    private Long codHistory;

    private Long codBattle;
    @JsonIgnore
    private String board; // fiz isto assim para ser escalável, sabemos o tipo de board através do tipo de game

    @Enumerated(EnumType.STRING)
    @Column(columnDefinition = "ENUM('P1_TURN', 'P2_TURN','P1_WON','P2_WON', 'DRAW')")
    private Status status = Status.P1_TURN;

    @ManyToOne
    @JoinColumn(name = "cod_player1" , referencedColumnName = "codUser")
    private UserModel player1;

    @ManyToOne
    @JoinColumn(name = "cod_player2", referencedColumnName = "codUser")
    private UserModel player2;

    @ManyToOne
    @JoinColumn(name = "cod_room")
    private RoomModel room;

    private LocalDateTime createdAt;
    private double moneyGained;
    @PrePersist
    protected void onCreate() {
        this.createdAt = LocalDateTime.now();
    }

}

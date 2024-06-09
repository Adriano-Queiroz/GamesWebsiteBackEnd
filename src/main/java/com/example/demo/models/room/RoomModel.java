package com.example.demo.models.room;

import com.example.demo.dtos.rooms.RoomDTO;
import com.example.demo.models.game.GameModel;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;

@Entity
@Table(name = "room")
@Getter
@Setter
public class RoomModel {

    @Id
    @GeneratedValue
    private Long codRoom;

    private double bet;
    @ManyToOne
    @JoinColumn(name = "cod_game")
    private GameModel game;

    public RoomDTO roomToDTO(){
        return new RoomDTO(codRoom,bet);
    }
}

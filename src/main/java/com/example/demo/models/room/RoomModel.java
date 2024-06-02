package com.example.demo.models.room;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import lombok.Getter;
import lombok.Setter;

@Entity
@Table(name = "room")
@Getter
@Setter
public class RoomModel {

    @Id
    private Long codRoom;

    private double bet;
}

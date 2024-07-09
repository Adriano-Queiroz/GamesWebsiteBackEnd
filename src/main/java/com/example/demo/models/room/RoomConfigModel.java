package com.example.demo.models.room;

import com.example.demo.models.game.GameModel;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.services.tictactoe.RoomManagementService;
import jakarta.persistence.*;
import lombok.Getter;
import lombok.Setter;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;


@Getter
@Setter
@Entity
@Table(name = "room_config")
@EntityListeners(RoomConfigModel.RoomConfigListener.class)
public class RoomConfigModel {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long codRoomConfig;

    @Column(unique = true)
    private String name;

    @Column(unique = true)
    private double bet;

    @Component
    public static class RoomConfigListener {

        private static RoomManagementService roomManagementService;

        @Autowired
        public void setRoomManagementService(RoomManagementService roomManagementService) {
            RoomConfigListener.roomManagementService = roomManagementService;
        }

        @PrePersist
        public void createRoomsOnNewConfig(RoomConfigModel roomConfigModel) {
            roomManagementService.createRoomsOnNewConfig(roomConfigModel);
        }

        @PreRemove
        public void deleteRoomsOnConfigDelete(RoomConfigModel roomConfigModel) {
            roomManagementService.deleteRoomsOnConfigDelete(roomConfigModel);
        }
    }

}

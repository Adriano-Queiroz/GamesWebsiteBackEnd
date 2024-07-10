package com.example.demo.services.tictactoe;

import com.example.demo.models.game.GameModel;
import com.example.demo.models.room.RoomConfigModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.repositories.IRoomConfigRepository;
import com.example.demo.repositories.IRoomRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class RoomManagementService {


    @Autowired
    private IRoomRepository iRoomRepository;

    @Autowired
    private IGameRepository iGameRepository;

    public void createRoomsOnNewConfig(RoomConfigModel roomConfigModel) {
        List<GameModel> games = iGameRepository.findAll();
        games.forEach(game -> {
            RoomModel roomModel = new RoomModel();
            roomModel.setBet(roomConfigModel.getBet());
            roomModel.setGame(game);
            iRoomRepository.save(roomModel);
        });
    }

    public void deleteRoomsOnConfigDelete(RoomConfigModel roomConfigModel) {
        List<RoomModel> rooms = iRoomRepository.findAll();
        rooms.stream().filter(room -> room.getBet() == roomConfigModel.getBet())
                .forEach(it -> iRoomRepository.delete(it));
    }

}

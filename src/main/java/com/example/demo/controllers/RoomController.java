package com.example.demo.controllers;

import com.example.demo.dtos.games.GetGamesResponseDTO;
import com.example.demo.dtos.rooms.GetRoomsResponseDTO;
import com.example.demo.models.game.GameModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.repositories.IRoomRepository;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/rooms")
public class RoomController {

    @Autowired
    private IGameRepository iGameRepository;
    @Autowired
    private IRoomRepository iRoomRepository;
    @GetMapping("{codGame}")
    public ResponseEntity<GetRoomsResponseDTO> getRooms(@PathVariable long codGame) throws NotFoundException {
        Optional<GameModel> optionalGame = iGameRepository.findById(codGame);
        if(!optionalGame.isPresent()){
            throw new NotFoundException("Game not found of id:" + codGame);
        }
        GameModel game = optionalGame.get();
        List<RoomModel> roomList = iRoomRepository.findAllByGame(game);
        return ResponseEntity.ok(new GetRoomsResponseDTO(
                roomList.stream().map(RoomModel::roomToDTO).toList()
        ));
    }
}

package com.example.demo.controllers;

import com.example.demo.dtos.lobby.LobbyRequestDTO;
import com.example.demo.dtos.lobby.LobbyResponseDTO;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameModel;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.*;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.autoconfigure.security.SecurityProperties;
import org.springframework.http.HttpStatusCode;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/lobby")
public class RestLobbyController {

    ILobbyRepository iLobbyRepository;
    IGameRepository iGameRepository;
    IUserModelRepository iUserModelRepository;
    IBattleRepository iBattleRepository;
    IRoomRepository iRoomRepository;

    @Autowired
    public RestLobbyController(ILobbyRepository iLobbyRepository,
                               IGameRepository iGameRepository,
                               IUserModelRepository iUserModelRepository,
                               IBattleRepository iBattleRepository,
                               IRoomRepository iRoomRepository){
        this.iLobbyRepository = iLobbyRepository;
        this.iGameRepository = iGameRepository;
        this.iUserModelRepository = iUserModelRepository;
        this.iBattleRepository = iBattleRepository;
        this.iRoomRepository = iRoomRepository;
    }
    @PostMapping
    public ResponseEntity<LobbyResponseDTO> getLobby(@RequestBody LobbyRequestDTO lobbyRequestDTO) throws NotFoundException {
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(lobbyRequestDTO.codRoom());
        Optional<UserModel> optionalUser = iUserModelRepository.findById(lobbyRequestDTO.codUser());
        if(!optionalUser.isPresent())
            throw new NotFoundException("User not found of id " + lobbyRequestDTO.codUser());
        if(!optionalRoom.isPresent())
            throw new NotFoundException("Room not found of id " + lobbyRequestDTO.codRoom());
        RoomModel room = optionalRoom.get();
        GameModel game = room.getGame();
        UserModel newUser = optionalUser.get();
        Optional<LobbyModel> optionalLobby = iLobbyRepository.findFirstByGameOrderByCodLobbyDesc(game);
        if(!optionalLobby.isPresent()){
            LobbyModel lobby = new LobbyModel();
            lobby.setGame(game);
            lobby.setUser(newUser);
            iLobbyRepository.save(lobby);
            return ResponseEntity.ok(new LobbyResponseDTO("Waiting for player",false));
        }
        LobbyModel lobby = optionalLobby.get();
        UserModel oldUser = lobby.getUser();
        BattleModel battle = new BattleModel();
        battle.setPlayer1(Math.random() < 0.5 ? newUser : oldUser);
        battle.setPlayer2(battle.getPlayer1() == newUser ? oldUser : newUser);
        battle.setRoom(room);
        iBattleRepository.save(battle);
        iLobbyRepository.delete(lobby); //delete lobby, after using it's information

                //pegar o player que ja tava no lobby e o player que ta, fazer um randomizer e meter p1 e p2, resto é ez clap
        //enviar roomModel no LobbyRequest, pegar game daí, desnecessário fzr como tava a fzr com gametype
        //probably done (arranjar forma de fucking testar)
        return ResponseEntity.ok(new LobbyResponseDTO("Found opponent, game is about to begin",true));
    }
}

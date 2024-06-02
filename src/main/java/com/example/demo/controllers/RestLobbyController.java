package com.example.demo.controllers;

import com.example.demo.dtos.lobby.LobbyRequestDTO;
import com.example.demo.dtos.lobby.LobbyResponseDTO;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameModel;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.repositories.ILobbyRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.boot.autoconfigure.security.SecurityProperties;
import org.springframework.http.HttpStatusCode;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController("/lobby")
public class RestLobbyController {

    ILobbyRepository iLobbyRepository;
    IGameRepository iGameRepository;
    IUserModelRepository iUserModelRepository;
    IBattleRepository iBattleRepository;
    public RestLobbyController(ILobbyRepository iLobbyRepository,
                               IGameRepository iGameRepository,
                               IUserModelRepository iUserModelRepository,
                               IBattleRepository iBattleRepository){
        this.iLobbyRepository = iLobbyRepository;
        this.iGameRepository = iGameRepository;
        this.iUserModelRepository = iUserModelRepository;
        this.iBattleRepository = iBattleRepository;
    }
    @PostMapping
    public ResponseEntity<LobbyResponseDTO> getLobby(LobbyRequestDTO lobbyRequestDTO) throws NotFoundException {
        Optional<GameModel> optionalGame = iGameRepository.findFirstByGameTypeOrderByCodGameDesc(lobbyRequestDTO.gameType());
        Optional<UserModel> optionalUser = iUserModelRepository.findById(lobbyRequestDTO.userId());
        if(!optionalUser.isPresent())
            throw new NotFoundException("User not found of id " + lobbyRequestDTO.userId());
        if(!optionalGame.isPresent())
            throw new NotFoundException("Game not found of type "+ lobbyRequestDTO.gameType());
        GameModel game = optionalGame.get();
        UserModel newUser = optionalUser.get();
        Optional<LobbyModel> optionalLobby = iLobbyRepository.findFirstByGameOrderByCodLobbyDesc(game);
        if(!optionalLobby.isPresent()){
            LobbyModel lobby = new LobbyModel();
            lobby.setGame(game);
            lobby.setUser(newUser);
            return ResponseEntity.ok(new LobbyResponseDTO("Waiting for player"));
        }
        LobbyModel lobby = optionalLobby.get();
        UserModel oldUser = lobby.getUser();
        BattleModel battle = new BattleModel();
        battle.setPlayer1(Math.random() < 0.5 ? newUser : oldUser);
        battle.setPlayer2(battle.getPlayer1() == newUser ? oldUser : newUser);
        battle.setRoom(lobbyRequestDTO.room());
        iBattleRepository.save(battle);
        iLobbyRepository.delete(lobby); //delete lobby, after using it's information

                //pegar o player que ja tava no lobby e o player que ta, fazer um randomizer e meter p1 e p2, resto é ez clap
        //enviar roomModel no LobbyRequest, pegar game daí, desnecessário fzr como tava a fzr com gametype
        //probably done (arranjar forma de fucking testar)
        return ResponseEntity.ok(new LobbyResponseDTO("Found opponent, game is about to begin"));
    }
}

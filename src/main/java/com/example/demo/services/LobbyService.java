package com.example.demo.services;

import com.example.demo.PlayersTuple;
import com.example.demo.dtos.lobby.RestLobbyRequestDTO;
import com.example.demo.dtos.lobby.LobbyResponseDTO;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameModel;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.*;
import com.example.demo.services.exceptions.NotFoundException;
import com.example.demo.services.sockets.WebSocketService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class LobbyService {

    ILobbyRepository iLobbyRepository;
    IGameRepository iGameRepository;
    IUserModelRepository iUserModelRepository;
    IBattleRepository iBattleRepository;
    IRoomRepository iRoomRepository;
    WebSocketService webSocketService;

    @Autowired
    public LobbyService(ILobbyRepository iLobbyRepository,
                        IGameRepository iGameRepository,
                        IUserModelRepository iUserModelRepository,
                        IBattleRepository iBattleRepository,
                        IRoomRepository iRoomRepository,
                        WebSocketService webSocketService) {
        this.iLobbyRepository = iLobbyRepository;
        this.iGameRepository = iGameRepository;
        this.iUserModelRepository = iUserModelRepository;
        this.iBattleRepository = iBattleRepository;
        this.iRoomRepository = iRoomRepository;
        this.webSocketService = webSocketService;
    }

    public ResponseEntity<LobbyResponseDTO> getLobby(RestLobbyRequestDTO restLobbyRequestDTO) throws NotFoundException {
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(restLobbyRequestDTO.codRoom());
        Optional<UserModel> optionalUser = iUserModelRepository.findById(restLobbyRequestDTO.codUser());
        if (!optionalUser.isPresent())
            throw new NotFoundException("User not found of id " + restLobbyRequestDTO.codUser());
        if (!optionalRoom.isPresent())
            throw new NotFoundException("Room not found of id " + restLobbyRequestDTO.codRoom());
        RoomModel room = optionalRoom.get();
        GameModel game = room.getGame();
        UserModel newUser = optionalUser.get();
        Optional<LobbyModel> optionalLobby = iLobbyRepository.findFirstByGameOrderByCodLobbyDesc(game);
        if (!optionalLobby.isPresent()) {
            LobbyModel lobby = new LobbyModel();
            lobby.setGame(game);
            lobby.setUser(newUser);
            iLobbyRepository.save(lobby);
            return ResponseEntity.ok(new LobbyResponseDTO("Waiting for player", false, lobby.getCodLobby(), false));
        }
        LobbyModel lobby = optionalLobby.get();
        UserModel oldUser = lobby.getUser();
        BattleModel battle = new BattleModel();
        PlayersTuple playersTuple = randomizePlayers(oldUser, newUser);
        setBattle(playersTuple, battle, room);
        iLobbyRepository.delete(lobby);
        return sendMessagesAfterOpponentFound(
                playersTuple.player1(),
                playersTuple.player2(),
                oldUser,
                newUser,
                lobby.getCodLobby());
    }

    public PlayersTuple randomizePlayers(UserModel oldUser, UserModel newUser) {
        UserModel player1 = Math.random() < 0.5 ? newUser : oldUser;
        UserModel player2 = player1 == newUser ? oldUser : newUser;
        return new PlayersTuple(player1, player2);
    }

    public void setBattle(PlayersTuple playersTuple, BattleModel battle, RoomModel room) {
        battle.setPlayer1(playersTuple.player1());
        battle.setPlayer2(playersTuple.player2());
        battle.setRoom(room);
        iBattleRepository.save(battle);
    }

    public ResponseEntity<LobbyResponseDTO> sendMessagesAfterOpponentFound(UserModel player1, UserModel player2, UserModel oldUser, UserModel newUser, long codLobby) {
        boolean isOldUserPlayer1 = player1.equals(oldUser);
        LobbyResponseDTO lobbyResponseDTO = new LobbyResponseDTO(
                "Found Opponent, game is about to begin",
                true,
                codLobby,
                isOldUserPlayer1
        );
        webSocketService.sendMessage("/topic/lobby/" + codLobby, lobbyResponseDTO);
        return ResponseEntity.ok(new LobbyResponseDTO("Found Opponent, game is about to begin",
                true,
                codLobby,
                !isOldUserPlayer1
        ));
    }
}

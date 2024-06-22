package com.example.demo.controllers;

import com.example.demo.Tuple;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.rest_battle.*;
import com.example.demo.dtos.tictactoe.MakeMoveRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.battle.Status;
import com.example.demo.models.game.GameType;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.ILobbyRepository;
import com.example.demo.repositories.IRoomRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.GamesService;
import com.example.demo.services.exceptions.NotFoundException;
import com.example.demo.services.tictactoe.TicTacToeLogicService;
import com.example.demo.services.tictactoe.TicTacToeService;
import com.google.gson.Gson;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

import static com.example.demo.mappers.BoardMapper.getBoard;

@RestController
@RequestMapping("/rest_battle")
public class BattleRestController {

    //GetBoard e status
    @Autowired
    private IBattleRepository iBattleRepository;
    @Autowired
    private TicTacToeLogicService ticTacToeLogicService;
    @Autowired
    private TicTacToeService ticTacToeService;
    @Autowired
    private GamesService gamesService;
    @Autowired
    private IUserModelRepository iUserModelRepository;
    @Autowired
    private ILobbyRepository iLobbyRepository;
    @Autowired
    IRoomRepository iRoomRepository;

    @GetMapping("/getInfo/{codBattle}")
    public ResponseEntity<RestBattleResponseDTO> getInfo(@PathVariable long codBattle) throws NotFoundException {
        Optional<BattleModel> optionalBattle = iBattleRepository.findById(codBattle);
        if(!optionalBattle.isPresent())
            throw new NotFoundException("Batalha não encontrada");
        BattleModel battle = optionalBattle.get();

        return ResponseEntity.ok(new RestBattleResponseDTO(battle.getStatus().toString(), battle.getBoard()));
    }
    //Makemove (changes status)
    @PostMapping("/move")
    public ResponseEntity<MakeMoveResponseDTO> move(@RequestBody MakeMoveRequestDTO makeMoveRequestDTO) throws NotFoundException {
        Optional<BattleModel> optionalBattle = iBattleRepository.findById(makeMoveRequestDTO.codBattle());
        if(!optionalBattle.isPresent())
            throw new NotFoundException("Partida não encontrada");
        BattleModel battle = optionalBattle.get();
        String board = makeMoveRequestDTO.board();
        String[][] boardArray = ((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, board))
                .getBoard();
        Gson gson = new Gson();
        board = gson.toJson(gamesService.makeBotMove(
                boardArray,
                makeMoveRequestDTO.player().equals("X") ? "O" : "X" ,
                battle.getRoom().getGame().getGameType()));
        makeMoveRequestDTO = new MakeMoveRequestDTO(makeMoveRequestDTO.player(),
                board,
                makeMoveRequestDTO.codBattle(),
                makeMoveRequestDTO.codUser());
        MakeMoveResponseDTO responseDTO =  ticTacToeLogicService.makeMove(makeMoveRequestDTO);
        Tuple hasFinishedTuple = ticTacToeLogicService.hasFinished(((TicTacToeBoard)
                getBoard(GameType.TICTACTOE, responseDTO.board()))
                .getBoard());
        if(hasFinishedTuple.hasFinished()){
            Status status = ticTacToeService.RestTreatFinishedGame(hasFinishedTuple,responseDTO.codBattle());
            responseDTO = new MakeMoveResponseDTO(
                    responseDTO.board(),
                    responseDTO.possibleMoves(),
                    responseDTO.codBattle(),
                    status.toString()
            );
        }
        return ResponseEntity.ok(responseDTO);
    }
    @DeleteMapping("/createBattle")
    public ResponseEntity<CreateBattleResponseDTO> createBattle(@RequestBody CreateBattleRequestDTO createBattleRequestDTO) throws NotFoundException {
        Optional<UserModel> optionalUser = iUserModelRepository.findById(createBattleRequestDTO.codUser());
        if(!optionalUser.isPresent())
            throw new NotFoundException("User não encontrado");
        UserModel user = optionalUser.get();

        Optional<LobbyModel> optionalLobby = iLobbyRepository.findById(createBattleRequestDTO.codLobby());
        if(!optionalLobby.isPresent())
            throw new NotFoundException("Lobby não encontrado");
        RoomModel room = optionalLobby.get().getRoom();

        BattleModel battle = new BattleModel();
        if(createBattleRequestDTO.isPlayer1())
            battle.setPlayer1(user);
        else
            battle.setPlayer2(user);
        battle.setRoom(room);
        String emptyBoard = gamesService.getEmptyBoard(room.getGame().getGameType());
        battle.setBoard(emptyBoard);
        iBattleRepository.save(battle);
        iLobbyRepository.delete(optionalLobby.get());
        return ResponseEntity.ok(new CreateBattleResponseDTO(battle.getCodBattle()));
    }
}


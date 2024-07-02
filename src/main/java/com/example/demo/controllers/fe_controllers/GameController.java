package com.example.demo.controllers.fe_controllers;

import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.repositories.ILobbyRepository;
import com.example.demo.repositories.IRoomRepository;
import com.example.demo.services.BattleService;
import com.example.demo.services.GamesService;
import com.example.demo.services.UserService;
import com.example.demo.services.exceptions.NotFoundException;
import com.example.demo.dtos.battle.IsInBattleDTO;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameType;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.List;
import java.util.Optional;

@Controller
public class GameController {

    private final UserService userService;
    private final IRoomRepository iRoomRepository;
    private final IGameRepository iGameRepository;
    private final IBattleRepository iBattleRepository;
    private final GamesService gamesService;
    private final BattleService battleService;
    private final ILobbyRepository iLobbyRepository;

    @Autowired
    public GameController(UserService userService, IRoomRepository iRoomRepository, IGameRepository iGameRepository, IBattleRepository iBattleRepository, GamesService gamesService, BattleService battleService, ILobbyRepository iLobbyRepository) {
        this.userService = userService;
        this.iRoomRepository = iRoomRepository;
        this.iGameRepository = iGameRepository;
        this.iBattleRepository = iBattleRepository;
        this.gamesService = gamesService;
        this.battleService = battleService;
        this.iLobbyRepository = iLobbyRepository;
    }

    @GetMapping("/")
    public String home(Model model, HttpSession session) throws NotFoundException {
        if (session.getAttribute("user") == null)
            return "redirect:/login";
        long codUser = ((UserModel) session.getAttribute("user")).getCodUser();
        IsInBattleDTO isInBattleDTO = battleService.isInBattle(codUser);
        if (isInBattleDTO.isInBattle())
            return getLobby(isInBattleDTO.result().codBattle(), session, model);
        model.addAttribute("user", session.getAttribute("user"));
        return "home";
    }

    @GetMapping("/lobby")
    public String getLobby(
            @RequestParam long codBattle,
            HttpSession session,
            Model model) {
        if (session.getAttribute("user") == null)
            return "redirect:/login";
        UserModel user = (UserModel) session.getAttribute("user");
        long codUser = user.getCodUser();
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        boolean isPlayer1 = battle.getPlayer1() != null && battle.getPlayer1().getCodUser() == codUser;
        String board = battle.getBoard();
        String[][] boardArray = ((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, board))
                .getBoard();
        model.addAttribute("codRoom", battle.getRoom().getCodRoom());
        model.addAttribute("isPlayer1", isPlayer1);
        model.addAttribute("status", battle.getStatus());
        model.addAttribute("codBattle", codBattle);
        model.addAttribute("hasReturned", false);
        model.addAttribute("possibleMoves",
                gamesService.getPossibleMoves(boardArray, battle.getRoom().getGame().getGameType()));
        model.addAttribute("codUser", codUser);
        model.addAttribute("seconds",
                15 - Duration.between(battle.getLastMoveDateTime(), LocalDateTime.now()).getSeconds());
        String firstMoveBoard = "";
        Optional<LobbyModel> optionalLobby = iLobbyRepository.findFirstByUserOrderByCodLobbyDesc(user);
        if (optionalLobby.isPresent()) {
            LobbyModel lobby = optionalLobby.get();
            firstMoveBoard = lobby.getFirstMoveBoard();
            iLobbyRepository.delete(lobby);
            if ((battle.getPlayer1() == null || battle.getStatus() == null) && !isPlayer1)
                model.addAttribute("isFirstMove", true);
            else
                model.addAttribute("isFirstMove", false);
        }
        if (battle.getPlayer1() != null && battle.getPlayer2() != null) {
            model.addAttribute("board", board);
            return "lobby";
        }
        if (!isPlayer1)
            model.addAttribute("firstMoveBoard", firstMoveBoard);
        else
            model.addAttribute("firstMoveBoard", "");
        model.addAttribute("board", board);
        return "robotBattle";
    }

    @GetMapping("/rooms")
    public String rooms(HttpSession session, Model model) throws NotFoundException {
        if (session.getAttribute("user") == null)
            return "redirect:/login";
        long codUser = ((UserModel) session.getAttribute("user")).getCodUser();
        IsInBattleDTO isInBattleDTO = battleService.isInBattle(codUser);
        if (isInBattleDTO.isInBattle())
            return getLobby(isInBattleDTO.result().codBattle(), session, model);
        List<RoomModel> roomList = iRoomRepository.findAllByGame(iGameRepository.findById(1L).get()); //todo trocar para ser o game que carreguei
        model.addAttribute("rooms", roomList);
        model.addAttribute("codUser", codUser);
        return "rooms";
    }
}
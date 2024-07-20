package com.example.demo.controllers.fe_controllers;

import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.battle.IsInBattleDTO;
import com.example.demo.dtos.invites.SendNewInviteRequestDTO;
import com.example.demo.dtos.lobby.LobbyResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameType;
import com.example.demo.models.invite.InviteModel;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.*;
import com.example.demo.services.BattleService;
import com.example.demo.services.GamesService;
import com.example.demo.services.LobbyService;
import com.example.demo.services.UserService;
import com.example.demo.services.exceptions.NotEnoughFundsException;
import com.example.demo.services.exceptions.NotFoundException;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.List;
import java.util.Optional;

@Controller
@RequestMapping("/friends")
public class FriendsController {
    private final UserService userService;
    private final IRoomRepository iRoomRepository;
    private final IGameRepository iGameRepository;
    private final IBattleRepository iBattleRepository;
    private final GamesService gamesService;
    private final BattleService battleService;
    private final ILobbyRepository iLobbyRepository;
    private final IUserModelRepository iUserModelRepository;
    private final IInviteRepository iInviteRepository;
    private LobbyService lobbyService;


    @Autowired
    public FriendsController(UserService userService,
                             IRoomRepository iRoomRepository,
                             IGameRepository iGameRepository,
                             IBattleRepository iBattleRepository,
                             GamesService gamesService,
                             BattleService battleService,
                             ILobbyRepository iLobbyRepository,
                             IUserModelRepository iUserModelRepository,
                             IInviteRepository iInviteRepository,
                             LobbyService lobbyService) {
        this.userService = userService;
        this.iRoomRepository = iRoomRepository;
        this.iGameRepository = iGameRepository;
        this.iBattleRepository = iBattleRepository;
        this.gamesService = gamesService;
        this.battleService = battleService;
        this.iLobbyRepository = iLobbyRepository;
        this.iUserModelRepository = iUserModelRepository;
        this.iInviteRepository = iInviteRepository;
        this.lobbyService = lobbyService;
    }
    @GetMapping("/rooms")
    public String rooms(@RequestParam("codGame") long codGame, HttpSession session, Model model) throws NotFoundException {
        if (session.getAttribute("user") == null)
            return "redirect:/login";
        long codUser = ((UserModel) session.getAttribute("user")).getCodUser();
        IsInBattleDTO isInBattleDTO = battleService.isInBattle(codUser);
        if (isInBattleDTO.isInBattle())
            return getLobby(isInBattleDTO.result().codBattle(), session, model);
        List<RoomModel> roomList = iRoomRepository.findAllByGame(iGameRepository.findById(codGame).get()); //todo trocar para ser o game que carreguei
        model.addAttribute("rooms", roomList);
        model.addAttribute("codUser", codUser);
        model.addAttribute("isFriendsRooms", true);
        return "rooms";
    }
    @PostMapping("/acceptInvite")
    public String acceptInvite(HttpSession session, @RequestParam String inviteCode, Model model) throws NotFoundException {
        Optional<LobbyModel> optionalLobby = iLobbyRepository.findFirstByInviteCode(inviteCode);
        if(optionalLobby.isEmpty())
            throw new NotFoundException("Convite expirado ou não existe");
        LobbyModel lobby = optionalLobby.get();
        if (lobby.getCreationDate().plusMinutes(5).isBefore(LocalDateTime.now())) {
            throw new NotFoundException("Convite expirado ou não existe");
        }
        LobbyResponseDTO lobbyResponseDTO = lobbyService.newCreateBattle(lobby,
                (UserModel) session.getAttribute("user"),
                lobby.getRoom());
        return getLobby(lobbyResponseDTO.codBattle(),session,model);
    }

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

}

package com.example.demo.controllers.fe_controllers;

import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.FE.Battle.BattleRequestDTO;
import com.example.demo.dtos.battle.BattleDTO;
import com.example.demo.dtos.battle.IsInBattleDTO;
import com.example.demo.dtos.user.loginDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameType;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.repositories.ILobbyRepository;
import com.example.demo.repositories.IRoomRepository;
import com.example.demo.services.BattleService;
import com.example.demo.services.GamesService;
import com.example.demo.services.UserService;
import com.example.demo.services.exceptions.InternalErrorException;
import com.example.demo.services.exceptions.InvalidUsernameOrPasswordException;
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
public class FinanceController {

    private final UserService userService;
    private IRoomRepository iRoomRepository;
    private IGameRepository iGameRepository;
    @Autowired
    private IBattleRepository iBattleRepository;
    @Autowired
    private GamesService gamesService;
    @Autowired
    private BattleService battleService;
    @Autowired
    private ILobbyRepository iLobbyRepository;
    public FinanceController(UserService userService, IRoomRepository iRoomRepository, IGameRepository iGameRepository) {
        this.userService = userService;
        this.iRoomRepository = iRoomRepository;
        this.iGameRepository = iGameRepository;
    }

    @GetMapping("/saques")
    public String saques(Model model, HttpSession session){
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        model.addAttribute("user", session.getAttribute("user"));
        return "saques";
    }
    @GetMapping("/depositos")
    public String depositos(Model model, HttpSession session){
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        return "depositos";
    }



    @GetMapping("/reacteste")
    public String reactest(){
        return "reacteste";
    }
}

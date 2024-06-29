package com.example.demo.controllers;

import com.example.demo.dtos.FE.Battle.BattleRequestDTO;
import com.example.demo.dtos.user.loginDTO;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.repositories.IRoomRepository;
import com.example.demo.services.UserService;
import com.example.demo.services.exceptions.InternalErrorException;
import com.example.demo.services.exceptions.InvalidUsernameOrPasswordException;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Controller
public class FinanceController {

    private final UserService userService;
    private IRoomRepository iRoomRepository;
    private IGameRepository iGameRepository;
    @Autowired
    private IBattleRepository iBattleRepository;

    public FinanceController(UserService userService, IRoomRepository iRoomRepository, IGameRepository iGameRepository) {
        this.userService = userService;
        this.iRoomRepository = iRoomRepository;
        this.iGameRepository = iGameRepository;
    }

    @GetMapping("/saques")
    public String saques(Model model, HttpSession session){
        if(session.getAttribute("user") == null){
            return "redirect:/login";
        }
        model.addAttribute("user", session.getAttribute("user"));
        return "saques";
    }
    @GetMapping("/depositos")
    public String depositos(Model model, HttpSession session){
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        return "depositos";
    }

    @GetMapping("/login")
    public String login(Model model) {
        model.addAttribute("loginDTO", new loginDTO());
        return "Loginxd";
    }

    @PostMapping("/login")
    public String loginForm(@ModelAttribute("loginDTO")loginDTO loginUserInputDTO, HttpSession session) throws InvalidUsernameOrPasswordException, InternalErrorException {
        AuthenticatedUser authenticatedUser = userService.login(loginUserInputDTO.getUsername(), loginUserInputDTO.getPassword());
        session.setAttribute("user", authenticatedUser.user());
        return "redirect:/saques";
    }
    @GetMapping("/rooms")
    public String rooms(HttpSession session, Model model){
        List<RoomModel> roomList = iRoomRepository.findAllByGame(iGameRepository.findById(1L).get());
        model.addAttribute("rooms", roomList);
        model.addAttribute("codUser",1);

        return "rooms";
    }
    @PostMapping("/fe_lobby")
    public String getLobby(@RequestBody BattleRequestDTO battleRequestDTO, Model model){
        model.addAttribute("codRoom", battleRequestDTO.codRoom());
        model.addAttribute("isPlayer1", battleRequestDTO.isPlayer1());
        model.addAttribute("status", battleRequestDTO.status());
        model.addAttribute("board", battleRequestDTO.board());
        model.addAttribute("codBattle",battleRequestDTO.codBattle());
        model.addAttribute("hasReturned", battleRequestDTO.hasReturned());
        model.addAttribute("codUser",1);

        return "redirect:/lobby";
    }
    @GetMapping("/lobby")
    public String getLobby(
                           @RequestParam long codBattle,
                          //HttpSession session
                           Model model) {
        //if(session.getAttribute("user") == null)
         //   return "redirect:/login";
        //AuthenticatedUser user = (AuthenticatedUser) session.getAttribute("user");
        long codUser = 1;
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        System.out.println("board");
        System.out.println(battle.getBoard());
        model.addAttribute("codRoom", battle.getRoom().getCodRoom());
        model.addAttribute("isPlayer1", battle.getPlayer1().getCodUser() == codUser);
        model.addAttribute("status", battle.getStatus());
        model.addAttribute("board", battle.getBoard());
        model.addAttribute("codBattle",codBattle);
        model.addAttribute("hasReturned", false);
        model.addAttribute("codUser",1);
        System.out.println("mambo");
        return "lobby";
    }
    @GetMapping("/reacteste")
    public String reactest(){
        return "reacteste";
    }
}

package com.example.demo.controllers.fe_controllers;

import com.example.demo.dtos.games.GameDTO;
import com.example.demo.models.game.GameModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.repositories.IRoomRepository;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.userdetails.User;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import java.util.List;

@Controller
public class JogoController {

    @Autowired
    private IGameRepository gameRepository;
    @Autowired
    private IRoomRepository iRoomRepository;
    @GetMapping("jogosList")
    public String jogosList(Model model){
        List<GameModel> gamesList = gameRepository.findAll();
        model.addAttribute("gamesList", gamesList);

        return "jogos-list";
    }
    @PostMapping("/jogoClick")
    public String jogoClick(@RequestParam("codGame") long codGame, HttpSession session, Model model, RedirectAttributes redirectAttributes){
        redirectAttributes.addAttribute("codGame", codGame);
        return "redirect:/salas";
    }


    @GetMapping("/salas")
    public String salas(@RequestParam("codGame") long codGame,HttpSession session, Model model){
        List<RoomModel> roomsList = iRoomRepository.findAllByGame(gameRepository.findById(codGame).get());
        model.addAttribute("roomsList",roomsList);
        return "salas";
    }
    @GetMapping("/entrar-no-jogo")
    public String entrarNoJogo(HttpSession session ,Model model){

        return "entrar-no-jogo";
    }
    @PostMapping("/entrar-sala")
    public String entrarSala(@RequestParam("codRoom") Long codRoom,HttpSession session, Model model, RedirectAttributes redirectAttributes){
        UserModel user = (UserModel) session.getAttribute("user");
        long codUser = user.getCodUser();
        Object roomsData = null;
        long codAutoRoom = codRoom;
        boolean isFriendsRoom = false;
        model.addAttribute("roomsData",roomsData);
        model.addAttribute("codUser", codUser);
        model.addAttribute("codAutoRoom", codAutoRoom);
        model.addAttribute("isFriendsRoom", isFriendsRoom);
        return "auto-room";
    }
    @GetMapping("/auto-room")
    public String autoRoom(HttpSession session, Model model){

        return "auto-room";
    }
}

package com.example.demo.controllers.fe_controllers;

import com.example.demo.dtos.games.GameDTO;
import com.example.demo.models.game.GameModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.repositories.IRoomRepository;
import com.example.demo.services.CommomMethods.CommonMethods;
import com.example.demo.services.exceptions.NotFoundException;
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
    @Autowired
    private CommonMethods commonMethods;
    @GetMapping("jogosList")
    public String jogosList(HttpSession session, Model model) throws NotFoundException {
        if(session.getAttribute("user") == null)
            return "redirect:/login";

        UserModel user = (UserModel) session.getAttribute("user");
        String isInBattle = commonMethods.isInBattle(user.getCodUser(), session, model);
        if(!isInBattle.equals(""))
            return isInBattle;
        List<GameModel> gamesList = gameRepository.findAll();
        model.addAttribute("gamesList", gamesList);

        return "jogos-list";
    }
    @PostMapping("/jogoClick")
    public String jogoClick(@RequestParam("codGame") long codGame, HttpSession session, Model model, RedirectAttributes redirectAttributes) throws NotFoundException {
        redirectAttributes.addAttribute("codGame", codGame);
        model.addAttribute("codGame",codGame);

        UserModel user = (UserModel) session.getAttribute("user");
        String isInBattle = commonMethods.isInBattle(user.getCodUser(), session, model);
        if(!isInBattle.equals(""))
            return isInBattle;
        return "redirect:/entrar-no-jogo";
    }


    @GetMapping("/salas")
    public String salas(@RequestParam("codGame") long codGame,HttpSession session, Model model) throws NotFoundException {
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        UserModel user = (UserModel) session.getAttribute("user");
        String isInBattle = commonMethods.isInBattle(user.getCodUser(), session, model);
        if(!isInBattle.equals(""))
            return isInBattle;
        List<RoomModel> roomsList = iRoomRepository.findAllByGame(gameRepository.findById(codGame).get());
        model.addAttribute("roomsList",roomsList);
        return "salas";
    }
    @GetMapping("/salas-friends")
    public String salasFriends(@RequestParam("codGame") long codGame,HttpSession session, Model model) throws NotFoundException {
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        UserModel user = (UserModel) session.getAttribute("user");
        String isInBattle = commonMethods.isInBattle(user.getCodUser(), session, model);
        if(!isInBattle.equals(""))
            return isInBattle;
        List<RoomModel> roomsList = iRoomRepository.findAllByGame(gameRepository.findById(codGame).get());
        model.addAttribute("roomsList",roomsList);
        return "salas-friends";
    }
    @GetMapping("/entrar-no-jogo")
    public String entrarNoJogo(@RequestParam("codGame") long codGame, HttpSession session ,Model model) throws NotFoundException {
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        UserModel user = (UserModel) session.getAttribute("user");
        String isInBattle = commonMethods.isInBattle(user.getCodUser(), session, model);
        if(!isInBattle.equals(""))
            return isInBattle;
        model.addAttribute("codGame",codGame);
        return "entrar-no-jogo";
    }
    @PostMapping("/entrar-sala")
    public String entrarSala(@RequestParam("codRoom") Long codRoom,HttpSession session, Model model, RedirectAttributes redirectAttributes){
        UserModel user = (UserModel) session.getAttribute("user");
        long codUser = user.getCodUser();
        Object roomsData = null;
        long codAutoRoom = codRoom;
        boolean isFriendsRooms = false;
        model.addAttribute("roomsData",roomsData);
        model.addAttribute("codUser", codUser);
        model.addAttribute("codAutoRoom", codAutoRoom);
        model.addAttribute("isFriendsRooms", isFriendsRooms);
        return "auto-room";
    }
    @PostMapping("entrar-sala-friends")
    public String entrarSalaFriends(@RequestParam("codRoom") Long codRoom,HttpSession session, Model model, RedirectAttributes redirectAttributes){
        UserModel user = (UserModel) session.getAttribute("user");
        long codUser = user.getCodUser();
        Object roomsData = null;
        long codAutoRoom = codRoom;
        boolean isFriendsRooms = true;
        model.addAttribute("roomsData",roomsData);
        model.addAttribute("codUser", codUser);
        model.addAttribute("codAutoRoom", codAutoRoom);
        model.addAttribute("isFriendsRooms", isFriendsRooms);
        return "auto-room";
    }
    @GetMapping("/auto-room")
    public String autoRoom(HttpSession session, Model model) throws NotFoundException {
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        UserModel user = (UserModel) session.getAttribute("user");
        String isInBattle = commonMethods.isInBattle(user.getCodUser(), session, model);
        if(!isInBattle.equals(""))
            return isInBattle;
        return "auto-room";
    }
}

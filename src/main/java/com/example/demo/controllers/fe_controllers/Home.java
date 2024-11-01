package com.example.demo.controllers.fe_controllers;

import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameType;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.services.CommomMethods.CommonMethods;
import com.example.demo.services.exceptions.NotFoundException;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.Optional;

@Controller
public class Home {
    @Autowired
    private CommonMethods commonMethods;
    @GetMapping("/index")
    public String index(HttpSession session, Model model) throws NotFoundException {
        if(session.getAttribute("user") == null)
            return "redirect:/login";
        UserModel user = (UserModel) session.getAttribute("user");
        String isInBattle = commonMethods.isInBattle(user.getCodUser(), session, model);
        if(!isInBattle.equals(""))
            return isInBattle;
        return "index";
    }

}

package com.example.demo.controllers.fe_controllers;

import com.example.demo.dtos.user.loginDTO;
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
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

@Controller
public class LoginController {

    private final UserService userService;

    @Autowired
    public LoginController(UserService userService) {
        this.userService = userService;
    }

    @GetMapping("/login")
    public String login(Model model) {
        model.addAttribute("loginDTO", new loginDTO());
        return "Loginxd";
    }

    @PostMapping("/login")
    public String loginForm(@ModelAttribute("loginDTO") loginDTO loginUserInputDTO, HttpSession session) throws InvalidUsernameOrPasswordException, InternalErrorException {
        AuthenticatedUser authenticatedUser = userService.login(loginUserInputDTO.getUsername(), loginUserInputDTO.getPassword());
        session.setAttribute("user", authenticatedUser.user());
        return "redirect:/";
    }
}
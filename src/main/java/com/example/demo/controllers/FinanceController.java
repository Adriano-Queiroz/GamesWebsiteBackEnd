package com.example.demo.controllers;

import com.example.demo.dtos.user.LoginUserInputDTO;
import com.example.demo.dtos.user.loginDTO;
import com.example.demo.models.user.AdminUser;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.UserModel;
import com.example.demo.services.UserService;
import com.example.demo.services.exceptions.InternalErrorException;
import com.example.demo.services.exceptions.InvalidUsernameOrPasswordException;
import jakarta.servlet.http.HttpSession;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;

@Controller
public class FinanceController {

    private final UserService userService;

    public FinanceController(UserService userService) {
        this.userService = userService;
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
    public String depositos(Model model){
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

}

package com.example.demo.controllers.fe_controllers;

import com.example.demo.dtos.forgot_password.ForgotPasswordRequestDTO;
import com.example.demo.dtos.reset_password.ResetPasswordRequestDTO;
import com.example.demo.dtos.user.CreateUserInputDTO;
import com.example.demo.dtos.user.loginDTO;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.UserModel;
import com.example.demo.services.UserService;
import com.example.demo.services.exceptions.*;
import jakarta.servlet.http.HttpSession;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

@Controller
public class AuthenticationController {

    private final UserService userService;

    @Autowired
    public AuthenticationController(UserService userService) {
        this.userService = userService;
    }

    @GetMapping("/login")
    public String login(Model model) {
        model.addAttribute("loginDTO", new loginDTO());
        return "login";
    }

    @PostMapping("/login")
    public String loginForm(@ModelAttribute("loginDTO") loginDTO loginUserInputDTO, HttpSession session) throws InvalidUsernameOrPasswordException, InternalErrorException {
        AuthenticatedUser authenticatedUser = userService.loginEmail(loginUserInputDTO.getEmail(), loginUserInputDTO.getPassword());
        session.setAttribute("user", authenticatedUser.user());
        return "redirect:/";
    }
    @GetMapping("/register")
    public String register(Model model){
        return "register";
    }
    @PostMapping("/register")
    public String registerUser(@ModelAttribute CreateUserInputDTO createUserInputDTO) throws AlreadyExistsException {
        UserModel user = userService.createUser(createUserInputDTO.username(),
                createUserInputDTO.email(),
                createUserInputDTO.password(),
                createUserInputDTO.cpf(),
                createUserInputDTO.phoneNumber());
        return "redirect:/login";
    }
    @PostMapping("/forgot-password")
    public void forgotPassword(@ModelAttribute ForgotPasswordRequestDTO forgotPasswordRequestDTO) throws NotFoundException, MaxEmailsPerHourException {
        userService.forgotPassword(forgotPasswordRequestDTO.email());
    }
    @GetMapping("/forgot-password")
    public String forgotPassword(Model model){
        return "forgot-password";
    }
    @PostMapping("/reset-password")
    public void resetPassword(@RequestBody ResetPasswordRequestDTO resetPasswordRequestDTO) throws NotFoundException, InvalidRequestException {
        userService.resetPassword(resetPasswordRequestDTO.email(),
                resetPasswordRequestDTO.forgotPasswordCode(),
                resetPasswordRequestDTO.newPassword());
    }
    @GetMapping("/usuarios")
    public String getVideos(Model model){

        return "usuarios";
    }
}
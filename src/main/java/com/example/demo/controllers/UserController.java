
package com.example.demo.controllers;

import com.example.demo.dtos.InfoDTO;
import com.example.demo.dtos.user.*;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.UserModel;
import com.example.demo.services.UserService;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController("/user")
public class UserController {

    UserService userService;

    public UserController(UserService userService){
        this.userService = userService;
    }

    @GetMapping("/{id}")
    public ResponseEntity<UserInfoOutputDTO> getUserById(@PathVariable long id) throws NotFoundException{
        UserModel user = userService.getUserById(id);
        UserInfoOutputDTO userInfoOutputDTO = new UserInfoOutputDTO(user.getCodUser(), user.getUsername(), user.getEmail());
        return ResponseEntity.ok(userInfoOutputDTO);
    }

    @PostMapping("/create")
    public ResponseEntity<CreateUserOutputDTO> createUser(@RequestBody CreateUserInputDTO createUserInputDTO){
        UserModel user = userService.createUser(createUserInputDTO);
        CreateUserOutputDTO createUserOutputDTO = new CreateUserOutputDTO(user.getCodUser(), user.getUsername(), user.getEmail());
        return ResponseEntity.status(201).body(createUserOutputDTO);
    }

    @PostMapping("/login")
    public ResponseEntity<LoginUserOutputDTO> login(@RequestBody LoginUserInputDTO loginUserInputDTO) throws NotFoundException {
        AuthenticatedUser authenticatedUser = userService.login(loginUserInputDTO);
        LoginUserOutputDTO output = new LoginUserOutputDTO(authenticatedUser.user().getCodUser(),authenticatedUser.token());
        return ResponseEntity.ok(output);
    }

    @PostMapping("/logout")
    public ResponseEntity<InfoDTO> logout(@RequestBody String token) {
        userService.logout(token);
        return ResponseEntity.status(200).body(new InfoDTO("User logged out"));
    }




}
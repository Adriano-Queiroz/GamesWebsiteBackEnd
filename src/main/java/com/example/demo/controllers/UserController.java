package com.example.demo.controllers;

import com.example.demo.dtos.user.CreateUserInputDTO;
import com.example.demo.dtos.user.CreateUserOutputDTO;
import com.example.demo.dtos.user.LoginUserInputDTO;
import com.example.demo.services.UserService;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

@RestController("/user")
public class UserController {

    UserService userService;

    public UserController(UserService userService){
        this.userService = userService;
    }

    @PostMapping("/create")
    public ResponseEntity<CreateUserOutputDTO> createUser(@RequestBody CreateUserInputDTO createUserInputDTO){
        CreateUserOutputDTO createUserOutputDTO = userService.createUser(createUserInputDTO);
        return ResponseEntity.status(201).body(createUserOutputDTO);
    }

    @PostMapping("/login")
    public ResponseEntity<String> login(@RequestBody LoginUserInputDTO loginUserInputDTO) {
        String token = userService.login(loginUserInputDTO);
        return ResponseEntity.ok(token);
    }




}

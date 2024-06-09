
package com.example.demo.controllers;

import com.example.demo.dtos.InfoDTO;
import com.example.demo.dtos.user.*;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.UserModel;
import com.example.demo.services.UserService;
import com.example.demo.services.exceptions.AlreadyExistsException;
import com.example.demo.services.exceptions.InternalErrorException;
import com.example.demo.services.exceptions.InvalidUsernameOrPasswordException;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.http.HttpHeaders;
import org.springframework.http.ResponseCookie;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;


@RestController
public class UserController {

    UserService userService;

    public UserController(UserService userService){
        this.userService = userService;
    }


    @GetMapping("user/{id}")
    public ResponseEntity<UserInfoOutputDTO> getUserById(@PathVariable long id) throws NotFoundException{
        UserModel user = userService.getUserById(id);
        UserInfoOutputDTO userInfoOutputDTO = new UserInfoOutputDTO(user.getCodUser(), user.getUsername(), user.getEmail());
        return ResponseEntity.ok(userInfoOutputDTO);
    }

    @PostMapping("user/create")
    public ResponseEntity<CreateUserOutputDTO> createUser(@RequestBody CreateUserInputDTO createUserInputDTO) throws AlreadyExistsException {
        UserModel user = userService.createUser(createUserInputDTO.username(), createUserInputDTO.email(), createUserInputDTO.password());
        CreateUserOutputDTO createUserOutputDTO = new CreateUserOutputDTO(user.getCodUser(), user.getUsername(), user.getEmail());
        return ResponseEntity.status(201).body(createUserOutputDTO);
    }

    @PostMapping("user/login")
    public ResponseEntity<LoginUserOutputDTO> login(@RequestBody LoginUserInputDTO loginUserInputDTO) throws InvalidUsernameOrPasswordException, InternalErrorException {
        AuthenticatedUser authenticatedUser = userService.login(loginUserInputDTO.username(), loginUserInputDTO.password());
        ResponseCookie cookie = ResponseCookie.from("token", authenticatedUser.token())
                .httpOnly(true)
                .maxAge(3600)
                .path("/")
                .build();
        LoginUserOutputDTO output = new LoginUserOutputDTO(authenticatedUser.user().getCodUser(),authenticatedUser.user().getUsername());
        return ResponseEntity.status(200).header(HttpHeaders.SET_COOKIE, cookie.toString()).body(output);
    }

    @PostMapping("user/logout")
    public ResponseEntity<InfoDTO> logout(AuthenticatedUser authenticatedUser) throws NotFoundException {
        userService.logout(authenticatedUser.token());
        ResponseCookie cookie = ResponseCookie.from("token", authenticatedUser.token())
                .httpOnly(true)
                .maxAge(0)
                .path("/")
                .build();
        return ResponseEntity.status(200).header(HttpHeaders.SET_COOKIE, cookie.toString()).body(new InfoDTO("User logged out"));
    }


}

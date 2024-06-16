
package com.example.demo.controllers;

import com.example.demo.dtos.InfoDTO;
import com.example.demo.dtos.battle.BattleDTO;
import com.example.demo.dtos.battle.IsInBattleDTO;
import com.example.demo.dtos.battle.LeaveBattleRequestDTO;
import com.example.demo.dtos.user.*;
import com.example.demo.models.user.AuthenticatedUser;
import com.example.demo.models.user.UserModel;
import com.example.demo.services.BattleService;
import com.example.demo.services.GamesService;
import com.example.demo.services.UserService;
import com.example.demo.services.exceptions.AlreadyExistsException;
import com.example.demo.services.exceptions.InternalErrorException;
import com.example.demo.services.exceptions.InvalidUsernameOrPasswordException;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.http.HttpHeaders;
import org.springframework.http.ResponseCookie;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;


@RestController
public class UserController {

    private UserService userService;
    private BattleService battleService;

    public UserController(UserService userService, BattleService battleService){
        this.userService = userService;
        this.battleService = battleService;
    }


    @GetMapping("user/{id}")
    public ResponseEntity<UserInfoOutputDTO> getUserById(@PathVariable long id) throws NotFoundException{
        UserModel user = userService.getUserById(id);
        UserInfoOutputDTO userInfoOutputDTO = new UserInfoOutputDTO(user.getCodUser(), user.getUsername(), user.getEmail(), user.getBalance());
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
    @GetMapping("/user/isInBattle/{codUser}")
    public ResponseEntity<IsInBattleDTO> isInBattle(@PathVariable long codUser) throws NotFoundException {
        return ResponseEntity.ok(battleService.isInBattle(codUser));
    }
    @DeleteMapping("/user/leaveBattle")
    public ResponseEntity<String> leaveBattle(@RequestBody LeaveBattleRequestDTO leaveBattleRequestDTO) throws NotFoundException{
        return ResponseEntity.ok(battleService.leaveBattle(
                leaveBattleRequestDTO.codUser(),
                leaveBattleRequestDTO.player()));
    }
    @GetMapping("/user/getBattleContext/{codUser}")
    public ResponseEntity<BattleDTO> getBattleContext(@PathVariable long codUser) throws NotFoundException {
        return userService.getBattleContext(codUser);
    }
}

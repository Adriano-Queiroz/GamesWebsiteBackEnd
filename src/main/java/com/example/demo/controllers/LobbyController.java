package com.example.demo.controllers;

import com.example.demo.dtos.lobby.*;
import com.example.demo.services.LobbyService;
import com.example.demo.services.exceptions.NotEnoughFundsException;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/lobby")
public class LobbyController {

    private final LobbyService lobbyService;

    @Autowired
    public LobbyController(LobbyService lobbyService) {
        this.lobbyService = lobbyService;
    }

    @PostMapping
    public ResponseEntity<LobbyResponseDTO> getLobby(@RequestBody LobbyRequestDTO lobbyRequestDTO) throws NotFoundException, NotEnoughFundsException {
        return lobbyService.getLobby(lobbyRequestDTO);
    }
    @DeleteMapping("/delete")
    public ResponseEntity<DeleteLobbyResponseDTO> deleteLobby(@RequestBody DeleteLobbyRequestDTO deleteLobbyRequestDTO) {
        long codLobby = lobbyService.deleteLobby(deleteLobbyRequestDTO.codUser());
        return ResponseEntity.ok(new DeleteLobbyResponseDTO(codLobby));
    }

    @PostMapping("/friend")
    public ResponseEntity<LobbyResponseDTO> getFriendsLobby(@RequestBody FriendsLobbyRequestDTO friendsLobbyRequestDTO) throws NotFoundException {
        //logic to send friend invite
        // need to create lobby first, then send invite with the lobby
        return lobbyService.getLobby(friendsLobbyRequestDTO);
    }

}

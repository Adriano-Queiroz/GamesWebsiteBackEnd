package com.example.demo.controllers;

import com.example.demo.dtos.lobby.DeleteLobbyRequestDTO;
import com.example.demo.dtos.lobby.DeleteLobbyResponseDTO;
import com.example.demo.dtos.lobby.LobbyRequestDTO;
import com.example.demo.dtos.lobby.LobbyResponseDTO;
import com.example.demo.services.LobbyService;
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
    public ResponseEntity<LobbyResponseDTO> getLobby(@RequestBody LobbyRequestDTO lobbyRequestDTO) throws NotFoundException {
        return lobbyService.getLobby(lobbyRequestDTO);
    }
    @DeleteMapping("/delete")
    public ResponseEntity<DeleteLobbyResponseDTO> deleteLobby(@RequestBody DeleteLobbyRequestDTO deleteLobbyRequestDTO) {
        long codLobby = lobbyService.deleteLobby(deleteLobbyRequestDTO.codUser());
        return ResponseEntity.ok(new DeleteLobbyResponseDTO(codLobby));
    }

}

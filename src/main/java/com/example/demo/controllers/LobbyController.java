package com.example.demo.controllers;

import com.example.demo.dtos.lobby.*;
import com.example.demo.repositories.ILobbyRepository;
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
    private final ILobbyRepository iLobbyRepository;

    @Autowired
    public LobbyController(LobbyService lobbyService, ILobbyRepository iLobbyRepository) {
        this.lobbyService = lobbyService;
        this.iLobbyRepository = iLobbyRepository;
    }

    @PostMapping
    public ResponseEntity<LobbyResponseDTO> getLobby(@RequestBody LobbyRequestDTO lobbyRequestDTO) throws NotFoundException, NotEnoughFundsException {
        return lobbyService.getLobby(lobbyRequestDTO);
    }
    @DeleteMapping("/delete/{codUser}")
    public ResponseEntity<String> deleteLobbyByCodUser(@PathVariable long codUser) {
        lobbyService.deleteLobby(codUser);
        return ResponseEntity.ok("Lobby cancelado com Sucesso");
    }

    @DeleteMapping("/delete-by-cod/{codLobby}")
    public ResponseEntity<DeleteLobbyResponseDTO> deleteLobby(@PathVariable long codLobby){
        iLobbyRepository.delete(iLobbyRepository.findById(codLobby).get());
        return ResponseEntity.ok(new DeleteLobbyResponseDTO(codLobby));
    }

    @PostMapping("/friend")
    public ResponseEntity<LobbyResponseDTO> getFriendsLobby(@RequestBody FriendsLobbyRequestDTO friendsLobbyRequestDTO) throws NotFoundException {
        //logic to send friend invite
        // need to create lobby first, then send invite with the lobby
        return lobbyService.getLobby(friendsLobbyRequestDTO);
    }

}

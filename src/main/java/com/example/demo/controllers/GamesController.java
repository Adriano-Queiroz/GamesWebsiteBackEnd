package com.example.demo.controllers;

import com.example.demo.dtos.games.GetGamesRequestDTO;
import com.example.demo.dtos.games.GetGamesResponseDTO;
import com.example.demo.models.game.GameModel;
import com.example.demo.repositories.IGameRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
@RequestMapping("/games")
public class GamesController {

    @Autowired
    private IGameRepository iGameRepository;
    @GetMapping
    public ResponseEntity<GetGamesResponseDTO> getGames(){
        List<GameModel> gamesList = iGameRepository.findAll();
        return ResponseEntity.ok(new GetGamesResponseDTO(
                gamesList.stream().map(GameModel::gameModelToDTO).toList()
                ));
    }

}

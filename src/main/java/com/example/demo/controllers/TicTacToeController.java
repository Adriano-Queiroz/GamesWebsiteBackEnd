package com.example.demo.controllers;

import com.example.demo.dtos.tictactoe.GetPossibleMovesRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveDTO;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.services.tictactoe.TicTacToeService;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController("/tictactoe")
public class TicTacToeController {
        TicTacToeService ticTacToeService;
        IBattleRepository iBattleRepository;
        public TicTacToeController(TicTacToeService ticTacToeService, IBattleRepository iBattleRepository){
            this.ticTacToeService = ticTacToeService;
            this.iBattleRepository = iBattleRepository;
        }
    @GetMapping("/getMoves")
    public ResponseEntity<char[][]> getPossibleMoves(@RequestBody GetPossibleMovesRequestDTO getPossibleMovesRequestDTO){
        char[][] possibleMoves = ticTacToeService.getPossibleMoves(getPossibleMovesRequestDTO.board());
        return ResponseEntity.ok(possibleMoves);
    } // nao eh suposto ter isto, quando enviamos a nova board para quem vai começar a ser a vez, enviamos os moves possiveis
    /*
    @PostMapping("makeMove")
    public ResponseEntity<char[][]> makeMove(@RequestBody MakeMoveDTO makeMoveDTO){
            //char[][] // receber board mudada do FE, serializar e enviar para a bd
        //envias
    }

     */
}

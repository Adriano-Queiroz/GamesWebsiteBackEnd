package com.example.demo.controllers;

import com.example.demo.Tuple;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.rest_battle.RestBattleMoveRequestDTO;
import com.example.demo.dtos.rest_battle.RestBattleMoveResponseDTO;
import com.example.demo.dtos.rest_battle.RestBattleResponseDTO;
import com.example.demo.dtos.tictactoe.MakeMoveRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.battle.Status;
import com.example.demo.models.game.GameType;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.services.exceptions.NotFoundException;
import com.example.demo.services.tictactoe.TicTacToeLogicService;
import com.example.demo.services.tictactoe.TicTacToeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("/rest_battle")
public class BattleRestController {

    //GetBoard e status
    @Autowired
    private IBattleRepository iBattleRepository;
    @Autowired
    private TicTacToeLogicService ticTacToeLogicService;
    @Autowired
    private TicTacToeService ticTacToeService;

    @GetMapping("/getInfo/{codBattle}")
    public ResponseEntity<RestBattleResponseDTO> getInfo(@PathVariable long codBattle) throws NotFoundException {
        Optional<BattleModel> optionalBattle = iBattleRepository.findById(codBattle);
        if(!optionalBattle.isPresent())
            throw new NotFoundException("Batalha não encontrada");
        BattleModel battle = optionalBattle.get();

        return ResponseEntity.ok(new RestBattleResponseDTO(battle.getStatus().toString(), battle.getBoard()));
    }
    //Makemove (changes status)
    @PostMapping("/move")
    public ResponseEntity<MakeMoveResponseDTO> move(@RequestBody MakeMoveRequestDTO makeMoveRequestDTO){
        MakeMoveResponseDTO responseDTO =  ticTacToeLogicService.makeMove(makeMoveRequestDTO);
        Tuple hasFinishedTuple = ticTacToeLogicService.hasFinished(((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, responseDTO.board()))
                .getBoard());
        if(hasFinishedTuple.hasFinished()){
            Status status = ticTacToeService.RestTreatFinishedGame(hasFinishedTuple,responseDTO.codBattle());
            responseDTO = new MakeMoveResponseDTO(
                    responseDTO.board(),
                    responseDTO.possibleMoves(),
                    responseDTO.codBattle(),
                    status.toString()
            );
        }
        return ResponseEntity.ok(responseDTO);
    }
}


package com.example.demo.controllers;

import com.example.demo.Tuple;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.tictactoe.MakeMoveRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.game.GameType;
import com.example.demo.services.tictactoe.TicTacToeLogicService;
import com.example.demo.services.tictactoe.TicTacToeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.handler.annotation.MessageMapping;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestBody;


@Controller
public class TicTacToeController {

    @Autowired
    private TicTacToeLogicService ticTacToeLogicService;
    @Autowired
    private TicTacToeService ticTacToeService;

    @Autowired
    private SimpMessagingTemplate messagingTemplate;

    @MessageMapping("/move")
    //send to ???
    public void makeMove(@RequestBody MakeMoveRequestDTO makeMoveRequestDTO) throws Exception {
        System.out.println("ayo");
        MakeMoveResponseDTO responseDTO = ticTacToeLogicService.makeMove(makeMoveRequestDTO);
        Tuple hasFinishedTuple = ticTacToeLogicService.hasFinished(((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, responseDTO.board()))
                .getBoard());

        if(!hasFinishedTuple.hasFinished()){
            ticTacToeService.treatUnfinishedGame(
                    messagingTemplate,
                    responseDTO.codBattle(),
                    makeMoveRequestDTO.player(),
                    responseDTO
            );
        }else{
            ticTacToeService.treatFinishedGame(
                    hasFinishedTuple,
                    messagingTemplate,
                    responseDTO.codBattle()
            );
        }

    }
}

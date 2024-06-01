package com.example.demo.controllers;

import com.example.demo.Tuple;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.tictactoe.EndGameResponseDTO;
import com.example.demo.dtos.tictactoe.MakeMoveRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.Status;
import com.example.demo.models.game.GameType;
import com.example.demo.services.tictactoe.TicTacToeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.handler.annotation.MessageMapping;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Controller;


@Controller
public class TicTacToeController {

    @Autowired
    private TicTacToeService ticTacToeService;

    @Autowired
    private SimpMessagingTemplate messagingTemplate;

    @MessageMapping("/move")
    public void makeMove(MakeMoveRequestDTO makeMoveRequestDTO) throws Exception {
        System.out.println("ayo");
        MakeMoveResponseDTO responseDTO = ticTacToeService.makeMove(makeMoveRequestDTO);
        Tuple<Boolean,String> hasWinnernTuple = ticTacToeService.hasWinner(((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, responseDTO.board()))
                .getBoard());

        if(!hasWinnernTuple.hasWinner()){
            messagingTemplate.convertAndSend(
                    "/topic/game/" + responseDTO.codBattle() +"/" + makeMoveRequestDTO.player(),
                    responseDTO);
        }else{
            String status = (hasWinnernTuple.winner().equals("X") ? Status.P1_WON : Status.P2_WON).toString();
            messagingTemplate.convertAndSend(
                    "/topic/game/" + responseDTO.codBattle() +"/1",
                    new EndGameResponseDTO(status));

            messagingTemplate.convertAndSend(
                    "/topic/game/" + responseDTO.codBattle() +"/2",
                    new EndGameResponseDTO(status));
        }


    }
}

package com.example.demo.controllers;

import com.example.demo.dtos.tictactoe.MakeMoveRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
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

        messagingTemplate.convertAndSend(
                "/topic/game/" + responseDTO.codBattle() +"/" + makeMoveRequestDTO.player(), responseDTO);

    }
}

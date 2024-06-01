package com.example.demo.services.tictactoe;

import com.example.demo.Tuple;
import com.example.demo.dtos.tictactoe.EndGameResponseDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.models.battle.Status;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IUserModelRepository;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Service;

@Service
public class TicTacToeService {
    IBattleRepository iBattleRepository;
    IUserModelRepository iUserModelRepository;

    public void treatFinishedGame(Tuple hasFinishedTuple, SimpMessagingTemplate messagingTemplate, long codBattle){
        String status = (hasFinishedTuple.winner().equals("X") ? Status.P1_WON :
                hasFinishedTuple.winner().equals("O") ? Status.P2_WON : Status.DRAW)
                .toString();
        messagingTemplate.convertAndSend(
                "/topic/game/" + codBattle +"/1",
                new EndGameResponseDTO(status));

        messagingTemplate.convertAndSend(
                "/topic/game/" + codBattle +"/2",
                new EndGameResponseDTO(status));
    }
    public void treatUnfinishedGame(SimpMessagingTemplate messagingTemplate, long codBattle, String player, MakeMoveResponseDTO responseDTO){
        messagingTemplate.convertAndSend(
                "/topic/game/" + codBattle +"/" + player,
                responseDTO);
    }
}

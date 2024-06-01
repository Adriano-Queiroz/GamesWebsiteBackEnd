package com.example.demo.services.tictactoe;

import com.example.demo.Tuple;
import com.example.demo.dtos.tictactoe.EndGameResponseDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.battle.Status;
import com.example.demo.models.game.GameModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IGameRepository;
import com.example.demo.repositories.IUserModelRepository;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Service;

import java.util.Optional;

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
    public void treatBets(Status status, long codPlayer1, long codPlayer2, long codBattle){
        UserModel user1 = iUserModelRepository.findById(codPlayer1).get();
        UserModel user2 = iUserModelRepository.findById(codPlayer2).get();
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        double housePercentage = battle.getGame().getHousePercentage();
        double bet = battle.getBet();
        double betToContabilize = bet * (1.00-housePercentage);
        double houseAmount = bet - betToContabilize;
        if(status==Status.P1_WON){
            user1.setBalance(user1.getBalance() + betToContabilize);
            user2.setBalance(user2.getBalance() - bet);
        }else if(status == Status.P2_WON){
            user2.setBalance(user2.getBalance() + betToContabilize);
            user1.setBalance(user1.getBalance() - bet);
        }else{
            user1.setBalance(user1.getBalance() - houseAmount);
            user1.setBalance(user1.getBalance() - houseAmount);
        }
    }
}

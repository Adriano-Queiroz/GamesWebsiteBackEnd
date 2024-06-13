package com.example.demo.services.tictactoe;

import com.example.demo.Tuple;
import com.example.demo.dtos.tictactoe.EndGameResponseDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.battle.Status;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IUserModelRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Service;

@Service
public class TicTacToeService {
    IBattleRepository iBattleRepository;
    IUserModelRepository iUserModelRepository;
    @Autowired
    public TicTacToeService(IBattleRepository iBattleRepository, IUserModelRepository iUserModelRepository){
        this.iBattleRepository = iBattleRepository;
        this.iUserModelRepository = iUserModelRepository;
    }

    public void treatFinishedGame(Tuple hasFinishedTuple, SimpMessagingTemplate messagingTemplate, long codBattle){
        String status = (hasFinishedTuple.winner().equals("X") ? Status.P1_WON :
                hasFinishedTuple.winner().equals("O") ? Status.P2_WON : Status.DRAW)
                .toString();
        messagingTemplate.convertAndSend(
                "/topic/battle/" + codBattle +"/X",
                new EndGameResponseDTO(status));

        messagingTemplate.convertAndSend(
                "/topic/battle/" + codBattle +"/O",
                new EndGameResponseDTO(status));
        
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        UserModel user1 = battle.getPlayer1();
        UserModel user2 = battle.getPlayer2();

        treatBets(Status.valueOf(status),user1,user2,battle);
    }
    public Status RestTreatFinishedGame(Tuple hasFinishedTuple, long codBattle){
        Status status = (hasFinishedTuple.winner().equals("X") ? Status.P1_WON :
                hasFinishedTuple.winner().equals("O") ? Status.P2_WON : Status.DRAW);

        BattleModel battle = iBattleRepository.findById(codBattle).get();
        UserModel user1 = battle.getPlayer1();
        UserModel user2 = battle.getPlayer2();
        battle.setStatus(status);
        treatBets(status,user1,user2,battle);
        iBattleRepository.save(battle);
        return status;
    }
    public void treatUnfinishedGame(SimpMessagingTemplate messagingTemplate, long codBattle, String player, MakeMoveResponseDTO responseDTO){
        messagingTemplate.convertAndSend(
                "/topic/battle/" + codBattle +"/" + player,
                responseDTO);
    }
    public void treatBets(Status status, UserModel user1, UserModel user2, BattleModel battle){
        double housePercentage = battle.getRoom().getGame().getHousePercentage();
        double bet = battle.getRoom().getBet();
        double betToContabilize = bet * (1.00-housePercentage);
        double houseAmount = bet - betToContabilize;
        if(status==Status.P1_WON){
            System.out.println("P1 Won");
            user1.setBalance(user1.getBalance() + betToContabilize);
            user2.setBalance(user2.getBalance() - bet);
        }else if(status == Status.P2_WON){
            System.out.println("P2 Won");
            user2.setBalance(user2.getBalance() + betToContabilize);
            user1.setBalance(user1.getBalance() - bet);
        }else{
            System.out.println("DRAW");
            user1.setBalance(user1.getBalance() - houseAmount);
            user1.setBalance(user1.getBalance() - houseAmount);
        }
        iUserModelRepository.save(user1);
        iUserModelRepository.save(user2);
    }
}

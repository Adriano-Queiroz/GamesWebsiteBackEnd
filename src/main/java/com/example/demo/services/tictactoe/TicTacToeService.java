package com.example.demo.services.tictactoe;

import com.example.demo.Tuple;
import com.example.demo.dtos.tictactoe.EndGameResponseDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.battle.Status;
import com.example.demo.models.history.HistoryModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IHistoryRepository;
import com.example.demo.repositories.IUserModelRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Service;

@Service
public class TicTacToeService {
    IBattleRepository iBattleRepository;
    IUserModelRepository iUserModelRepository;
    IHistoryRepository iHistoryRepository;
    @Autowired
    public TicTacToeService(IBattleRepository iBattleRepository, IUserModelRepository iUserModelRepository, IHistoryRepository iHistoryRepository){
        this.iBattleRepository = iBattleRepository;
        this.iUserModelRepository = iUserModelRepository;
        this.iHistoryRepository = iHistoryRepository;
    }

    public void treatFinishedGame(Tuple hasFinishedTuple, SimpMessagingTemplate messagingTemplate, long codBattle){
        Status status = (hasFinishedTuple.winner().equals("X") ? Status.P1_WON :
                hasFinishedTuple.winner().equals("O") ? Status.P2_WON : Status.DRAW);

        
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        UserModel user1 = battle.getPlayer1();
        UserModel user2 = battle.getPlayer2();
        HistoryModel history = new HistoryModel();
        history.setPlayer1(user1);
        history.setPlayer2(user2);
        history.setCodBattle(battle.getCodBattle());
        history.setRoom(battle.getRoom());
        history.setStatus(status);
        history.setBoard(battle.getBoard());
        iHistoryRepository.save(history);

        treatBets(status,user1,user2,battle);
        messagingTemplate.convertAndSend(
                "/topic/battle/" + codBattle +"/X",
                new EndGameResponseDTO(status.toString(), battle.getBoard()));

        messagingTemplate.convertAndSend(
                "/topic/battle/" + codBattle +"/O",
                new EndGameResponseDTO(status.toString(), battle.getBoard()));
    }
    public Status RestTreatFinishedGame(Tuple hasFinishedTuple, long codBattle){
        Status status = (hasFinishedTuple.winner().equals("X") ? Status.P1_WON :
                hasFinishedTuple.winner().equals("O") ? Status.P2_WON : Status.DRAW);

        BattleModel battle = iBattleRepository.findById(codBattle).get();
        UserModel user1 = battle.getPlayer1();
        UserModel user2 = battle.getPlayer2();
        battle.setStatus(status);
        treatBets(status,user1,user2,battle);
        //iBattleRepository.save(battle);
        return status;
    }
    public void treatUnfinishedGame(SimpMessagingTemplate messagingTemplate, long codBattle, String player, MakeMoveResponseDTO responseDTO){
        messagingTemplate.convertAndSend(
                "/topic/battle/" + codBattle +"/" + player,
                responseDTO);
    }
    public void treatNullUser1(UserModel user2, Status status, BattleModel battle, double bet, double betToContabilize, double houseAmount){
        if(status==Status.P1_WON)
            user2.setBalance(user2.getBalance() - bet);
        else if(status == Status.P2_WON)
            user2.setBalance(user2.getBalance() + betToContabilize);
        else
            user2.setBalance(user2.getBalance() - houseAmount);
        iUserModelRepository.save(user2);
        iBattleRepository.delete(battle);
    }
    public void treatNullUser2(UserModel user1, Status status, BattleModel battle,  double bet, double betToContabilize, double houseAmount){
        if(status==Status.P1_WON)
            user1.setBalance(user1.getBalance() + betToContabilize);
        else if(status == Status.P2_WON)
            user1.setBalance(user1.getBalance() - bet);
        else
            user1.setBalance(user1.getBalance() - houseAmount);
        iUserModelRepository.save(user1);
        iBattleRepository.delete(battle);
    }
    public void treatBets(Status status, UserModel user1, UserModel user2, BattleModel battle){

        double housePercentage = battle.getRoom().getGame().getHousePercentage();
        double bet = battle.getRoom().getBet();
        double betToContabilize = bet * (1.00-housePercentage);
        double houseAmount = bet - betToContabilize;
        if(user1 == null){
            treatNullUser1(user2,status,battle, bet, betToContabilize,houseAmount);
            return;
        }
        if(user2 == null){
            treatNullUser2(user1,status,battle,bet,betToContabilize,houseAmount);
            return;
        }
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
            user2.setBalance(user2.getBalance() - houseAmount);
            user1.setBalance(user1.getBalance() - houseAmount);
        }
        iUserModelRepository.save(user1);
        iUserModelRepository.save(user2);
        iBattleRepository.delete(battle);
    }
}

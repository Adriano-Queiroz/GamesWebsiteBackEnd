package com.example.demo.services;

import com.example.demo.models.game.GameType;
import com.example.demo.services.tictactoe.TicTacToeLogicService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class GamesService {
    @Autowired
    private TicTacToeLogicService ticTacToeLogicService;
    public String getEmptyBoard(GameType gameType){
        if(gameType==GameType.TICTACTOE)
            return ticTacToeLogicService.getEmptyBoardAsJson();
        return "";
    }
}

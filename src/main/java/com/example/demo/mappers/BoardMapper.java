package com.example.demo.mappers;

import com.example.demo.boards.Board;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.models.game.GameType;
import com.google.gson.Gson;

public class BoardMapper {

    public static Board getBoard(GameType gameType, String board){
        if(gameType == GameType.TICTACTOE){
            Gson gson = new Gson();
            System.out.println("Board in GSON: \n" + board);
            TicTacToeBoard ticTacToeBoard = new TicTacToeBoard(gson.fromJson(board, String[][].class));
            String[][] boardArray = ticTacToeBoard.getBoard();
            System.out.println("BOARD:");
            for(int i = 0;i < boardArray.length;i++){
                System.out.println(boardArray[i]);
            }
            return ticTacToeBoard;
        }
        return null;
    }
}

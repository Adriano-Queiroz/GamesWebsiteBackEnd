package com.example.demo.services;

import com.example.demo.models.game.GameType;
import com.example.demo.services.tictactoe.TicTacToeLogicService;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;
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
    public String getPossibleMoves(String[][] board,GameType gameType) {
        if(gameType == GameType.TICTACTOE){
            ObjectMapper mapper = new ObjectMapper();
            ArrayNode movesArray = mapper.createArrayNode();

            // Iterate through the board to find empty cells
            for (int i = 0; i < board.length; i++) {
                for (int j = 0; j < board[i].length; j++) {
                    if (board[i][j].equals("")) { // '\u0000' represents an empty cell in char
                        ObjectNode moveNode = mapper.createObjectNode();
                        moveNode.put("row", i);
                        moveNode.put("column", j);
                        movesArray.add(moveNode);
                    }
                }
            }

            // Convert ArrayNode to JSON String
            return movesArray.toString();
        }
       return null;
    }
}

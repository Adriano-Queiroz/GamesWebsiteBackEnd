package com.example.demo.services.tictactoe;

import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.tictactoe.MakeMoveRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameType;
import com.example.demo.repositories.IBattleRepository;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

@Service
public class TicTacToeService {
    private final IBattleRepository iBattleRepository;

    @Autowired
    public TicTacToeService(IBattleRepository iBattleRepository){
        this.iBattleRepository = iBattleRepository;
    }
    public String getPossibleMoves(String[][] board) {
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
    /*
    public char[][] makeMove(char[][] board, char player, int column, int row){
        // Make sure the specified position is within the board's bounds and is empty
        if (row < 0 || row >= board.length || column < 0 || column >= board[0].length || board[row][column] != '\u0000') {
            // Invalid move, return the board unchanged
            return board;
        }

        // Update the board with the player's symbol at the specified position
        board[row][column] = player;

        return board;
    }

     */
    public MakeMoveResponseDTO makeMove(MakeMoveRequestDTO makeMoveRequestDTO){
        System.out.println("ayo2 cod battle:" + makeMoveRequestDTO.codBattle());
        System.out.println(makeMoveRequestDTO.toString());
        Optional<BattleModel> battleOptional = iBattleRepository.findById(makeMoveRequestDTO.codBattle());
        System.out.println("ayo3 battle optional:" + battleOptional);
        String board = makeMoveRequestDTO.board();
        System.out.println("ayo4");
        String[][] boardArray = ((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, board))
                .getBoard();

        if(battleOptional.isPresent()){
            BattleModel battle = battleOptional.get();
            System.out.println("Setting board: " + board);
            battle.setBoard(board);
            iBattleRepository.save(battle);
            return new MakeMoveResponseDTO(board,getPossibleMoves(boardArray),
                    makeMoveRequestDTO.codBattle(),
                    battle.swapStatus());
        }
        return null;
    }
}

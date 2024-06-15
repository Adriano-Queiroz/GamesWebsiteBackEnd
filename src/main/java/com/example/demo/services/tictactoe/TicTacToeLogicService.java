package com.example.demo.services.tictactoe;

import com.example.demo.Tuple;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.tictactoe.MakeMoveRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.battle.Status;
import com.example.demo.models.game.GameType;
import com.example.demo.repositories.IBattleRepository;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;
import com.google.gson.Gson;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class TicTacToeLogicService {
    private final IBattleRepository iBattleRepository;

    @Autowired
    public TicTacToeLogicService(IBattleRepository iBattleRepository){
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
        Optional<BattleModel> battleOptional = iBattleRepository.findById(makeMoveRequestDTO.codBattle());
        System.out.println("BATTLE COD DTO:" + makeMoveRequestDTO.codBattle());
        if(battleOptional.isPresent()){
            BattleModel battle = battleOptional.get();
            String board = makeMoveRequestDTO.board();
            String[][] boardArray = ((TicTacToeBoard)
                    BoardMapper.getBoard(GameType.TICTACTOE, board))
                    .getBoard();
            System.out.println("Setting board: " + board);
            battle.setBoard(board);
            battle.setStatus(battle.swapStatus());
            iBattleRepository.save(battle);
            return new MakeMoveResponseDTO(board,getPossibleMoves(boardArray),
                    makeMoveRequestDTO.codBattle(),
                    battle.getStatus().toString());
        }
        return null;
    }
    public Tuple hasFinished(String[][] board) {
        // Check rows for a winner
        for (int i = 0; i < 3; i++) {
            if (board[i][0].equals(board[i][1]) && board[i][1].equals(board[i][2]) && !board[i][0].equals("")) {
                return new Tuple(true, board[i][0]);
            }
        }
        // Check columns for a winner
        for (int i = 0; i < 3; i++) {
            if (board[0][i].equals(board[1][i]) && board[1][i].equals(board[2][i]) && !board[0][i].equals("")) {
                return new Tuple(true, board[0][i]);
            }
        }
        // Check diagonals for a winner
        if ((board[0][0].equals(board[1][1]) && board[1][1].equals(board[2][2]) && !board[0][0].equals("")) ||
                (board[0][2].equals(board[1][1]) && board[1][1].equals(board[2][0]) && !board[0][2].equals(""))) {
            return new Tuple(true, board[1][1]);
        }
        boolean isFull = true;
        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                if (board[i][j].equals("")) {
                    isFull = false;
                    break;
                }
            }
            if (!isFull) {
                break;
            }
        }

        // If the board is full and there's no winner, it's a draw
        if (isFull) {
            return new Tuple(true, "");
        }

        return new Tuple(false, ""); // No winner found
    }
    public String[][] getEmptyBoard() {
        return new String[][] {
                {"", "", ""},
                {"", "", ""},
                {"", "", ""}
        };
    }
    public String getEmptyBoardAsJson(){
        Gson gson = new Gson();
        return gson.toJson(getEmptyBoard());
    }

}

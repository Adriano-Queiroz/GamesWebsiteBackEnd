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
    public String[][] makeBotMove(String[][] board, String player, GameType gameType) {
        if(gameType == GameType.TICTACTOE){
            Move bestMove = findBestMove(board, player);
            board[bestMove.row][bestMove.col] = player;
            return board;
        }
        return null;
    }

    private static class Move {
        int row, col;

        Move(int row, int col) {
            this.row = row;
            this.col = col;
        }
    }

    private static Move findBestMove(String[][] board, String player) {
        String opponent = player.equals("X") ? "O" : "X";
        int bestVal = Integer.MIN_VALUE;
        Move bestMove = new Move(-1, -1);

        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                if (board[i][j] == null || board[i][j].isEmpty()) {
                    board[i][j] = player;
                    int moveVal = minimax(board, 0, false, player, opponent);
                    board[i][j] = "";

                    if (moveVal > bestVal) {
                        bestMove.row = i;
                        bestMove.col = j;
                        bestVal = moveVal;
                    }
                }
            }
        }
        return bestMove;
    }

    private static int minimax(String[][] board, int depth, boolean isMax, String player, String opponent) {
        int score = evaluate(board, player, opponent);

        if (score == 10) {
            return score - depth;
        }
        if (score == -10) {
            return score + depth;
        }
        if (!isMovesLeft(board)) {
            return 0;
        }

        if (isMax) {
            int best = Integer.MIN_VALUE;

            for (int i = 0; i < 3; i++) {
                for (int j = 0; j < 3; j++) {
                    if (board[i][j] == null || board[i][j].isEmpty()) {
                        board[i][j] = player;
                        best = Math.max(best, minimax(board, depth + 1, !isMax, player, opponent));
                        board[i][j] = "";
                    }
                }
            }
            return best;
        } else {
            int best = Integer.MAX_VALUE;

            for (int i = 0; i < 3; i++) {
                for (int j = 0; j < 3; j++) {
                    if (board[i][j] == null || board[i][j].isEmpty()) {
                        board[i][j] = opponent;
                        best = Math.min(best, minimax(board, depth + 1, !isMax, player, opponent));
                        board[i][j] = "";
                    }
                }
            }
            return best;
        }
    }

    private static boolean isMovesLeft(String[][] board) {
        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                if (board[i][j] == null || board[i][j].isEmpty()) {
                    return true;
                }
            }
        }
        return false;
    }

    private static int evaluate(String[][] board, String player, String opponent) {
        for (int row = 0; row < 3; row++) {
            if (board[row][0] == board[row][1] && board[row][1] == board[row][2]) {
                if (board[row][0] == player) {
                    return 10;
                } else if (board[row][0] == opponent) {
                    return -10;
                }
            }
        }

        for (int col = 0; col < 3; col++) {
            if (board[0][col] == board[1][col] && board[1][col] == board[2][col]) {
                if (board[0][col] == player) {
                    return 10;
                } else if (board[0][col] == opponent) {
                    return -10;
                }
            }
        }

        if (board[0][0] == board[1][1] && board[1][1] == board[2][2]) {
            if (board[0][0] == player) {
                return 10;
            } else if (board[0][0] == opponent) {
                return -10;
            }
        }

        if (board[0][2] == board[1][1] && board[1][1] == board[2][0]) {
            if (board[0][2] == player) {
                return 10;
            } else if (board[0][2] == opponent) {
                return -10;
            }
        }

        return 0;
    }
}

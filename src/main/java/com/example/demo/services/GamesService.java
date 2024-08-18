package com.example.demo.services;

import com.example.demo.models.game.GameType;
import com.example.demo.services.tictactoe.State;
import com.example.demo.services.tictactoe.TicTacToeLogicService;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;

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
    public String[][] makeBotMove(String[][] board, String player, GameType gameType, int position) {
        if(gameType == GameType.TICTACTOE){
            Move bestMove = findBestMove(board, player);
            board[bestMove.row][bestMove.col] = player;
            return board;
        }
        return null;
    }
    public int findDifferingCellIndex(String[][] board1, String[][] board2) {

        if (board1.length != 3 || board2.length != 3) {
            throw new IllegalArgumentException("Both boards must be 3x3.");
        }

        for (int i = 0; i < 3; i++) {
            if (board1[i].length != 3 || board2[i].length != 3) {
                throw new IllegalArgumentException("Both boards must be 3x3.");
            }
        }

        boolean foundDifference = false;
        int differingIndex = -1;
        int OIndex = -1;
        for (int row = 0; row < 3; row++) {
            for (int col = 0; col < 3; col++) {
                if(board1[row][col].equals("O"))
                    OIndex = row * 3 + col;
                if (!board1[row][col].equals(board2[row][col])) {
                    if (foundDifference) {
                        if(OIndex!=-1)
                            return OIndex;
                        else if(row < 2 && col < 2)
                            continue;
                        // More than one difference found; this case should not happen as per the given problem constraints
                        throw new IllegalStateException("There should be exactly one difference between the boards.");
                    }
                    differingIndex = row * 3 + col;
                    foundDifference = true;
                }
            }
        }

        if (!foundDifference) {
            return -1; // Boards are identical
        }

        return differingIndex;
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
        State initialState = new State(-1, board);
        int bestMoveIndex = -1;
        int bestVal = (player.equals("X")) ? Integer.MIN_VALUE : Integer.MAX_VALUE;

        for (State possibleMove : successorsOf(initialState)) {
            int moveVal;
            if (player.equals("X")) {
                moveVal = minValue(possibleMove, Integer.MIN_VALUE, Integer.MAX_VALUE);
                if (moveVal > bestVal) {
                    bestVal = moveVal;
                    bestMoveIndex = possibleMove.getPosition();
                }
            } else {
                moveVal = maxValue(possibleMove, Integer.MIN_VALUE, Integer.MAX_VALUE);
                if (moveVal < bestVal) {
                    bestVal = moveVal;
                    bestMoveIndex = possibleMove.getPosition();
                }
            }
        }

        return new Move(bestMoveIndex / 3, bestMoveIndex % 3);
    }

    private static int maxValue(State state, int alpha, int beta) {
        if (isTerminal(state)) {
            return utilityOf(state);
        }
        int v = Integer.MIN_VALUE;

        for (State possibleMove : successorsOf(state)) {
            v = Math.max(v, minValue(possibleMove, alpha, beta));
            if (v >= beta) {
                return v; // Beta cutoff
            }
            alpha = Math.max(alpha, v);
        }
        return v;
    }

    private static int minValue(State state, int alpha, int beta) {
        if (isTerminal(state)) {
            return utilityOf(state);
        }
        int v = Integer.MAX_VALUE;

        for (State possibleMove : successorsOf(state)) {
            v = Math.min(v, maxValue(possibleMove, alpha, beta));
            if (v <= alpha) {
                return v; // Alpha cutoff
            }
            beta = Math.min(beta, v);
        }
        return v;
    }

    private static int utilityOf(State state) {
        for (int a = 0; a < 8; a++) {
            String line = checkState(state, a);
            if (line.equals("XXX")) {
                return 1; // Win for X
            } else if (line.equals("OOO")) {
                return -1; // Win for O
            }
        }
        return 0; // No win
    }

    public static boolean isTerminal(State state) {
        // Check if there's a win
        for (int a = 0; a < 8; a++) {
            String line = checkState(state, a);
            if (line.equals("XXX") || line.equals("OOO")) {
                return true;
            }
        }

        // Check if the board is full (draw)
        for (String spot : state.getState()) {
            if (!spot.equals("X") && !spot.equals("O")) {
                return false; // There's at least one empty spot
            }
        }

        return true; // It's a draw
    }

    private static String checkState(State state, int a) {
        return switch (a) {
            case 0 -> state.getStateIndex(0) + state.getStateIndex(1) + state.getStateIndex(2);
            case 1 -> state.getStateIndex(3) + state.getStateIndex(4) + state.getStateIndex(5);
            case 2 -> state.getStateIndex(6) + state.getStateIndex(7) + state.getStateIndex(8);
            case 3 -> state.getStateIndex(0) + state.getStateIndex(3) + state.getStateIndex(6);
            case 4 -> state.getStateIndex(1) + state.getStateIndex(4) + state.getStateIndex(7);
            case 5 -> state.getStateIndex(2) + state.getStateIndex(5) + state.getStateIndex(8);
            case 6 -> state.getStateIndex(0) + state.getStateIndex(4) + state.getStateIndex(8);
            case 7 -> state.getStateIndex(2) + state.getStateIndex(4) + state.getStateIndex(6);
            default -> "";
        };
    }

    private static ArrayList<State> successorsOf(State state) {
        ArrayList<State> possibleMoves = new ArrayList<>();
        String player = determineCurrentPlayer(state);

        for (int i = 0; i < 9; i++) {
            if (!state.getStateIndex(i).equals("X") && !state.getStateIndex(i).equals("O")) {
                String[] newState = state.getState().clone();
                newState[i] = player;
                possibleMoves.add(new State(i, newState));
            }
        }
        return possibleMoves;
    }

    private static String determineCurrentPlayer(State state) {
        int xMoves = 0;
        int oMoves = 0;
        for (String s : state.getState()) {
            if (s.equals("X")) {
                xMoves++;
            } else if (s.equals("O")) {
                oMoves++;
            }
        }
        return (xMoves <= oMoves) ? "X" : "O";
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

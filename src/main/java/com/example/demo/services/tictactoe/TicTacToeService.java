package com.example.demo.services.tictactoe;

import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Service
public class TicTacToeService {

    public char[][] getPossibleMoves(char[][] board) {
        List<int[]> possibleMoves = new ArrayList<>();

        // Iterate through the board to find empty cells
        for (int i = 0; i < board.length; i++) {
            for (int j = 0; j < board[i].length; j++) {
                if (board[i][j] == '\u0000') { // '\u0000' represents an empty cell in char
                    possibleMoves.add(new int[]{i, j});
                }
            }
        }

        // Convert list of possible moves to 2D array
        char[][] result = new char[possibleMoves.size()][2];
        for (int i = 0; i < possibleMoves.size(); i++) {
            result[i] = new char[]{(char) (possibleMoves.get(i)[0] + '0'), (char) (possibleMoves.get(i)[1] + '0')};
        }

        return result;
    }
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
}

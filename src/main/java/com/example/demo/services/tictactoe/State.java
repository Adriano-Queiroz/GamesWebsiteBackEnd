package com.example.demo.services.tictactoe;
import java.util.Arrays;

public class State {
    private int position;
    private String[] state;

    public State(int position, String[] state) {
        this.position = position;
        this.state = state;
    }
    public State(int position, String[][] stateBoard) {
        this.position = position;
        this.state = new String[9];  // Assuming a 3x3 Tic-Tac-Toe board

        // Flatten the String[][] into a String[]
        int index = 0;
        for (int i = 0; i < stateBoard.length; i++) {
            for (int j = 0; j < stateBoard[i].length; j++) {
                // Assign value to state, use the index as a placeholder if the position is empty
                this.state[index] = stateBoard[i][j].isEmpty() ? Integer.toString(index) : stateBoard[i][j];
                index++;
            }
        }
    }

    public int getPosition() {
        return position;
    }

    public void setPosition(int position) {
        this.position = position;
    }

    public String[] getState() {
        return state;
    }

    public String getStateIndex(int i){
        return state[i];
    }

    public void setState(String[] state) {
        this.state = state;
    }

    public void changeState(int i, String player){
        state[i] = player;
    }

    @Override
    public String toString() {
        return "State{" +
                "position=" + position +
                ", state=" + Arrays.toString(state) +
                '}';
    }
}
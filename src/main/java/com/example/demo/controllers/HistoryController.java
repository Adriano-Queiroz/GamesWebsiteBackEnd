package com.example.demo.controllers;

import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.battle.BattleDTO;
import com.example.demo.dtos.battle.IsInBattleDTO;
import com.example.demo.dtos.history.HistoryDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.game.GameType;
import com.example.demo.models.history.HistoryModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IHistoryRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.exceptions.NotFoundException;
import lombok.Getter;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("/history")
public class HistoryController {
    @Autowired
    private IUserModelRepository iUserModelRepository;

    @Autowired
    private IHistoryRepository iHistoryRepository;

    @GetMapping("/getByUser/{codUser}")
    public ResponseEntity<HistoryDTO> getByUser(@PathVariable long codUser) throws NotFoundException {
        Optional<UserModel> optionalUser = iUserModelRepository.findById(codUser);
        if(!optionalUser.isPresent())
            throw new NotFoundException("User não encontrado");
        Optional<HistoryModel> optionalHistory = iHistoryRepository.findLatestHistoryByUser(optionalUser.get());
        if(!optionalHistory.isPresent())
            throw new NotFoundException("História não encontrada");
        HistoryModel history = optionalHistory.get();
        String board = history.getBoard();
        String[][] boardArray = ((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, board))
                .getBoard();
                return ResponseEntity.ok(new HistoryDTO(
                        board,
                        history.getCodBattle(),
                        history.getStatus().toString(),
                        history.getPlayer1().getCodUser() == codUser
                ));
    }
    @GetMapping("/getByBattle/{codBattle}")
    public ResponseEntity<HistoryDTO> getByCodBattle(@PathVariable long codBattle) throws NotFoundException {
        Optional<HistoryModel> optionalHistory = iHistoryRepository.findFirstByCodBattle(codBattle);
        if(!optionalHistory.isPresent())
            throw new NotFoundException("História não encontrada");
        HistoryModel history = optionalHistory.get();
        String board = history.getBoard();
        String[][] boardArray = ((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, board))
                .getBoard();
        return ResponseEntity.ok(new HistoryDTO(
                board,
                history.getCodBattle(),
                history.getStatus().toString(),
                false
        ));
    }
}

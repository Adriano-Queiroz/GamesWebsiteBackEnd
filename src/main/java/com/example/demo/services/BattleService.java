package com.example.demo.services;

import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.battle.BattleDTO;
import com.example.demo.dtos.battle.IsInBattleDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameType;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class BattleService {
    @Autowired
    private IBattleRepository iBattleRepository;
    @Autowired
    private IUserModelRepository iUserModelRepository;
    @Autowired
    private GamesService gamesService;

    public IsInBattleDTO isInBattle(long codUser) throws NotFoundException {
        Optional<UserModel> optionalUser = iUserModelRepository.findById(codUser);
        if(!optionalUser.isPresent())
            throw new NotFoundException("User not found");
        Optional<BattleModel> optionalBattle = iBattleRepository.findFirstByPlayer1(optionalUser.get());
        Optional<BattleModel> optionalBattle2 = iBattleRepository.findFirstByPlayer2(optionalUser.get());
        if(optionalBattle.isPresent() || optionalBattle2.isPresent()){
            BattleModel battle;
            if(optionalBattle.isPresent())
                battle = optionalBattle.get();
            else
                battle = optionalBattle2.get();
            String board = battle.getBoard();
            String[][] boardArray = ((TicTacToeBoard)
                    BoardMapper.getBoard(GameType.TICTACTOE, board))
                    .getBoard();
            return new IsInBattleDTO(true,new BattleDTO(
                    board,
                    gamesService.getPossibleMoves(boardArray,battle.getRoom().getGame().getGameType()),
                    battle.getCodBattle(),
                    battle.swapStatus().toString()
            ));
        }
         return new IsInBattleDTO(false,null);
    }
}

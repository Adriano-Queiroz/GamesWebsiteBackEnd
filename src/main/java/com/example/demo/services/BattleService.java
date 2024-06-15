package com.example.demo.services;

import com.example.demo.Tuple;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.battle.BattleDTO;
import com.example.demo.dtos.battle.IsInBattleDTO;
import com.example.demo.dtos.tictactoe.EndGameResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.game.GameType;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.exceptions.NotFoundException;
import com.example.demo.services.tictactoe.TicTacToeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.simp.SimpMessagingTemplate;
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
    @Autowired
    private TicTacToeService ticTacToeService;
    @Autowired
    private SimpMessagingTemplate messagingTemplate;

    public IsInBattleDTO isInBattle(long codUser) throws NotFoundException {
        BattleModel battle = getBattle(codUser);
        if(battle != null){
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

    public String leaveBattle(long codUser,String player) throws NotFoundException {
        BattleModel battle = getBattle(codUser);
        if(battle == null)
            throw new NotFoundException("Erro ao Extrair partida");
        Tuple hasFinishedTuple = new Tuple(true,player);
        ticTacToeService.treatFinishedGame(hasFinishedTuple,messagingTemplate,battle.getCodBattle());
        return "Saiu da partida com sucesso";
    }
    public BattleModel getBattle(long codUser) throws NotFoundException {
        Optional<UserModel> optionalUser = iUserModelRepository.findById(codUser);
        if (!optionalUser.isPresent())
            throw new NotFoundException("User not found");
        Optional<BattleModel> optionalBattle = iBattleRepository.findFirstByPlayer1(optionalUser.get());
        Optional<BattleModel> optionalBattle2 = iBattleRepository.findFirstByPlayer2(optionalUser.get());
        if (optionalBattle.isPresent() || optionalBattle2.isPresent()) {
            BattleModel battle;
            if (optionalBattle.isPresent())
                battle = optionalBattle.get();
            else
                battle = optionalBattle2.get();
            return battle;
        }
        return null;
    }
}

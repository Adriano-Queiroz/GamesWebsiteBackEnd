package com.example.demo.services;

import com.example.demo.Tuple;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.battle.BattleDTO;
import com.example.demo.dtos.battle.BattleTimeoutResponseDTO;
import com.example.demo.dtos.battle.IsInBattleDTO;
import com.example.demo.dtos.tictactoe.EndGameResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.battle.Status;
import com.example.demo.models.game.GameType;
import com.example.demo.models.history.HistoryModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IBattleRepository;
import com.example.demo.repositories.IHistoryRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.exceptions.NotFoundException;
import com.example.demo.services.tictactoe.TicTacToeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Service;

import java.time.Duration;
import java.time.LocalDateTime;
import java.util.Optional;
import java.util.Timer;
import java.util.TimerTask;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.ConcurrentMap;

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
    private IHistoryRepository iHistoryRepository;
    @Autowired
    private SimpMessagingTemplate messagingTemplate;
    private final Timer timer = new Timer();
    private TimerTask currentTask;
    private final ConcurrentMap<Long, BattleModel> battleMap = new ConcurrentHashMap<>();


    public IsInBattleDTO isInBattle(long codUser) throws NotFoundException {
        BattleModel battle = getBattle(codUser);
        if(battle != null){
            String board = battle.getBoard();
            String[][] boardArray = ((TicTacToeBoard)
                    BoardMapper.getBoard(GameType.TICTACTOE, board))
                    .getBoard();

            return new IsInBattleDTO(true
                    ,new BattleDTO(
                    board,
                    gamesService.getPossibleMoves(boardArray,battle.getRoom().getGame().getGameType()),
                    battle.getCodBattle(),
                    battle.getStatus().toString(),
                    battle.getPlayer1().getCodUser() == codUser,
                    true)
                    ,Duration.between(battle.getLastMoveDateTime(),LocalDateTime.now()).getSeconds()
            );
        }
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
            return new IsInBattleDTO(false,
                    new BattleDTO(
                            board,
                            gamesService.getPossibleMoves(boardArray,history.getRoom().getGame().getGameType()),
                            history.getCodBattle(),
                            history.getStatus().toString(),
                            history.getPlayer1().getCodUser() == codUser,
                            true)
                    ,Duration.between(battle.getLastMoveDateTime(),LocalDateTime.now()).getSeconds()
            );

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
    public synchronized void receiveMessage(Long codBattle) {
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        if (battle == null) {
            System.out.println("Battle not found.");
            return;
        }
        System.out.println("Message received for battle " + codBattle + ". Timer reset.");
        resetTimer(battle);
    }

    private synchronized void resetTimer(BattleModel battle) {
        if (battle.getTimer() != null) {
            battle.getTimer().cancel();
        }
        Timer timer = new Timer();
        battle.setTimer(timer);
        timer.schedule(new TimerTask() {
            @Override
            public void run() {
                executeAction(battle);
            }
        }, 16000);
    }

    private void executeAction(BattleModel battle) {
        if(battle.getStatus() == Status.P2_TURN){
            ticTacToeService.treatFinishedGame(new Tuple(true,"O"),messagingTemplate,battle.getCodBattle());
        }else if(battle.getStatus () == Status.P1_TURN){
            ticTacToeService.treatFinishedGame(new Tuple(true,"X"),messagingTemplate,battle.getCodBattle());
        }
    }


    public void shutdown(long codBattle) {
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        if (battle.getTimer() != null)
                battle.getTimer().cancel();


    }
    /*
    public void startTimer(long codBattle){
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        Timer timer = battle.getTimer();
        if(timer != null){
            timer.cancel();
            battle.setTimer(null);
        }
        timer = new Timer();
        TimerTask timerTask = new TimerTask() {
            @Override
            public void run() {
                sendTimeout(battle.getStatus(),battle.getCodBattle());
            }
        };
        timer.schedule(timerTask,16000);
        battle.setTimer(timer);
    }
    public void sendTimeout(Status status, long codBattle){
        if(status == Status.P2_TURN){
            ticTacToeService.treatFinishedGame(new Tuple(true,"O"),messagingTemplate,codBattle);
        }else if(status == Status.P1_TURN){
            ticTacToeService.treatFinishedGame(new Tuple(true,"X"),messagingTemplate,codBattle);
        }
    }
    public void resetTimer(long codBattle){
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        Timer timer = battle.getTimer();
        if(timer != null){
            timer.cancel();
            battle.setTimer(null);
        }
    }

     */


}

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
import jakarta.transaction.Transactional;
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
    private final ConcurrentMap<Long, Timer> battleTimers = new ConcurrentHashMap<>();


    public IsInBattleDTO isInBattle(long codUser) throws NotFoundException {
        BattleModel battle = getBattle(codUser);
        if(battle == null)
            return new IsInBattleDTO(false,null,-1);
        String board = battle.getBoard();
        String[][] boardArray = ((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, board))
                .getBoard();
        //todo - Se um user for null, o turn tem que ser do user e a board mais recente ser enviada
            return new IsInBattleDTO(true
                    ,new BattleDTO(
                    board,
                    gamesService.getPossibleMoves(boardArray,battle.getRoom().getGame().getGameType()),
                    battle.getCodBattle(),
                    //battle.getStatus().toString(),
                    battle.getPlayer1() != null ? Status.P1_TURN.toString() : Status.P2_TURN.toString(),
                    battle.getPlayer1()!=null && battle.getPlayer1().getCodUser() == codUser,
                    true),
                    -1
                    //,Duration.between(battle.getLastMoveDateTime(),LocalDateTime.now()).getSeconds()


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
    public synchronized void receiveMessage(Long codBattle, Long timeAdded) {
        BattleModel battle = iBattleRepository.findById(codBattle).get();
        if (battle == null) {
            System.out.println("Battle not found.");
            return;
        }
        System.out.println("Message received for battle " + codBattle + ". Timer reset.");
        resetTimer(battle, timeAdded+1000);
    }
    @Transactional
    protected synchronized void resetTimer(BattleModel battle, Long timeAdded) {
        Timer timer = battleTimers.get(battle.getCodBattle());
        if (timer != null) {
            timer.cancel();
        }
        timer = new Timer();
        timer.schedule(new TimerTask() {
            @Override
            public void run() {
                //try {
                    executeAction(battle);
                //} catch (NotFoundException e) {
                 //   throw new RuntimeException(e);
                //}
            }
        }, 16000 + timeAdded);

        battleTimers.put(battle.getCodBattle(), timer);
        iBattleRepository.save(battle);

    }

    private synchronized void resetTimer(BattleModel battle) {
        Timer timer = battleTimers.get(battle.getCodBattle());
        if (timer != null) {
            timer.cancel();
        }
        timer = new Timer();
        timer.schedule(new TimerTask() {
            @Override
            public void run() {
              //  try {
                    executeAction(battle);
              //  } catch (NotFoundException e) {
                //    throw new RuntimeException(e);
                //}
            }
        }, 10006000);

        battleTimers.put(battle.getCodBattle(), timer);
        iBattleRepository.save(battle);

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

    private void executeAction(BattleModel battle)  {
        if(battle.getPlayer2()==null)
            battle.setStatus(Status.P1_TURN);
        else if(battle.getPlayer1()==null)
            battle.setStatus(Status.P2_TURN);
        if(iBattleRepository.findById(battle.getCodBattle()).isPresent())
            iBattleRepository.save(battle);
        if(battle.getStatus() == Status.P2_TURN){
            ticTacToeService.treatFinishedGame(new Tuple(true,"X"),messagingTemplate,battle.getCodBattle());
        }else if(battle.getStatus () == Status.P1_TURN){
            ticTacToeService.treatFinishedGame(new Tuple(true,"O"),messagingTemplate,battle.getCodBattle());
        }
    }


    public void shutdown(long codBattle) {
        Timer timer = battleTimers.get(codBattle);
        if (timer != null){
            timer.cancel();
            battleTimers.remove(codBattle);
        }
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

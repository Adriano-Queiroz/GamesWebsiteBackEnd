package com.example.demo.services;

import com.example.demo.InviteType;
import com.example.demo.PlayersTuple;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.friendship_battle.AcceptInviteRequestDTO;
import com.example.demo.dtos.friendship_battle.SendInviteRequestDTO;
import com.example.demo.dtos.friendship_battle.SendInviteResponseDTO;
import com.example.demo.dtos.lobby.FriendsLobbyRequestDTO;
import com.example.demo.dtos.lobby.LobbyRequestDTO;
import com.example.demo.dtos.lobby.LobbyResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.game.GameType;
import com.example.demo.models.invite.InviteModel;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.*;
import com.example.demo.services.exceptions.NotEnoughFundsException;
import com.example.demo.services.exceptions.NotFoundException;
import com.example.demo.services.sockets.WebSocketService;
import com.google.gson.Gson;
import jakarta.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;
import java.util.Random;

@Service
public class LobbyService {

    ILobbyRepository iLobbyRepository;
    IGameRepository iGameRepository;
    IUserModelRepository iUserModelRepository;
    IBattleRepository iBattleRepository;
    IRoomRepository iRoomRepository;
    WebSocketService webSocketService;
    private GamesService gamesService;
    private IInviteRepository iInviteRepository;
    private BattleService battleService;

    @Autowired
    public LobbyService(ILobbyRepository iLobbyRepository,
                        IGameRepository iGameRepository,
                        IUserModelRepository iUserModelRepository,
                        IBattleRepository iBattleRepository,
                        IRoomRepository iRoomRepository,
                        WebSocketService webSocketService,
                        GamesService gamesService,
                        IInviteRepository iInviteRepository,
                        BattleService battleService
                        ) {
        this.iLobbyRepository = iLobbyRepository;
        this.iGameRepository = iGameRepository;
        this.iUserModelRepository = iUserModelRepository;
        this.iBattleRepository = iBattleRepository;
        this.iRoomRepository = iRoomRepository;
        this.webSocketService = webSocketService;
        this.gamesService = gamesService;
        this.iInviteRepository = iInviteRepository;
        this.battleService = battleService;
    }

    public void deleteLobby(long codUser){
        try{
            UserModel user = iUserModelRepository.findById(codUser).get();
            List<LobbyModel> lobbyList = iLobbyRepository.findAllByUser(user);
            iLobbyRepository.deleteAll(lobbyList);
            //return lobby.getCodLobby();
        }catch(Exception e){
            System.out.println("mambo");
        }
    }
    /*
    public ResponseEntity<LobbyResponseDTO> createFriendsLobby(FriendsLobbyRequestDTO friendsLobbyRequestDTO) throws NotFoundException{
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(friendsLobbyRequestDTO.codRoom());
        Optional<UserModel> optionalUser = iUserModelRepository.findById(friendsLobbyRequestDTO.codUser());
        Optional<UserModel> optionalFriend = iUserModelRepository.findById(friendsLobbyRequestDTO.codUser());
        if (!optionalUser.isPresent())
            throw new NotFoundException("User not found of id " + friendsLobbyRequestDTO.codUser());
        if (!optionalRoom.isPresent())
            throw new NotFoundException("Room not found of id " + friendsLobbyRequestDTO.codRoom());
        if (!optionalFriend.isPresent())
            throw new NotFoundException("Friend not found of id " + friendsLobbyRequestDTO.codRoom());
        RoomModel room = optionalRoom.get();
        UserModel user = optionalUser.get();
        UserModel friend = optionalFriend.get();
        LobbyModel lobby = createLobby(user,room,friend);
        return ResponseEntity.ok(new LobbyResponseDTO("Waiting for player", false, lobby.getCodLobby(), false,"",-1));
    }

     */

        public ResponseEntity<LobbyResponseDTO> getLobby(FriendsLobbyRequestDTO friendsLobbyRequestDTO) throws NotFoundException{
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(friendsLobbyRequestDTO.codRoom());
        Optional<UserModel> optionalUser = iUserModelRepository.findById(friendsLobbyRequestDTO.codUser());
        Optional<UserModel> optionalFriend = iUserModelRepository.findById(friendsLobbyRequestDTO.codUser());
        if (!optionalUser.isPresent())
            throw new NotFoundException("User not found of id " + friendsLobbyRequestDTO.codUser());
        if (!optionalRoom.isPresent())
            throw new NotFoundException("Room not found of id " + friendsLobbyRequestDTO.codRoom());
        if (!optionalFriend.isPresent())
            throw new NotFoundException("Friend not found of id " + friendsLobbyRequestDTO.codRoom());
        RoomModel room = optionalRoom.get();
        UserModel user = optionalUser.get();
        UserModel friend = optionalFriend.get();
        if(friendsLobbyRequestDTO.codLobby() < 0){
            LobbyModel lobby = createLobby(user,room,friend);
            return ResponseEntity.ok(new LobbyResponseDTO("Waiting for player", false, lobby.getCodLobby(), false,"",-1));
        }
        Optional<LobbyModel> optionalLobby = iLobbyRepository.findById(friendsLobbyRequestDTO.codLobby());
        if(!optionalLobby.isPresent())
            throw new NotFoundException("Did not find lobby with id: " + friendsLobbyRequestDTO.codLobby());
        LobbyModel lobby = optionalLobby.get();
        return createBattle(lobby, friend,room);
    }
    public ResponseEntity<LobbyResponseDTO> getLobby(LobbyRequestDTO lobbyRequestDTO) throws NotFoundException, NotEnoughFundsException {
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(lobbyRequestDTO.codRoom());
        Optional<UserModel> optionalUser = iUserModelRepository.findById(lobbyRequestDTO.codUser());
        if (!optionalUser.isPresent())
            throw new NotFoundException("User not found of id " + lobbyRequestDTO.codUser());
        if (!optionalRoom.isPresent())
            throw new NotFoundException("Room not found of id " + lobbyRequestDTO.codRoom());
        RoomModel room = optionalRoom.get();
        //GameModel game = room.getGame();
        UserModel newUser = optionalUser.get();
        if(room.getBet()>newUser.getBalance())
            throw new NotEnoughFundsException("Não tem dinheiro suficiente para este quarto");
        Optional<LobbyModel> optionalLobby = iLobbyRepository.findFirstByRoomAndFriendInvitedIsNullAndIsFriendsLobbyFalseOrderByCodLobbyDesc(room);
        String board = gamesService.getEmptyBoard(room.getGame().getGameType());
        if (!optionalLobby.isPresent()) {
            boolean isPlayer1 = Math.random() < 0.5;
            LobbyModel lobby = createLobby(newUser,room,null);

            if(!isPlayer1){
                Gson gson = new Gson();
                board = gson.toJson(gamesService.makeBotMove(
                        ((TicTacToeBoard)
                                BoardMapper.getBoard(GameType.TICTACTOE, board))
                                .getBoard(),
                        "X",
                        GameType.TICTACTOE
                ));
                lobby.setFirstMoveBoard(board);
                iLobbyRepository.save(lobby);
            }

            return ResponseEntity.ok(new LobbyResponseDTO("Waiting for player", false, lobby.getCodLobby(), isPlayer1,board,-1));
        }
        LobbyModel lobby = optionalLobby.get();
        //if(lobby.getUser().getCodUser()==lobbyRequestDTO.codUser())
        //    return null;
        return createBattle(lobby,newUser,room);
    }

    public ResponseEntity<LobbyResponseDTO> createBattle(LobbyModel lobby, UserModel newUser,RoomModel room){

        UserModel oldUser = lobby.getUser();
        BattleModel battle = new BattleModel();
        PlayersTuple playersTuple = randomizePlayers(oldUser, newUser);
        setBattle(playersTuple, battle, room);
        iLobbyRepository.delete(lobby);
        battleService.receiveMessage(battle.getCodBattle());
        return ResponseEntity.ok(sendMessagesAfterOpponentFound(
                playersTuple.player1(),
                playersTuple.player2(),
                oldUser,
                newUser,
                lobby,
                battle.getCodBattle()));
    }
    public LobbyResponseDTO newCreateBattle(LobbyModel lobby, UserModel newUser,RoomModel room){

        UserModel oldUser = lobby.getUser();
        BattleModel battle = new BattleModel();
        PlayersTuple playersTuple = randomizePlayers(oldUser, newUser);
        setBattle(playersTuple, battle, room);
        iLobbyRepository.delete(lobby);
        battleService.receiveMessage(battle.getCodBattle());
        return sendMessagesAfterOpponentFound(
                playersTuple.player1(),
                playersTuple.player2(),
                oldUser,
                newUser,
                lobby,
                battle.getCodBattle());
    }
    public LobbyModel createLobby(UserModel user, RoomModel room,UserModel friend){
            if(iLobbyRepository.findFirstByUserOrderByCodLobbyDesc(user).isPresent())
                iLobbyRepository.delete(iLobbyRepository.findFirstByUserOrderByCodLobbyDesc(user).get());
            if(iLobbyRepository.findFirstByUserOrderByCodLobbyDesc(user).isPresent())
                return null;
        LobbyModel lobby = new LobbyModel();
        lobby.setGame(room.getGame());
        lobby.setUser(user);
        lobby.setRoom(room);
        if(friend!=null) lobby.setFriendInvited(friend);
        iLobbyRepository.save(lobby);
        return lobby;
    }

    public PlayersTuple randomizePlayers(UserModel oldUser, UserModel newUser) {
        UserModel player1 = Math.random() < 0.5 ? newUser : oldUser;
        UserModel player2 = player1 == newUser ? oldUser : newUser;
        return new PlayersTuple(player1, player2);
    }
    @Transactional
    public void setBattle(PlayersTuple playersTuple, BattleModel battle, RoomModel room) {
        battle.setPlayer1(playersTuple.player1());
        battle.setPlayer2(playersTuple.player2());
        battle.setRoom(room);
        String emptyBoard = gamesService.getEmptyBoard(room.getGame().getGameType());
        battle.setBoard(emptyBoard);
        iBattleRepository.save(battle);
    }

    public LobbyResponseDTO sendMessagesAfterOpponentFound(UserModel player1, UserModel player2, UserModel oldUser, UserModel newUser, LobbyModel lobby, long codBattle) {
        boolean isOldUserPlayer1 = player1.equals(oldUser);
        String emptyBoard = gamesService.getEmptyBoard(lobby.getGame().getGameType());
        LobbyResponseDTO lobbyResponseDTO = new LobbyResponseDTO(
                "Found Opponent, game is about to begin",
                true,
                lobby.getCodLobby(),
                isOldUserPlayer1,
                emptyBoard,
                codBattle
        );
        webSocketService.sendMessage("/topic/lobby/" + lobby.getCodLobby(), lobbyResponseDTO);
        lobbyResponseDTO = new LobbyResponseDTO("Found Opponent, game is about to begin",
                true,
                lobby.getCodLobby(),
                !isOldUserPlayer1,
                emptyBoard,
                codBattle
        );
        return lobbyResponseDTO;
    }

    public ResponseEntity<LobbyResponseDTO> getLobby(SendInviteRequestDTO sendInviteRequestDTO, InviteModel invite, SimpMessagingTemplate messagingTemplate) throws NotFoundException {
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(sendInviteRequestDTO.codRoom());
        Optional<UserModel> optionalUser = iUserModelRepository.findById(sendInviteRequestDTO.codUser());
        Optional<UserModel> optionalFriend = iUserModelRepository.findByUsername(sendInviteRequestDTO.friendUsername());
        if (!optionalUser.isPresent())
            throw new NotFoundException("User not found of id " + sendInviteRequestDTO.codUser());
        if (!optionalRoom.isPresent())
            throw new NotFoundException("Room not found of id " + sendInviteRequestDTO.codRoom());
        if (!optionalFriend.isPresent())
            throw new NotFoundException("Friend not found of id " + sendInviteRequestDTO.codRoom());
        RoomModel room = optionalRoom.get();
        UserModel user = optionalUser.get();
        UserModel friend = optionalFriend.get();
        if(sendInviteRequestDTO.codLobby() < 0){
            LobbyModel lobby = createLobby(user,room,friend);
            lobby.setFriendsLobby(true);
            invite.setLobby(lobby);
            iInviteRepository.save(invite);
            String gameString = room.getGame().getGameType().toString();
            messagingTemplate.convertAndSend(
                    "/topic/invites/" + friend.getCodUser(),
                    new SendInviteResponseDTO(invite.getCodInvite()
                            , user.getUsername(),
                            lobby.getCodLobby(),
                            room.getBet(),
                            gameString,
                            InviteType.INVITE,
                            "Recebeu um Convite para jogar"));
            return ResponseEntity.ok(new LobbyResponseDTO("Waiting for player", false, lobby.getCodLobby(), false,"",-1));
        }
        Optional<LobbyModel> optionalLobby = iLobbyRepository.findById(sendInviteRequestDTO.codLobby());
        if(!optionalLobby.isPresent())
            throw new NotFoundException("Did not find lobby with id: " + sendInviteRequestDTO.codLobby());
        LobbyModel lobby = optionalLobby.get();

        return createBattle(lobby, friend,room);
    }
    public ResponseEntity<LobbyResponseDTO> getLobby(UserModel user, UserModel friend, LobbyModel lobby, RoomModel room) throws NotFoundException {

        return createBattle(lobby, user,room);
    }

    public ResponseEntity<LobbyResponseDTO> newCreateFriendsLobby(SendInviteRequestDTO sendInviteRequestDTO, InviteModel invite) throws NotFoundException {
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(sendInviteRequestDTO.codRoom());
        Optional<UserModel> optionalUser = iUserModelRepository.findById(sendInviteRequestDTO.codUser());
        if (!optionalUser.isPresent())
            throw new NotFoundException("User not found of id " + sendInviteRequestDTO.codUser());
        if (!optionalRoom.isPresent())
            throw new NotFoundException("Room not found of id " + sendInviteRequestDTO.codRoom());
        RoomModel room = optionalRoom.get();
        UserModel user = optionalUser.get();
        LobbyModel lobby = createLobby(user,room,null);
        lobby.setFriendsLobby(true);
        lobby.setInviteCode(generateInviteCode(20));
        iLobbyRepository.save(lobby);
        invite.setLobby(lobby);
        iInviteRepository.save(invite);

        return ResponseEntity.ok(new LobbyResponseDTO("Waiting for player", false, lobby.getCodLobby(), false,"",-1));
    }
    public String generateInviteCode(int length) {

        String characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        Random random = new Random();
        StringBuilder randomString = new StringBuilder(length);

        for (int i = 0; i < length; i++) {
            int index = random.nextInt(characters.length());
            randomString.append(characters.charAt(index));
        }

        return randomString.toString();
    }

}

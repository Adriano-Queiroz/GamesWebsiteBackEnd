package com.example.demo.services;

import com.example.demo.InviteType;
import com.example.demo.PlayersTuple;
import com.example.demo.dtos.friendship_battle.AcceptInviteRequestDTO;
import com.example.demo.dtos.friendship_battle.SendInviteRequestDTO;
import com.example.demo.dtos.friendship_battle.SendInviteResponseDTO;
import com.example.demo.dtos.lobby.FriendsLobbyRequestDTO;
import com.example.demo.dtos.lobby.LobbyRequestDTO;
import com.example.demo.dtos.lobby.LobbyResponseDTO;
import com.example.demo.models.invite.InviteModel;
import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.*;
import com.example.demo.services.exceptions.NotFoundException;
import com.example.demo.services.sockets.WebSocketService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Service;

import java.util.Optional;

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

    @Autowired
    public LobbyService(ILobbyRepository iLobbyRepository,
                        IGameRepository iGameRepository,
                        IUserModelRepository iUserModelRepository,
                        IBattleRepository iBattleRepository,
                        IRoomRepository iRoomRepository,
                        WebSocketService webSocketService,
                        GamesService gamesService,
                        IInviteRepository iInviteRepository
                        ) {
        this.iLobbyRepository = iLobbyRepository;
        this.iGameRepository = iGameRepository;
        this.iUserModelRepository = iUserModelRepository;
        this.iBattleRepository = iBattleRepository;
        this.iRoomRepository = iRoomRepository;
        this.webSocketService = webSocketService;
        this.gamesService = gamesService;
        this.iInviteRepository = iInviteRepository;
    }

    public long deleteLobby(long codUser){
        try{
            UserModel user = iUserModelRepository.findById(codUser).get();
            LobbyModel lobby = iLobbyRepository.findFirstByUserOrderByCodLobbyDesc(user).get();
            iLobbyRepository.delete(lobby);
            return lobby.getCodLobby();
        }catch(Exception e){
            System.out.println("mambo");
        }
      return -1;

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
    public ResponseEntity<LobbyResponseDTO> getLobby(LobbyRequestDTO lobbyRequestDTO) throws NotFoundException {
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(lobbyRequestDTO.codRoom());
        Optional<UserModel> optionalUser = iUserModelRepository.findById(lobbyRequestDTO.codUser());
        if (!optionalUser.isPresent())
            throw new NotFoundException("User not found of id " + lobbyRequestDTO.codUser());
        if (!optionalRoom.isPresent())
            throw new NotFoundException("Room not found of id " + lobbyRequestDTO.codRoom());
        RoomModel room = optionalRoom.get();
        //GameModel game = room.getGame();
        UserModel newUser = optionalUser.get();
        Optional<LobbyModel> optionalLobby = iLobbyRepository.findFirstByRoomAndFriendInvitedIsNullOrderByCodLobbyDesc(room);
        if (!optionalLobby.isPresent()) {
            LobbyModel lobby = createLobby(newUser,room,null);
            return ResponseEntity.ok(new LobbyResponseDTO("Waiting for player", false, lobby.getCodLobby(), false,"",-1));
        }
        LobbyModel lobby = optionalLobby.get();
        return createBattle(lobby,newUser,room);
    }

    public ResponseEntity<LobbyResponseDTO> createBattle(LobbyModel lobby, UserModel newUser,RoomModel room){

        UserModel oldUser = lobby.getUser();
        BattleModel battle = new BattleModel();
        PlayersTuple playersTuple = randomizePlayers(oldUser, newUser);
        setBattle(playersTuple, battle, room);
        iLobbyRepository.delete(lobby);
        return sendMessagesAfterOpponentFound(
                playersTuple.player1(),
                playersTuple.player2(),
                oldUser,
                newUser,
                lobby,
                battle.getCodBattle());
    }
    public LobbyModel createLobby(UserModel user, RoomModel room,UserModel friend){
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

    public void setBattle(PlayersTuple playersTuple, BattleModel battle, RoomModel room) {
        battle.setPlayer1(playersTuple.player1());
        battle.setPlayer2(playersTuple.player2());
        battle.setRoom(room);
        iBattleRepository.save(battle);
    }

    public ResponseEntity<LobbyResponseDTO> sendMessagesAfterOpponentFound(UserModel player1, UserModel player2, UserModel oldUser, UserModel newUser, LobbyModel lobby, long codBattle) {
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
        return ResponseEntity.ok(new LobbyResponseDTO("Found Opponent, game is about to begin",
                true,
                lobby.getCodLobby(),
                !isOldUserPlayer1,
                emptyBoard,
                codBattle
        ));
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
}

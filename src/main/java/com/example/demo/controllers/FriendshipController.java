package com.example.demo.controllers;

import com.example.demo.InviteType;
import com.example.demo.dtos.friendship.*;
//import com.example.demo.models.friend_request.FriendRequestModel;
import com.example.demo.dtos.friendship_battle.AcceptInviteRequestDTO;
import com.example.demo.dtos.friendship_battle.SendInviteRequestDTO;
import com.example.demo.dtos.invites.*;
import com.example.demo.dtos.lobby.LobbyResponseDTO;
import com.example.demo.dtos.user.UserDTO;
import com.example.demo.models.invite.InviteModel;
import com.example.demo.models.friendship.FriendshipModel;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
//import com.example.demo.repositories.IFriendRequestRepository;
import com.example.demo.repositories.*;
import com.example.demo.services.LobbyService;
import com.example.demo.services.exceptions.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/friendship")
public class FriendshipController {
    @Autowired
    private IFriendshipRepository iFriendshipRepository;
    @Autowired
    private IUserModelRepository iUserModelRepository;
    @Autowired
    private SimpMessagingTemplate messagingTemplate;

    @Autowired
    private IInviteRepository iInviteRepository;
    @Autowired
    private LobbyService lobbyService;
    @Autowired
    private IRoomRepository iRoomRepository;

    //@Autowired
    //IFriendRequestRepository iFriendRequestRepository;
    @Autowired
    private ILobbyRepository iLobbyRepository;
    @PostMapping("/solicitation")
    public ResponseEntity<FriendshipSolicitationResponseDTO> friendRequest(@RequestBody FriendshipSolicitationRequestDTO friendshipSolicitationRequestDTO) throws NotFoundException, AlreadyExistsException, AlreadyFriendsException, InvalidRequestException {
        UserModel user = iUserModelRepository.findById(friendshipSolicitationRequestDTO.codUser()).get();
        Optional<UserModel> optionalFriend = iUserModelRepository.findByUsername(friendshipSolicitationRequestDTO.friendUsername());

        if(!optionalFriend.isPresent())
            throw new NotFoundException("User não encontrado");
        UserModel friend = optionalFriend.get();
        if(friend.getCodUser()==user.getCodUser())
            throw new InvalidRequestException("Não pode enviar um pedido de amizade para você mesmo");
        Optional<FriendshipModel> possibleFriendships = iFriendshipRepository.findFirstByIsAcceptedAndUserRequestAndAndUserAccept(
                false,
                user,
                friend
        );
        Optional<FriendshipModel> possibleFriendshipsTurnedAround = iFriendshipRepository.findFirstByIsAcceptedAndUserRequestAndAndUserAccept(
                false,
                friend,
                user
        );
        if(possibleFriendships.isPresent() || possibleFriendshipsTurnedAround.isPresent())
            throw new AlreadyExistsException("Já existe um pedido de amizade entre vocês");
        possibleFriendships = iFriendshipRepository.findFirstByIsAcceptedAndUserRequestAndAndUserAccept(
                true,
                user,
                friend
        );
        possibleFriendshipsTurnedAround = iFriendshipRepository.findFirstByIsAcceptedAndUserRequestAndAndUserAccept(
                true,
                friend,
                user
        );
        if(possibleFriendships.isPresent() || possibleFriendshipsTurnedAround.isPresent())
            throw new AlreadyFriendsException("Vocês já são amigos");
        FriendshipModel friendship = new FriendshipModel();
        friendship.setUserRequest(user);
        friendship.setUserAccept(friend);
        friendship.setIsAccepted(false);
        iFriendshipRepository.save(friendship);
        messagingTemplate.convertAndSend(
                "/topic/invites/" + friend.getCodUser(),
        new FriendRequestMessageDTO(friend.getUsername(), InviteType.FRIEND_REQUEST,"Recebeu um pedido de amizade de " + friend.getUsername()));
        return ResponseEntity.ok(new FriendshipSolicitationResponseDTO("Friend request sent"));
    }
    @PostMapping("/accept")
    public ResponseEntity<FriendshipAcceptResponseDTO> acceptFriendship(@RequestBody FriendshipAcceptRequestDTO friendshipAcceptRequestDTO){
        UserModel userRequest = iUserModelRepository.findByUsername(friendshipAcceptRequestDTO.usernameRequest()).get();
        UserModel userAccept = iUserModelRepository.findById(friendshipAcceptRequestDTO.codAccept()).get();
        FriendshipModel friendship = iFriendshipRepository.findFirstByIsAcceptedAndUserRequestAndAndUserAccept(
                false,
                userRequest,
                userAccept).get();
        friendship.setIsAccepted(true);
        iFriendshipRepository.save(friendship);
        messagingTemplate.convertAndSend(
                "/topic/invites/" + userRequest.getCodUser(),
                new FriendRequestMessageDTO(userAccept.getUsername(),
                        InviteType.FRIEND_REQUEST_ACCEPTED,
                        userAccept.getUsername()+ " Aceitou o pedido de Amizade"));
        return ResponseEntity.ok(new FriendshipAcceptResponseDTO("Pedido de amizade aceite"));
    }
    @DeleteMapping("/reject")
    public ResponseEntity<FriendshipAcceptResponseDTO> deleteFriendship(@RequestBody FriendshipAcceptRequestDTO friendshipAcceptRequestDTO){
        UserModel userRequest = iUserModelRepository.findByUsername(friendshipAcceptRequestDTO.usernameRequest()).get();
        UserModel userAccept = iUserModelRepository.findById(friendshipAcceptRequestDTO.codAccept()).get();
        FriendshipModel friendship = iFriendshipRepository.findFirstByIsAcceptedAndUserRequestAndAndUserAccept(
                false,
                userRequest,
                userAccept).get();
        iFriendshipRepository.delete(friendship);
        return ResponseEntity.ok(new FriendshipAcceptResponseDTO("Friend Request rejected"));
    }
    @GetMapping("/solicitations/{codUser}")
    public ResponseEntity<FriendshipSolicitationListResponseDTO> getFriendSolicitations
            (@PathVariable long codUser) throws NotFoundException {
        Optional<UserModel> optionalUser = iUserModelRepository.findById(codUser);
        if(!optionalUser.isPresent())
            throw new NotFoundException("User não encontrado");
        UserModel user = optionalUser.get();
        List<FriendshipModel> friendSolicitations = iFriendshipRepository.findAllByIsAcceptedAndUserAccept(
                false
                ,user);
        List<UserDTO> userDTOList = friendSolicitations.stream().map(
                solicitation ->new UserDTO(solicitation.getUserRequest().getUsername()))
                .toList();
        return ResponseEntity.ok(new FriendshipSolicitationListResponseDTO(userDTOList));
    }
    @GetMapping("/friends/{codUser}")
    public ResponseEntity<FriendsResponseDTO> getFriends
            (@PathVariable long codUser) throws NotFoundException {
        Optional<UserModel> optionalUser = iUserModelRepository.findById(codUser);
        if(!optionalUser.isPresent())
            throw new NotFoundException("User não encontrado");
        UserModel user = optionalUser.get();
        List<FriendshipModel> acceptedFriends = iFriendshipRepository.findAllByIsAcceptedAndUserAccept(
                true,
                user
        );
        List<FriendshipModel> requestedFriends = iFriendshipRepository.findAllByIsAcceptedAndUserRequest(
                true,
                user
        );

        List<UserDTO> userDTOList = requestedFriends.stream()
                .map(friendship -> new UserDTO(friendship.getUserAccept().getUsername()))
                .collect(Collectors.toList());

        userDTOList.addAll(acceptedFriends.stream()
                .map(friendship -> new UserDTO(friendship.getUserRequest().getUsername()))
                .toList());

        return ResponseEntity.ok(new FriendsResponseDTO(userDTOList));
    }
    @PostMapping("/invite")
    public ResponseEntity<LobbyResponseDTO> sendInvite(@RequestBody SendInviteRequestDTO sendInviteRequestDTO) throws NotFoundException, NotEnoughFundsException {
        InviteModel invite = new InviteModel();
        UserModel user = iUserModelRepository.findById(sendInviteRequestDTO.codUser()).get();
        Optional<UserModel> optionalFriend = iUserModelRepository.findByUsername(sendInviteRequestDTO.friendUsername());
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(sendInviteRequestDTO.codRoom());
        if(!optionalRoom.isPresent())
            throw new NotFoundException("Room not found");
        RoomModel room = optionalRoom.get();
        if(user.getBalance() < room.getBet())
            throw new NotEnoughFundsException("Você não tem dinheiro suficiente, deposite");

        if (!optionalFriend.isPresent())
            throw new NotFoundException("Amigo não encontrado");


        UserModel friend = optionalFriend.get();
        invite.setUserAccept(friend);
        invite.setUserRequest(user);
        invite.setIsAccepted(false);
        invite.setRoom(room);
        iInviteRepository.save(invite);
        return lobbyService.getLobby(sendInviteRequestDTO,invite, messagingTemplate);
    }
    @PostMapping("/newInvite")
    public ResponseEntity<LobbyResponseDTO> newInvite(@RequestBody SendInviteRequestDTO sendInviteRequestDTO) throws NotFoundException, NotEnoughFundsException {
        InviteModel invite = new InviteModel();
        UserModel user = iUserModelRepository.findById(sendInviteRequestDTO.codUser()).get();
        Optional<RoomModel> optionalRoom = iRoomRepository.findById(sendInviteRequestDTO.codRoom());
        if(!optionalRoom.isPresent())
            throw new NotFoundException("Room not found");
        RoomModel room = optionalRoom.get();
        if(user.getBalance() < room.getBet())
            throw new NotEnoughFundsException("Você não tem dinheiro suficiente, deposite");

        invite.setUserRequest(user);
        invite.setIsAccepted(false);
        invite.setRoom(room);
        //iInviteRepository.save(invite);
        return lobbyService.newCreateFriendsLobby(sendInviteRequestDTO,invite);
    }

    //@PostMapping("/newInvite")
    //public ResponseEntity<LobbyResponseDTO> sendInvite(@RequestBody )


    @PostMapping("/acceptInvite")
    public ResponseEntity<LobbyResponseDTO> acceptInvite(@RequestBody AcceptInviteRequestDTO acceptInviteRequestDTO) throws NotFoundException, NotEnoughFundsException {
        Optional<InviteModel> optionalInvite = iInviteRepository.findById(acceptInviteRequestDTO.codInvite());

        if(!optionalInvite.isPresent())
            throw new NotFoundException("Convite expirado ou eliminado pelo amigo");
        InviteModel invite = optionalInvite.get();
        if(invite.getUserAccept().getBalance() < invite.getRoom().getBet())
            throw new NotEnoughFundsException("Você não tem dinheiro suficiente, deposite");
        iInviteRepository.delete(invite);
        return lobbyService.createBattle(invite.getLobby(),
                invite.getUserAccept(),
                invite.getRoom()
        );
    }
    @DeleteMapping("/rejectInvite")
    public ResponseEntity<RejectInviteResponseDTO> rejectInvite(@RequestBody RejectInviteRequestDTO rejectInviteRequestDTO) throws NotFoundException {
        Optional<InviteModel> optionalInvite = iInviteRepository.findById(rejectInviteRequestDTO.codInvite());
        if(!optionalInvite.isPresent())
            throw new NotFoundException("Convite não encontrado");
        InviteModel invite = optionalInvite.get();
        LobbyModel lobby = invite.getLobby();
        messagingTemplate.convertAndSend("/topic/lobby/"+lobby.getCodLobby(),
                new RejectInviteMessageDTO(true,invite.getUserAccept().getUsername())
                );
        iInviteRepository.delete(invite);
        iLobbyRepository.delete(lobby);
        return ResponseEntity.ok(new RejectInviteResponseDTO("Convite rejeitado com sucesso"));
    }

        @GetMapping("/getInvites/{codUser}")
    public ResponseEntity<GetInvitesResponseDTO> getInvites(@PathVariable long codUser){
        UserModel user = iUserModelRepository.findById(codUser).get();
        List<InviteModel> inviteList = iInviteRepository.findAllByUserAcceptAndIsAccepted(user,false);

        return ResponseEntity.ok(new GetInvitesResponseDTO(
                inviteList.stream().map(invite ->
                        new InviteDTO(invite.getCodInvite(),
                                invite.getUserRequest().getUsername(),
                                invite.getRoom().getBet(),
                                invite.getRoom().getGame().getGameType().toString()
                        )).toList()
        ));
    }

}

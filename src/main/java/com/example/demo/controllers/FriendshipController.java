package com.example.demo.controllers;

import com.example.demo.dtos.friendship.FriendshipAcceptRequestDTO;
import com.example.demo.dtos.friendship.FriendshipAcceptResponseDTO;
import com.example.demo.dtos.friendship.FriendshipSolicitationRequestDTO;
import com.example.demo.dtos.friendship.FriendshipSolicitationResponseDTO;
//import com.example.demo.models.friend_request.FriendRequestModel;
import com.example.demo.models.friendship.FriendshipModel;
import com.example.demo.models.user.UserModel;
//import com.example.demo.repositories.IFriendRequestRepository;
import com.example.demo.repositories.IFriendshipRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.exceptions.AlreadyExistsException;
import com.example.demo.services.exceptions.AlreadyFriendsException;
import com.example.demo.services.exceptions.NotFoundException;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/friendship")
public class FriendshipController {
    @Autowired
    private IFriendshipRepository iFriendshipRepository;
    @Autowired
    private IUserModelRepository iUserModelRepository;
    //@Autowired
    //IFriendRequestRepository iFriendRequestRepository;
    @PostMapping("/solicitation")
    public ResponseEntity<FriendshipSolicitationResponseDTO> friendRequest(@RequestBody FriendshipSolicitationRequestDTO friendshipSolicitationRequestDTO) throws NotFoundException, AlreadyExistsException, AlreadyFriendsException {
        UserModel user = iUserModelRepository.findById(friendshipSolicitationRequestDTO.codUser()).get();
        Optional<UserModel> optionalFriend = iUserModelRepository.findByUsername(friendshipSolicitationRequestDTO.friendUsername());

        if(!optionalFriend.isPresent())
            throw new NotFoundException("Friend not found");
        UserModel friend = optionalFriend.get();
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
            throw new AlreadyExistsException("Ja existe um pedido de amizade entre vocês");
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
        return ResponseEntity.ok(new FriendshipSolicitationResponseDTO("Friend request sent"));
    }
    @PostMapping("/accept")
    public ResponseEntity<FriendshipAcceptResponseDTO> acceptFriendship(@RequestBody FriendshipAcceptRequestDTO friendshipAcceptRequestDTO){
        UserModel userRequest = iUserModelRepository.findById(friendshipAcceptRequestDTO.codRequest()).get();
        UserModel userAccept = iUserModelRepository.findById(friendshipAcceptRequestDTO.codAccept()).get();
        FriendshipModel friendship = iFriendshipRepository.findFirstByIsAcceptedAndUserRequestAndAndUserAccept(
                false,
                userRequest,
                userAccept).get();
        friendship.setIsAccepted(true);
        iFriendshipRepository.save(friendship);
        return ResponseEntity.ok(new FriendshipAcceptResponseDTO("Friend Request accepted"));
    }
}

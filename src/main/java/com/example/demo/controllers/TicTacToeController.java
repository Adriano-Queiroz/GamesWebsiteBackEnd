package com.example.demo.controllers;

import com.example.demo.Tuple;
import com.example.demo.boards.TicTacToeBoard;
import com.example.demo.dtos.friendship_battle.SendInviteResponseDTO;
import com.example.demo.dtos.friendship_battle.SendInviteRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveRequestDTO;
import com.example.demo.dtos.tictactoe.MakeMoveResponseDTO;
import com.example.demo.mappers.BoardMapper;
import com.example.demo.models.InviteModel;
import com.example.demo.models.game.GameType;
import com.example.demo.models.user.UserModel;
import com.example.demo.repositories.IInviteRepository;
import com.example.demo.repositories.IUserModelRepository;
import com.example.demo.services.exceptions.NotFoundException;
import com.example.demo.services.tictactoe.TicTacToeLogicService;
import com.example.demo.services.tictactoe.TicTacToeService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.handler.annotation.MessageMapping;
import org.springframework.messaging.simp.SimpMessagingTemplate;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestBody;

import java.util.Optional;


@Controller
public class TicTacToeController {

    @Autowired
    private TicTacToeLogicService ticTacToeLogicService;
    @Autowired
    private TicTacToeService ticTacToeService;

    @Autowired
    private SimpMessagingTemplate messagingTemplate;
    @Autowired
    private IInviteRepository iInviteRepository;
    @Autowired
    private IUserModelRepository iUserModelRepository;

    @MessageMapping("/move")
    public void makeMove(@RequestBody MakeMoveRequestDTO makeMoveRequestDTO) throws Exception {
        System.out.println("ayo");
        MakeMoveResponseDTO responseDTO = ticTacToeLogicService.makeMove(makeMoveRequestDTO);
        Tuple hasFinishedTuple = ticTacToeLogicService.hasFinished(((TicTacToeBoard)
                BoardMapper.getBoard(GameType.TICTACTOE, responseDTO.board()))
                .getBoard());

        if(!hasFinishedTuple.hasFinished()){
            ticTacToeService.treatUnfinishedGame(
                    messagingTemplate,
                    responseDTO.codBattle(),
                    makeMoveRequestDTO.player(),
                    responseDTO
            );
        }else{
            ticTacToeService.treatFinishedGame(
                    hasFinishedTuple,
                    messagingTemplate,
                    responseDTO.codBattle()
            );
        }

    }
    /*
    @MessageMapping("/invite")
    public void sendInvite(@RequestBody SendInviteRequestDTO sendInviteRequestDTO) throws NotFoundException {
        InviteModel invite = new InviteModel();
        UserModel user = iUserModelRepository.findById(sendInviteRequestDTO.codUser()).get();
        Optional<UserModel> optionalFriend = iUserModelRepository.findByUsername(sendInviteRequestDTO.friendUsername());
        if(!optionalFriend.isPresent())
            throw new NotFoundException("Friend not found");
        UserModel friend = optionalFriend.get();

        invite.setUserAccept(friend);
        invite.setUserRequest(user);
        invite.setIsAccepted(false);
        iInviteRepository.save(invite);

        messagingTemplate.convertAndSend(
                "/topic/invites/" + friend.getCodUser(),
                new SendInviteResponseDTO(invite.getCodInvite(), user.getUsername()));
    }

     */
}

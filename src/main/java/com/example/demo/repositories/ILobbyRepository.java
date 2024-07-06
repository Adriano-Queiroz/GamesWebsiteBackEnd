package com.example.demo.repositories;

import com.example.demo.models.game.GameModel;
import com.example.demo.models.lobby.LobbyModel;
import com.example.demo.models.room.RoomModel;
import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;
import java.util.Optional;

public interface ILobbyRepository extends JpaRepository<LobbyModel,Long> {
    //Optional<LobbyModel> findFirstByGameOrderByCodLobbyDesc(GameModel game);
    Optional<LobbyModel> findFirstByRoomAndFriendInvitedIsNullOrderByCodLobbyDesc(RoomModel room);
    Optional<LobbyModel> findFirstByRoomAndFriendInvitedIsNullAndIsFriendsLobbyFalseOrderByCodLobbyDesc(RoomModel room);

    Optional<LobbyModel> findFirstByUserOrderByCodLobbyDesc(UserModel user);
    Optional<LobbyModel> findFirstByInviteCode(String inviteCode);
    //Optional<LobbyModel> findFirstByInviteIdOrderByCodLobby(long inviteId);

}

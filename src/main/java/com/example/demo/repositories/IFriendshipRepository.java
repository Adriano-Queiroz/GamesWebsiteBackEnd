package com.example.demo.repositories;

import com.example.demo.models.friendship.FriendshipModel;
import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface IFriendshipRepository extends JpaRepository<FriendshipModel,Long> {
    Optional<FriendshipModel> findFirstByIsAcceptedAndUserRequestAndAndUserAccept(boolean isAccepted,UserModel userRequest, UserModel userAcept);
}

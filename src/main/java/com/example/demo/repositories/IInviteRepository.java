package com.example.demo.repositories;

import com.example.demo.models.InviteModel;
import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface IInviteRepository extends JpaRepository<InviteModel,Long> {
    Optional<InviteModel> findFirstByUserAcceptAndUserRequestAndIsAccepted(UserModel userAccept, UserModel userRequest, Boolean isAccepted);
}

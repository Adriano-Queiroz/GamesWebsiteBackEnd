package com.example.demo.repositories;

import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface IBattleRepository extends JpaRepository<BattleModel,Long> {
    Optional<BattleModel> findFirstByPlayer1(UserModel player1);
    Optional<BattleModel> findFirstByPlayer2(UserModel player2);

}

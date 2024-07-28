package com.example.demo.repositories;

import com.example.demo.models.battle.BattleModel;
import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.util.Optional;

public interface IBattleRepository extends JpaRepository<BattleModel,Long> {
    Optional<BattleModel> findFirstByPlayer1(UserModel player1);
    Optional<BattleModel> findFirstByPlayer2(UserModel player2);
    Optional<BattleModel> findFirstByPlayer1OrPlayer2(UserModel player1, UserModel player2);

    @Query("SELECT CASE WHEN b.player1 = :player THEN b.player2 ELSE b.player1 END FROM BattleModel b WHERE b.player1 = :player OR b.player2 = :player")
    UserModel findOpponentByPlayer(@Param("player") UserModel player);


}

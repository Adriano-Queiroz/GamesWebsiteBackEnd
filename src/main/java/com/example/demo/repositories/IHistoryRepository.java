package com.example.demo.repositories;

import com.example.demo.models.history.HistoryModel;
import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.util.Optional;

public interface IHistoryRepository extends JpaRepository<HistoryModel,Long> {
     Optional<HistoryModel> findFirstByCodBattle(long codBattle);
     @Query("SELECT h FROM HistoryModel h WHERE (h.player1 = :user OR h.player2 = :user) ORDER BY h.createdAt DESC")
     Optional<HistoryModel> findLatestHistoryByUser(@Param("user") UserModel user);
}

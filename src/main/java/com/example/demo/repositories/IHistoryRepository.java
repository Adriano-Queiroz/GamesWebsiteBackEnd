package com.example.demo.repositories;

import com.example.demo.models.history.HistoryModel;
import com.example.demo.models.user.UserModel;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.Optional;

public interface IHistoryRepository extends JpaRepository<HistoryModel,Long> {
     Optional<HistoryModel> findFirstByCodBattle(long codBattle);
     @Query("SELECT h FROM HistoryModel h WHERE (h.player1 = :user OR h.player2 = :user) ORDER BY h.createdAt DESC")
     Optional<HistoryModel> findLatestHistoryByUser(@Param("user") UserModel user);
     @Query("SELECT COALESCE(SUM(d.moneyGained), 0) FROM HistoryModel d WHERE d.createdAt BETWEEN :startDate AND :endDate")
     Double getTotalMoneyGainedBetweenDates(@Param("startDate") LocalDateTime startDate, @Param("endDate") LocalDateTime endDate);

     @Query("SELECT COALESCE(SUM(moneyGained), 0) FROM HistoryModel ")
     Double getTotalMoneyGained();
}

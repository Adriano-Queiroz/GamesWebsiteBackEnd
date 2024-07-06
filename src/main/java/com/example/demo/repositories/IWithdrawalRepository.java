package com.example.demo.repositories;

import com.example.demo.models.withdrawal.WithdrawalModel;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;

public interface IWithdrawalRepository extends JpaRepository<WithdrawalModel, Long> {
    @Query("SELECT COALESCE(SUM(w.amount), 0) FROM WithdrawalModel w")
    Double getTotalWithdrawals();
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM WithdrawalModel d WHERE d.date BETWEEN :startDate AND :endDate")
    Double getTotalWithdrawalsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);
}

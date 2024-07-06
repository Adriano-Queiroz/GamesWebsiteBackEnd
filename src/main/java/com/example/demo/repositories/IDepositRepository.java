package com.example.demo.repositories;

import com.example.demo.models.deposit.DepositModel;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;

public interface IDepositRepository extends JpaRepository<DepositModel,Long> {
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM DepositModel d")
    Double getTotalDeposits();
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM DepositModel d WHERE d.date BETWEEN :startDate AND :endDate")
    Double getTotalDepositsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);
}

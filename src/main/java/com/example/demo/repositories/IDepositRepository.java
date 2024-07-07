package com.example.demo.repositories;

import com.example.demo.models.deposit.DepositModel;
import com.example.demo.models.deposit.DepositStatus;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;
import java.util.List;

public interface IDepositRepository extends JpaRepository<DepositModel,Long> {
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM DepositModel d")
    Double getTotalDeposits();
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM DepositModel d WHERE d.date BETWEEN :startDate AND :endDate")
    Double getTotalDepositsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);

    List<DepositModel> findAllByStatusAndDateBetween(DepositStatus status, LocalDate date, LocalDate date2);
    List<DepositModel> findAllByStatus(DepositStatus status);
    List<DepositModel> findAllByOrderByDateDesc();
    List<DepositModel> findAllByDateBetween(LocalDate date, LocalDate date2);
}

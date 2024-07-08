package com.example.demo.repositories;

import com.example.demo.models.deposit.DepositModel;
import com.example.demo.models.deposit.DepositStatus;
import com.example.demo.models.withdrawal.WithdrawalModel;
import com.example.demo.models.withdrawal.WithdrawalStatus;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;
import java.util.Collection;
import java.util.List;

public interface IWithdrawalRepository extends JpaRepository<WithdrawalModel, Long> {
    @Query("SELECT COALESCE(SUM(w.amount), 0) FROM WithdrawalModel w")
    Double getTotalWithdrawals();
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM WithdrawalModel d WHERE d.date BETWEEN :startDate AND :endDate")
    Double getTotalWithdrawalsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate);
    @Query("SELECT COALESCE(SUM(w.amount), 0) FROM WithdrawalModel w where w.status = :status")
    Double getTotalWithdrawals(WithdrawalStatus status);
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM WithdrawalModel d WHERE d.date BETWEEN :startDate AND :endDate and d.status = :status")
    Double getTotalWithdrawalsBetweenDates(@Param("startDate") LocalDate startDate, @Param("endDate") LocalDate endDate, WithdrawalStatus status);

    List<WithdrawalModel> findAllByStatusAndDateBetween(WithdrawalStatus status, LocalDate date, LocalDate date2);
    List<WithdrawalModel> findAllByStatus(WithdrawalStatus status);
    List<WithdrawalModel> findAllByOrderByDateDesc();
    List<WithdrawalModel> findAllByDateBetween(LocalDate date, LocalDate date2);}

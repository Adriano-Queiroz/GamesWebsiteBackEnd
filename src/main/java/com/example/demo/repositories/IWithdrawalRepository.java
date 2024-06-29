package com.example.demo.repositories;

import com.example.demo.models.withdrawal.WithdrawalModel;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;

public interface IWithdrawalRepository extends JpaRepository<WithdrawalModel, Long> {
    @Query("SELECT COALESCE(SUM(w.amount), 0) FROM WithdrawalModel w")
    Double getTotalWithdrawals();
}

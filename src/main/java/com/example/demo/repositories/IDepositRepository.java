package com.example.demo.repositories;

import com.example.demo.models.deposit.DepositModel;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;

public interface IDepositRepository extends JpaRepository<DepositModel,Long> {
    @Query("SELECT COALESCE(SUM(d.amount), 0) FROM DepositModel d")
    Double getTotalDeposits();
}

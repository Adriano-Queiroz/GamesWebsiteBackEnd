package com.example.demo.repositories;

import com.example.demo.models.withdrawal.WithdrawalModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IWithdrawalRepository extends JpaRepository<WithdrawalModel, Long> {
}

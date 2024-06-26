package com.example.demo.repositories;

import com.example.demo.models.deposit.DepositModel;
import org.springframework.data.jpa.repository.JpaRepository;

public interface IDepositRepository extends JpaRepository<DepositModel,Long> {
}
